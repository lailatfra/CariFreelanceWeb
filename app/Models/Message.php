<?php
// app/Models/Message.php
// ✅ UPDATE: Tambahkan auto-create notification saat pesan baru

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\NotificationService;

class Message extends Model
{
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message',
        'attachments',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'attachments' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    // Relationships
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Boot method untuk auto-update conversation & create notification
    protected static function boot()
    {
        parent::boot();

        static::created(function ($message) {
            $conversation = $message->conversation;
            
            // Update last message preview
            $preview = $message->message 
                ? \Illuminate\Support\Str::limit($message->message, 50)
                : '📎 Mengirim file';
            
            $conversation->updateLastMessage($preview);
            
            // Increment unread for recipient
            $recipientId = $message->sender_id === $conversation->client_id
                ? $conversation->freelancer_id
                : $conversation->client_id;
            
            $conversation->incrementUnreadFor($recipientId);

            // ✅ BARU - Create notification untuk penerima pesan
            NotificationService::messageReceived($message);
        });
    }

    // Helper: Mark as read
    public function markAsRead(): void
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }
    }

    // Helper: Get file info
    public function hasAttachments(): bool
    {
        return !empty($this->attachments);
    }

    public function getAttachmentsCount(): int
    {
        return count($this->attachments ?? []);
    }
}