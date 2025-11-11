<?php
// App/Models/Proposal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposalls';

    protected $fillable = [
        'project_id',
        'user_id',
        'proposal_title',
        'proposal_description',
        'proposal_price',
        'timeline',
        'skills',
        'experience',
        'portfolio_links',
        'files',
        'additional_message',
        'status',
    ];

    protected $casts = [
        'skills' => 'array',
        'files' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

}
