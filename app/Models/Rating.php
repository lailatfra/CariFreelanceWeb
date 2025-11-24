<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'rating',
        'ketepatan_waktu',
        'kualitas_kerja',
        'review'
    ];

    protected $casts = [
        'rating' => 'integer'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}