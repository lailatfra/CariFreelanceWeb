<?php
// app/Models/Notification.php
// ✅ TAMBAHKAN constant baru untuk chat

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    // Notification types constants
    const TYPE_PROPOSAL_RECEIVED = 'proposal_received';
    const TYPE_PROPOSAL_ACCEPTED = 'proposal_accepted';
    const TYPE_PROPOSAL_REJECTED = 'proposal_rejected';
    const TYPE_PROJECT_SUBMITTED = 'project_submitted';
    const TYPE_PROJECT_APPROVED = 'project_approved';
    const TYPE_PROJECT_REVISION = 'project_revision';
    const TYPE_PAYMENT_RECEIVED = 'payment_received';
    
    // ✅ TAMBAHAN BARU - Chat notification types
    const TYPE_MESSAGE_RECEIVED = 'message_received';

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    public function scopeRecent($query, $limit = 50)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Helper methods
    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }
    }

    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null,
        ]);
    }

    // Get time ago format
    public function getTimeAgoAttribute()
    {
        $diff = Carbon::now()->diffInMinutes($this->created_at);

        if ($diff < 1) {
            return 'Baru saja';
        } elseif ($diff < 60) {
            return $diff . ' menit yang lalu';
        } elseif ($diff < 1440) { // 24 hours
            $hours = floor($diff / 60);
            return $hours . ' jam yang lalu';
        } elseif ($diff < 10080) { // 7 days
            $days = floor($diff / 1440);
            return $days . ' hari yang lalu';
        } else {
            return $this->created_at->format('d M Y');
        }
    }

    // Get icon based on type
    public function getIconAttribute()
    {
        return match($this->type) {
            self::TYPE_PROPOSAL_RECEIVED => 'fa-briefcase',
            self::TYPE_PROPOSAL_ACCEPTED => 'fa-check-circle',
            self::TYPE_PROPOSAL_REJECTED => 'fa-times-circle',
            self::TYPE_PROJECT_SUBMITTED => 'fa-upload',
            self::TYPE_PROJECT_APPROVED => 'fa-thumbs-up',
            self::TYPE_PROJECT_REVISION => 'fa-edit',
            self::TYPE_PAYMENT_RECEIVED => 'fa-money-bill-wave',
            self::TYPE_MESSAGE_RECEIVED => 'fa-comment-dots', // ✅ BARU
            default => 'fa-bell',
        };
    }

    // Get icon wrapper class based on type
    public function getIconWrapperClassAttribute()
    {
        return match($this->type) {
            self::TYPE_PROPOSAL_RECEIVED => 'info',
            self::TYPE_PROPOSAL_ACCEPTED => 'success',
            self::TYPE_PROPOSAL_REJECTED => 'error',
            self::TYPE_PROJECT_SUBMITTED => 'info',
            self::TYPE_PROJECT_APPROVED => 'success',
            self::TYPE_PROJECT_REVISION => 'warning',
            self::TYPE_PAYMENT_RECEIVED => 'success',
            self::TYPE_MESSAGE_RECEIVED => 'info', // ✅ BARU
            default => 'info',
        };
    }

    // Get priority badge if exists
    public function getPriorityBadgeAttribute()
    {
        return match($this->type) {
            self::TYPE_PROPOSAL_RECEIVED => ['text' => 'URGENT', 'class' => 'urgent'],
            self::TYPE_PROJECT_REVISION => ['text' => 'PENTING', 'class' => 'high'],
            self::TYPE_MESSAGE_RECEIVED => ['text' => 'BARU', 'class' => 'new'], // ✅ BARU
            default => null,
        };
    }

    // Get action URL based on type and data
    public function getActionUrlAttribute()
    {
        $data = $this->data ?? [];

        return match($this->type) {
            self::TYPE_PROPOSAL_RECEIVED => route('freelancer.proposal.show', $data['proposal_id'] ?? '#'),
            self::TYPE_PROPOSAL_ACCEPTED, self::TYPE_PROPOSAL_REJECTED => route('projekf'),
            self::TYPE_PROJECT_SUBMITTED => route('submit-projects.show', $data['submission_id'] ?? '#'),
            self::TYPE_PROJECT_APPROVED => route('projekf'),
            self::TYPE_PROJECT_REVISION => route('submit-projects.revision-notes', $data['project_id'] ?? '#'),
            self::TYPE_PAYMENT_RECEIVED => route('freelancer.withdrawals.index'),
            self::TYPE_MESSAGE_RECEIVED => route('chat'), // ✅ BARU - ke halaman chat
            default => '#',
        };
    }

    // Static method untuk create notification dengan format yang konsisten
    public static function createNotification($userId, $type, $title, $message, $data = [])
    {
        return self::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
            'is_read' => false,
        ]);
    }
}