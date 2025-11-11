<?php
// App/Models/FreelancerProfile.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'skills',
        'experience_years',
        'portofolio_link',
        'phone',
        'profile_photo',
        'username',
        'headline',
        'location',
        'category',
        'subskills',
        'bio',
        'identity_document',
        'npwp',
        'hourly_rate',
        'languages',
        'work_type',
        'rating',
        'review_count',
        'project_count',
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    
}
