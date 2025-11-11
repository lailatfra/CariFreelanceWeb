<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress_uploads'; 
    
    protected $fillable = [
        'project_id',
        'timeline_id',
        'description',
        'link_url',
        'client_notes',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }

        // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposal()
    {
        return $this->hasOne(Proposal::class, 'project_id', 'project_id')
                    ->where('user_id', $this->user_id)
                    ->where('status', 'accepted');
    }
    
}
