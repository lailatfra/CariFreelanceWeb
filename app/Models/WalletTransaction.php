<?php 
// app/Models/WalletTransaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'payment_id',
        'type',
        'status',
        'amount',
        'description',
        'balance_before',
        'balance_after'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }
}