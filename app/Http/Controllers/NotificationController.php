<?php
// app/Http/Controllers/NotificationController.php
// ✅ UPDATE: Tambahkan filter 'messages' untuk notifikasi chat

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display notification page
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get filter from request
        $filter = $request->get('filter', 'all');
        
        // Base query
        $query = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc');
        
        // Apply filters
        switch ($filter) {
            case 'unread':
                $query->unread();
                break;
            case 'proposals':
                $query->whereIn('type', [
                    Notification::TYPE_PROPOSAL_RECEIVED,
                    Notification::TYPE_PROPOSAL_ACCEPTED,
                    Notification::TYPE_PROPOSAL_REJECTED
                ]);
                break;
            case 'projects':
                $query->whereIn('type', [
                    Notification::TYPE_PROJECT_SUBMITTED,
                    Notification::TYPE_PROJECT_APPROVED,
                    Notification::TYPE_PROJECT_REVISION
                ]);
                break;
            case 'payments':
                $query->where('type', Notification::TYPE_PAYMENT_RECEIVED);
                break;
            // ✅ BARU - Filter untuk pesan chat
            case 'messages':
                $query->where('type', Notification::TYPE_MESSAGE_RECEIVED);
                break;
        }
        
        // Get notifications with pagination
        $notifications = $query->paginate(20);
        
        // Get stats
        $stats = [
            'total' => Notification::where('user_id', $user->id)->count(),
            'unread' => Notification::where('user_id', $user->id)->unread()->count(),
            'read' => Notification::where('user_id', $user->id)->read()->count(),
        ];
        
        // Return appropriate view based on user role
        if ($user->role === 'client') {
            return view('client.notification', compact('notifications', 'stats', 'filter'));
        } else {
            return view('freelancer.notification', compact('notifications', 'stats', 'filter'));
        }
    }

    /**
     * Get unread count (untuk badge)
     */
    public function getUnreadCount()
    {
        $count = Notification::where('user_id', Auth::id())
            ->unread()
            ->count();
        
        return response()->json(['count' => $count]);
    }

    /**
     * Mark single notification as read
     */
    public function markAsRead($id)
    {
        try {
            $notification = Notification::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
            
            $notification->markAsRead();
            
            return response()->json([
                'success' => true,
                'message' => 'Notifikasi ditandai sebagai sudah dibaca'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai notifikasi'
            ], 500);
        }
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        try {
            Notification::where('user_id', Auth::id())
                ->unread()
                ->update([
                    'is_read' => true,
                    'read_at' => now()
                ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Semua notifikasi ditandai sebagai sudah dibaca'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai semua notifikasi'
            ], 500);
        }
    }

    /**
     * Delete single notification
     */
    public function destroy($id)
    {
        try {
            $notification = Notification::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
            
            $notification->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Notifikasi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus notifikasi'
            ], 500);
        }
    }

    /**
     * Delete selected notifications
     */
    public function destroySelected(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            
            Notification::where('user_id', Auth::id())
                ->whereIn('id', $ids)
                ->delete();
            
            return response()->json([
                'success' => true,
                'message' => count($ids) . ' notifikasi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus notifikasi'
            ], 500);
        }
    }

    /**
     * Get latest notifications (untuk dropdown/bell icon)
     */
    public function getLatest()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->recent(10)
            ->get();
        
        return response()->json([
            'notifications' => $notifications,
            'unread_count' => Notification::where('user_id', Auth::id())->unread()->count()
        ]);
    }
}