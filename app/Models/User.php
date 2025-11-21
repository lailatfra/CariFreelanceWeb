<?php
// App/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use \App\Models\Notification;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'birth_date',
        'role',
        'email_verified_at',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ===== RELASI YANG SUDAH ADA (JANGAN DIUBAH) =====
    public function clientProfile()
    {
        return $this->hasOne(ClientProfile::class, 'user_id', 'id');
    }

    public function freelancerProfile()
    {
        return $this->hasOne(FreelancerProfile::class, 'user_id', 'id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function projects()
    {
        return $this->belongsTo(Project::class);
    }

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }

    public function clientAdditionalInfo()
    {
        return $this->hasOne(ClientAdditionalInfo::class);
    }

    public function freelancerAdditionalInfo()
    {
        return $this->hasOne(FreelancerProfile::class);
    }

    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class)->orderBy('created_at', 'desc');
    }

    public function unreadNotifications()
    {
        return $this->hasMany(\App\Models\Notification::class)->where('is_read', false);
    }

    public function getUnreadNotificationCountAttribute()
    {
        return $this->unreadNotifications()->count();
    }

    public function hasUnreadNotifications()
    {
        return $this->unreadNotifications()->exists();
    }
}