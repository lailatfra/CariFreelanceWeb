<?php
// app/Http/Controllers/ChatController.php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Events\MessageSent;
use App\Events\UserTyping;
use App\Events\MessageRead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Show chat page
     */
    public function index()
    {
        $userId = Auth::id();
        
        // Get all conversations for current user
        $conversations = Conversation::where(function($q) use ($userId) {
                $q->where('client_id', $userId)
                  ->orWhere('freelancer_id', $userId);
            })
            ->with(['project:id,title', 'client:id,name', 'freelancer:id,name'])
            ->orderByDesc('last_message_at')
            ->get()
            ->map(function($conv) use ($userId) {
                $otherUser = $conv->getOtherParticipant($userId);
                
                return [
                    'id' => $conv->id,
                    'project_title' => $conv->project->title,
                    'other_user_name' => $otherUser->name ?? 'Unknown',
                    'other_user_id' => $otherUser->id ?? null,
                    'last_message' => $conv->last_message_preview,
                    'last_message_time' => $conv->last_message_at?->diffForHumans(),
                    'unread_count' => $conv->getUnreadCountForUser($userId),
                ];
            });
        
        // ✅ UBAH view path ke folder chat
        return view('chat.index', compact('conversations'));
    }

    /**
     * Get conversation details with messages
     */
    public function show(Conversation $conversation)
    {
        $userId = Auth::id();
        
        // Verify user has access
        if ($conversation->client_id !== $userId && $conversation->freelancer_id !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        // Mark messages as read
        $this->markConversationAsRead($conversation, $userId);
        
        // Get latest 50 messages
        $messages = $conversation->messages()
            ->with('sender:id,name')
            ->latest()
            ->limit(50)
            ->get()
            ->reverse()
            ->values()
            ->map(function($msg) use ($userId) {
                return [
                    'id' => $msg->id,
                    'sender_id' => $msg->sender_id,
                    'sender_name' => $msg->sender->name,
                    'message' => $msg->message,
                    'attachments' => $msg->attachments,
                    'is_read' => $msg->is_read,
                    'is_own' => $msg->sender_id === $userId,
                    'created_at' => $msg->created_at->toISOString(),
                    'formatted_time' => $msg->created_at->format('H:i'),
                ];
            });
        
        $otherUser = $conversation->getOtherParticipant($userId);
        
        return response()->json([
            'conversation' => [
                'id' => $conversation->id,
                'project_title' => $conversation->project->title,
                'other_user' => [
                    'id' => $otherUser->id,
                    'name' => $otherUser->name,
                ],
            ],
            'messages' => $messages,
        ]);
    }

    /**
     * Send message
     */
    public function sendMessage(Request $request, Conversation $conversation)
    {
        $userId = Auth::id();
        
        // Verify access
        if ($conversation->client_id !== $userId && $conversation->freelancer_id !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $request->validate([
            'message' => 'nullable|string|max:5000',
            'attachments.*' => 'nullable|file|max:10240', // 10MB max per file
        ]);
        
        // Handle file uploads
        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('chat_attachments', 'public');
                $attachments[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'url' => Storage::url($path),
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType(),
                ];
            }
        }
        
        // Create message
        $message = $conversation->messages()->create([
            'sender_id' => $userId,
            'message' => $request->message,
            'attachments' => !empty($attachments) ? $attachments : null,
        ]);
        
        // Broadcast message
        broadcast(new MessageSent($message))->toOthers();
        
        return response()->json([
            'success' => true,
            'message' => $message->load('sender:id,name'),
        ]);
    }

    /**
     * Load more messages (pagination)
     */
    public function loadMore(Request $request, Conversation $conversation)
    {
        $userId = Auth::id();
        
        if ($conversation->client_id !== $userId && $conversation->freelancer_id !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $beforeMessageId = $request->input('before_id');
        
        $messages = $conversation->messages()
            ->with('sender:id,name')
            ->when($beforeMessageId, function($q) use ($beforeMessageId) {
                $q->where('id', '<', $beforeMessageId);
            })
            ->latest()
            ->limit(20)
            ->get()
            ->reverse()
            ->values()
            ->map(function($msg) use ($userId) {
                return [
                    'id' => $msg->id,
                    'sender_id' => $msg->sender_id,
                    'sender_name' => $msg->sender->name,
                    'message' => $msg->message,
                    'attachments' => $msg->attachments,
                    'is_read' => $msg->is_read,
                    'is_own' => $msg->sender_id === $userId,
                    'created_at' => $msg->created_at->toISOString(),
                    'formatted_time' => $msg->created_at->format('H:i'),
                ];
            });
        
        return response()->json([
            'messages' => $messages,
            'has_more' => $messages->count() === 20,
        ]);
    }

    /**
     * Handle typing indicator
     */
    public function typing(Request $request, Conversation $conversation)
    {
        $userId = Auth::id();
        
        if ($conversation->client_id !== $userId && $conversation->freelancer_id !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $isTyping = $request->boolean('is_typing', true);
        
        broadcast(new UserTyping(
            $conversation->id,
            $userId,
            Auth::user()->name,
            $isTyping
        ))->toOthers();
        
        return response()->json(['success' => true]);
    }

    /**
     * Mark messages as read
     */
    public function markAsRead(Conversation $conversation)
    {
        $userId = Auth::id();
        
        if ($conversation->client_id !== $userId && $conversation->freelancer_id !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $this->markConversationAsRead($conversation, $userId);
        
        return response()->json(['success' => true]);
    }

    /**
     * Helper: Mark conversation as read
     */
    private function markConversationAsRead(Conversation $conversation, int $userId)
    {
        // Get unread messages
        $unreadMessages = $conversation->messages()
            ->where('sender_id', '!=', $userId)
            ->where('is_read', false)
            ->get();
        
        if ($unreadMessages->isEmpty()) {
            return;
        }
        
        // Mark as read
        $messageIds = $unreadMessages->pluck('id')->toArray();
        
        Message::whereIn('id', $messageIds)->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
        
        // Reset unread count
        $conversation->markAsReadFor($userId);
        
        // Broadcast read receipt
        broadcast(new MessageRead($conversation->id, $messageIds, $userId))->toOthers();
    }

    /**
     * Search messages
     */
    public function search(Request $request)
    {
        $userId = Auth::id();
        $query = $request->input('query');
        
        if (empty($query)) {
            return response()->json(['results' => []]);
        }
        
        $results = Message::whereHas('conversation', function($q) use ($userId) {
                $q->where('client_id', $userId)
                  ->orWhere('freelancer_id', $userId);
            })
            ->with(['conversation.project', 'sender'])
            ->where('message', 'like', "%{$query}%")
            ->latest()
            ->limit(50)
            ->get()
            ->map(function($msg) {
                return [
                    'id' => $msg->id,
                    'conversation_id' => $msg->conversation_id,
                    'project_title' => $msg->conversation->project->title,
                    'sender_name' => $msg->sender->name,
                    'message' => $msg->message,
                    'created_at' => $msg->created_at->format('d M Y H:i'),
                ];
            });
        
        return response()->json(['results' => $results]);
    }
}