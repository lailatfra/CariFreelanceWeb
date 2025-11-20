<?php
// app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'proposal_id',
        'client_id',
        'freelancer_id',
        'project_id',
        'service_amount',
        'admin_fee',
        'amount',
        'status',
        'midtrans_transaction_id',
        'midtrans_transaction_status',
        'midtrans_response',
        'paid_at',
        'is_released_to_freelancer',  // ⬅️ BARU
        'released_at',                 // ⬅️ BARU
        'release_notes'                // ⬅️ BARU
    ];

    protected $casts = [
        'service_amount' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'midtrans_response' => 'array',
        'paid_at' => 'datetime',
        'released_at' => 'datetime',  // ⬅️ BARU
        'amount' => 'decimal:2',
        'is_released_to_freelancer' => 'boolean'  // ⬅️ BARU
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // ⬅️ TAMBAHKAN HELPER METHODS BARU
    public function isReleasedToFreelancer()
    {
        return $this->is_released_to_freelancer === true;
    }

    public function isInEscrow()
    {
        return $this->isSuccess() && !$this->isReleasedToFreelancer();
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isSuccess()
    {
        return $this->status === 'success';
    }

    public function isFailed()
    {
        return $this->status === 'failed';
    }

    public function generatePaymentId()
    {
        return 'PAY-' . date('Ymd') . '-' . strtoupper(uniqid());
    }

    public function getFormattedServiceAmountAttribute()
    {
        return 'Rp ' . number_format($this->service_amount, 0, ',', '.');
    }

    public function getFormattedAdminFeeAttribute()
    {
        return 'Rp ' . number_format($this->admin_fee, 0, ',', '.');
    }

    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }
}