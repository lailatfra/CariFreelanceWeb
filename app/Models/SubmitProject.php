<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmitProject extends Model
{
    use HasFactory;

    protected $table = 'submit_projects'; 

    protected $fillable = [
        'user_id',
        'project_id',
        'files',
        'links',
        'description',
        'notes',
        'status',
    ];

    protected $casts = [
        'files' => 'array',
        'links' => 'array',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Project
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }


    public function proposal()
    {
        return $this->hasOne(Proposal::class, 'project_id', 'project_id')
                    ->where('user_id', $this->user_id)
                    ->where('status', 'accepted');
    }

    public function completed()
    {
        $completed = SubmitProject::with(['project.proposalls' => function($q) {
            $q->where('user_id', auth()->id())
            ->where('status', 'accepted');
        }, 'project.client'])
        ->where('user_id', auth()->id()) // upload milik freelancer ini
        ->get();

        return view('freelancer.completed', compact('completedProjects'));
    }
    
}
