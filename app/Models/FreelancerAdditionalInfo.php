<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerAdditionalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // Basic Information
        'full_name',
        'location',
        'headline',
        'category',
        'profile_photo',
        // Bio & Experience
        'bio',
        'experience',
        // Skills
        'skills',
        'experience_level',
        // Portfolio
        'portfolio_title',
        'portfolio_description',
        'portofolio_link',
        'portfolio_category',
        'portfolio_tech',
        // Education & Certifications
        'education',
        'graduation_year',
        'certifications',
        'courses',
        'languages',
        // Rate & Availability
        'hourly_rate',
        'project_rate',
        'service_types',
        'availability',
        'response_time',
        // Stats
        'rating',
        'review_count',
        'project_count',
    ];

    protected $casts = [
        'languages' => 'array',
        'service_types' => 'array',
        'hourly_rate' => 'decimal:2',
        'project_rate' => 'decimal:2',
        'rating' => 'decimal:2',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}