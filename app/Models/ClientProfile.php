<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'tujuan',
        'phone',
        'bio',
        'location',
        'profile_photo', 
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
        public function projects()
    {
        return $this->hasMany(Project::class, 'client_id'); // atau user_id tergantung foreign key
    }

}
