<?php
// app/Models/AdminWalletTransaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminWalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_wallet_id',
        'payment_id',
        'withdrawal_id',
        'type',
        'status',
        'amount',
        'description',
        'service_balance_before',
        'service_balance_after',
        'admin_fee_balance_before',
        'admin_fee_balance_after',
        'total_balance_before',
        'total_balance_after'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'service_balance_before' => 'decimal:2',
        'service_balance_after' => 'decimal:2',
        'admin_fee_balance_before' => 'decimal:2',
        'admin_fee_balance_after' => 'decimal:2',
        'total_balance_before' => 'decimal:2',
        'total_balance_after' => 'decimal:2'
    ];

    // Relationships
    public function adminWallet()
    {
        return $this->belongsTo(AdminWallet::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function withdrawal()
    {
        return $this->belongsTo(Withdrawal::class);
    }

    // Helper methods
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getTypeBadgeAttribute()
    {
        return match($this->type) {
            'credit_service' => '<span class="badge badge-primary">Credit Service</span>',
            'credit_admin_fee' => '<span class="badge badge-success">Credit Admin Fee</span>',
            'debit_transfer' => '<span class="badge badge-danger">Debit Transfer</span>',
            default => '<span class="badge badge-secondary">Unknown</span>'
        };
    }
}