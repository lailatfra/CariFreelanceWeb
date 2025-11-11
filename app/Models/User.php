<?php
// App/Models/User.php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // tambahkan ini
        'email_verified_at', // tambahkan ini juga kalau kamu set manual
        'status',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function clientProfile()
    {
        return $this->hasOne(ClientProfile::class, 'user_id', 'id');
    }

    public function freelancerProfile()
    {
        return $this->hasOne(FreelancerProfile::class, 'user_id', 'id');
    }



    public function project()
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
}
