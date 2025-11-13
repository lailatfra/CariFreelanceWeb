<?php
// app/Models/Conversation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    protected $fillable = [
        'project_id',
        'client_id',
        'freelancer_id',
        'proposal_id',
        'last_message_at',
        'client_unread_count',
        'freelancer_unread_count',
        'last_message_preview',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    // Helper: Get latest messages (paginated)
    public function latestMessages(int $limit = 20)
    {
        return $this->messages()
            ->with('sender:id,name')
            ->latest()
            ->limit($limit)
            ->get()
            ->reverse()
            ->values();
    }

    // Helper: Get unread count for specific user
    public function getUnreadCountForUser(int $userId): int
    {
        if ($userId === $this->client_id) {
            return $this->client_unread_count;
        }
        
        if ($userId === $this->freelancer_id) {
            return $this->freelancer_unread_count;
        }
        
        return 0;
    }

    // Helper: Increment unread count
    public function incrementUnreadFor(int $recipientId): void
    {
        if ($recipientId === $this->client_id) {
            $this->increment('client_unread_count');
        } elseif ($recipientId === $this->freelancer_id) {
            $this->increment('freelancer_unread_count');
        }
    }

    // Helper: Reset unread count
    public function markAsReadFor(int $userId): void
    {
        if ($userId === $this->client_id) {
            $this->update(['client_unread_count' => 0]);
        } elseif ($userId === $this->freelancer_id) {
            $this->update(['freelancer_unread_count' => 0]);
        }
    }

    // Helper: Update last message
    public function updateLastMessage(string $preview): void
    {
        $this->update([
            'last_message_at' => now(),
            'last_message_preview' => $preview,
        ]);
    }

    // Helper: Get other participant
    public function getOtherParticipant(int $userId): ?User
    {
        if ($userId === $this->client_id) {
            return $this->freelancer;
        }
        
        if ($userId === $this->freelancer_id) {
            return $this->client;
        }
        
        return null;
    }
}