<?php
// App/Models/FreelancerProfile.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    // ✅ TAMBAHKAN RELASI KE RATINGS
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id', 'user_id');
    }

    // ✅ METHOD UNTUK MENGHITUNG RATA-RATA RATING
    public function getAverageRatingAttribute()
    {
        // Cari semua rating untuk freelancer ini dari completed projects
        $avgRating = Rating::whereHas('project.proposalls', function($query) {
                $query->where('user_id', $this->user_id)
                      ->where('status', 'accepted');
            })
            ->avg('rating');

        return $avgRating ? round($avgRating, 1) : 0;
    }

    // ✅ METHOD UNTUK MENGHITUNG TOTAL REVIEW
    public function getTotalReviewsAttribute()
    {
        return Rating::whereHas('project.proposalls', function($query) {
                $query->where('user_id', $this->user_id)
                      ->where('status', 'accepted');
            })
            ->count();
    }

    // ✅ METHOD UNTUK MENGHITUNG TOTAL PROJECT SELESAI
    public function getCompletedProjectsCountAttribute()
    {
        return \App\Models\SubmitProject::where('user_id', $this->user_id)
            ->where('status', 'selesai')
            ->count();
    }

    // ✅ METHOD UNTUK MENDAPATKAN BREAKDOWN RATING
    public function getRatingBreakdownAttribute()
    {
        $ratings = Rating::whereHas('project.proposalls', function($query) {
                $query->where('user_id', $this->user_id)
                      ->where('status', 'accepted');
            })
            ->select(
                DB::raw('AVG(CASE WHEN ketepatan_waktu = "excellent" THEN 5 WHEN ketepatan_waktu = "good" THEN 4 WHEN ketepatan_waktu = "fair" THEN 3 ELSE 2 END) as avg_ketepatan_waktu'),
                DB::raw('AVG(CASE WHEN kualitas_kerja = "outstanding" THEN 5 WHEN kualitas_kerja = "excellent" THEN 4 WHEN kualitas_kerja = "good" THEN 3 WHEN kualitas_kerja = "satisfactory" THEN 2 ELSE 1 END) as avg_kualitas_kerja')
            )
            ->first();

        return [
            'ketepatan_waktu' => $ratings->avg_ketepatan_waktu ? round($ratings->avg_ketepatan_waktu, 1) : 0,
            'kualitas_kerja' => $ratings->avg_kualitas_kerja ? round($ratings->avg_kualitas_kerja, 1) : 0,
        ];
    }

    // ✅ METHOD UNTUK MENDAPATKAN REVIEW TERBARU
    public function getLatestReviewsAttribute()
    {
        return Rating::with(['user', 'project'])
            ->whereHas('project.proposalls', function($query) {
                $query->where('user_id', $this->user_id)
                      ->where('status', 'accepted');
            })
            ->whereNotNull('review')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    // ✅ METHOD UNTUK MENDAPATKAN DISTRIBUSI RATING (1-5 stars)
    public function getRatingDistributionAttribute()
    {
        $distribution = Rating::whereHas('project.proposalls', function($query) {
                $query->where('user_id', $this->user_id)
                      ->where('status', 'accepted');
            })
            ->select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        // Fill missing ratings with 0
        $result = [];
        for ($i = 5; $i >= 1; $i--) {
            $result[$i] = $distribution[$i] ?? 0;
        }

        return $result;
    }
}