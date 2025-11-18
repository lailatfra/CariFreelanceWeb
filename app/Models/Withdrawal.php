<?php
// app/Models/Withdrawal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'withdrawal_id',
        'user_id',
        'wallet_id',
        'amount',
        'status',
        'bank_name',
        'account_number',
        'account_holder_name',
        'admin_notes',
        'processed_by',
        'processed_at',
        'proof_image'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'processed_at' => 'datetime'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    // Helper Methods
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function generateWithdrawalId()
    {
        return 'WD-' . date('Ymd') . '-' . strtoupper(uniqid());
    }

    // Format helpers
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="badge badge-warning"><i class="fas fa-clock"></i> Menunggu</span>',
            'approved' => '<span class="badge badge-info"><i class="fas fa-check"></i> Disetujui</span>',
            'rejected' => '<span class="badge badge-danger"><i class="fas fa-times"></i> Ditolak</span>',
            'completed' => '<span class="badge badge-success"><i class="fas fa-check-double"></i> Selesai</span>',
            default => '<span class="badge badge-secondary">Unknown</span>'
        };
    }
}