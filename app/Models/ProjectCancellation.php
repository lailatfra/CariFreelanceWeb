<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCancellation extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'project_status',
        'reason',
        'evidence_files',
        'bank_name',
        'account_number',
        'refund_amount',
        'refund_status',
        'cancelled_at',
        'repost_project',
        'transfer_proof',        // ✅ BARU
        'processed_at',          // ✅ BARU
        'rejection_reason',      // ✅ BARU
        'rejected_at'            // ✅ BARU
    ];

    protected $casts = [
        'evidence_files' => 'array',
        'refund_amount' => 'decimal:2',
        'cancelled_at' => 'datetime',
        'repost_project' => 'boolean', 
        'processed_at' => 'datetime',   // ✅ BARU
        'rejected_at' => 'datetime'     // ✅ BARU
    ];

    /**
     * Relationship dengan Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Relationship dengan User (Client)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function freelancer()
    {
        return $this->hasOneThrough(
            User::class,
            Proposal::class,
            'project_id',
            'id',
            'project_id',
            'user_id'
        )->where('proposals.status', 'accepted');
    }

    /**
     * Get formatted refund amount
     */
    public function getFormattedRefundAttribute()
    {
        return 'Rp ' . number_format($this->refund_amount, 0, ',', '.');
    }

    /**
     * Get refund status badge color
     */
    public function getRefundStatusBadgeAttribute()
    {
        return match($this->refund_status) {
            'pending' => 'warning',
            'processed' => 'info',
            'completed' => 'success',
            default => 'secondary'
        };
    }

    /**
     * Get refund status text
     */
    public function getRefundStatusTextAttribute()
    {
        return match($this->refund_status) {
            'pending' => 'Menunggu Proses',
            'processed' => 'Sedang Diproses',
            'completed' => 'Selesai',
            default => 'Unknown'
        };
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}