<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAdditionalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // Company Information
        'company_name',
        'industry',
        'company_size',
        'company_description',
        'website',
        // Vision & Mission
        'company_vision',
        'company_mission',
        'company_values',
        'company_goals',
        // Communication Preferences
        'communication_platforms',
        'update_frequency',
        'timezone',
        // Social Media
        'social_website',
        'social_linkedin',
        'social_instagram',
        'social_facebook',
        'social_twitter',
        'social_youtube',
        'social_tiktok',
        'social_other',
    ];

    protected $casts = [
        'communication_platforms' => 'array',
    ];

    /**
     * Get the user that owns the additional info.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}