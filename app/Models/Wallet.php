<?php
// app/Models/Wallet.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'pending_balance'
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'pending_balance' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    // Helper method untuk menambah saldo
    public function credit($amount, $description, $paymentId = null)
    {
        $balanceBefore = $this->balance;
        $this->balance += $amount;
        $this->save();

        return $this->transactions()->create([
            'payment_id' => $paymentId,
            'type' => 'credit',
            'status' => 'completed',
            'amount' => $amount,
            'description' => $description,
            'balance_before' => $balanceBefore,
            'balance_after' => $this->balance
        ]);
    }

    // Helper method untuk mengurangi saldo
    public function debit($amount, $description)
    {
        if ($this->balance < $amount) {
            throw new \Exception('Saldo tidak mencukupi');
        }

        $balanceBefore = $this->balance;
        $this->balance -= $amount;
        $this->save();

        return $this->transactions()->create([
            'type' => 'debit',
            'status' => 'completed',
            'amount' => $amount,
            'description' => $description,
            'balance_before' => $balanceBefore,
            'balance_after' => $this->balance
        ]);
    }

    // Format saldo
    public function getFormattedBalanceAttribute()
    {
        return 'Rp ' . number_format($this->balance, 0, ',', '.');
    }
}

