<?php
// app/Models/AdminWallet.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminWallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_balance',
        'admin_fee_balance',
        'total_balance'
    ];

    protected $casts = [
        'service_balance' => 'decimal:2',
        'admin_fee_balance' => 'decimal:2',
        'total_balance' => 'decimal:2'
    ];

    public function transactions()
    {
        return $this->hasMany(AdminWalletTransaction::class);
    }

    /**
     * Tambah saldo service (untuk freelancer)
     */
    public function creditService($amount, $description, $paymentId = null)
    {
        $serviceBefore = $this->service_balance;
        $adminFeeBefore = $this->admin_fee_balance;
        $totalBefore = $this->total_balance;

        $this->service_balance += $amount;
        $this->total_balance += $amount;
        $this->save();

        return $this->transactions()->create([
            'payment_id' => $paymentId,
            'type' => 'credit_service',
            'status' => 'completed',
            'amount' => $amount,
            'description' => $description,
            'service_balance_before' => $serviceBefore,
            'service_balance_after' => $this->service_balance,
            'admin_fee_balance_before' => $adminFeeBefore,
            'admin_fee_balance_after' => $this->admin_fee_balance,
            'total_balance_before' => $totalBefore,
            'total_balance_after' => $this->total_balance
        ]);
    }

    /**
     * Tambah saldo admin fee (keuntungan platform)
     */
    public function creditAdminFee($amount, $description, $paymentId = null)
    {
        $serviceBefore = $this->service_balance;
        $adminFeeBefore = $this->admin_fee_balance;
        $totalBefore = $this->total_balance;

        $this->admin_fee_balance += $amount;
        $this->total_balance += $amount;
        $this->save();

        return $this->transactions()->create([
            'payment_id' => $paymentId,
            'type' => 'credit_admin_fee',
            'status' => 'completed',
            'amount' => $amount,
            'description' => $description,
            'service_balance_before' => $serviceBefore,
            'service_balance_after' => $this->service_balance,
            'admin_fee_balance_before' => $adminFeeBefore,
            'admin_fee_balance_after' => $this->admin_fee_balance,
            'total_balance_before' => $totalBefore,
            'total_balance_after' => $this->total_balance
        ]);
    }

    /**
     * Kurangi saldo service saat transfer ke freelancer
     */
    public function debitService($amount, $description, $withdrawalId = null)
    {
        if ($this->service_balance < $amount) {
            throw new \Exception('Saldo service tidak mencukupi');
        }

        $serviceBefore = $this->service_balance;
        $adminFeeBefore = $this->admin_fee_balance;
        $totalBefore = $this->total_balance;

        $this->service_balance -= $amount;
        $this->total_balance -= $amount;
        $this->save();

        return $this->transactions()->create([
            'withdrawal_id' => $withdrawalId,
            'type' => 'debit_transfer',
            'status' => 'completed',
            'amount' => $amount,
            'description' => $description,
            'service_balance_before' => $serviceBefore,
            'service_balance_after' => $this->service_balance,
            'admin_fee_balance_before' => $adminFeeBefore,
            'admin_fee_balance_after' => $this->admin_fee_balance,
            'total_balance_before' => $totalBefore,
            'total_balance_after' => $this->total_balance
        ]);
    }

    // Helper untuk format saldo
    public function getFormattedServiceBalanceAttribute()
    {
        return 'Rp ' . number_format($this->service_balance, 0, ',', '.');
    }

    public function getFormattedAdminFeeBalanceAttribute()
    {
        return 'Rp ' . number_format($this->admin_fee_balance, 0, ',', '.');
    }

    public function getFormattedTotalBalanceAttribute()
    {
        return 'Rp ' . number_format($this->total_balance, 0, ',', '.');
    }

    /**
     * Get atau create Admin Wallet (hanya 1 record)
     */
    public static function getWallet()
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'service_balance' => 0,
                'admin_fee_balance' => 0,
                'total_balance' => 0
            ]
        );
    }
}