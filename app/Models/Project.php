<?php
// app/Models/Project.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\ProjectCancellation;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'category', 'subcategory', 'experience_level',
        'project_type', 'skills_required', 'description', 'requirements',
        'deliverables', 'attachments', 'budget_type', 'fixed_budget',
        'min_budget', 'max_budget', 'payment_method', 'dp_percentage', 'timeline_type',
        'timeline_duration', 'deadline', 'urgency', 'additional_info',
        'status', 'posted_at',
        'cancellation_status',
        
    ];

    protected $casts = [
        'skills_required' => 'array',
        'attachments' => 'array',
        'posted_at' => 'datetime',
        'deadline' => 'datetime',
        'fixed_budget' => 'decimal:0',
        'min_budget' => 'decimal:0', 
        'max_budget' => 'decimal:0',
        'timeline_duration' => 'integer',
        'dp_percentage' => 'integer'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'open')->whereNotNull('posted_at');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // File attachment methods (unchanged)
    public function hasImage()
    {
        if (empty($this->attachments)) {
            return false;
        }

        foreach ($this->attachments as $attachment) {
            if (isset($attachment['file_type']) && $attachment['file_type'] === 'image') {
                return true;
            }
            
            if (isset($attachment['mime_type']) && 
                strpos($attachment['mime_type'], 'image/') === 0) {
                return true;
            }
        }

        return false;
    }

    public function hasVideo()
    {
        if (empty($this->attachments)) {
            return false;
        }

        foreach ($this->attachments as $attachment) {
            if (isset($attachment['file_type']) && $attachment['file_type'] === 'video') {
                return true;
            }
        }

        return false;
    }

    public function hasDocument()
    {
        if (empty($this->attachments)) {
            return false;
        }

        foreach ($this->attachments as $attachment) {
            if (isset($attachment['file_type']) && $attachment['file_type'] === 'document') {
                return true;
            }
        }

        return false;
    }

    public function getImageUrlAttribute()
    {
        if (!$this->hasImage()) {
            return asset('images/default-project.jpg');
        }

        foreach ($this->attachments as $attachment) {
            if ((isset($attachment['file_type']) && $attachment['file_type'] === 'image') ||
                (isset($attachment['mime_type']) && strpos($attachment['mime_type'], 'image/') === 0)) {
                
                if (isset($attachment['path'])) {
                    return asset('storage/' . $attachment['path']);
                }
            }
        }

        return asset('images/default-project.jpg');
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->hasImage()) {
            return $this->image_url;
        }

        foreach ($this->attachments as $attachment) {
            if (isset($attachment['thumbnail'])) {
                return asset($attachment['thumbnail']);
            }
            
            if (isset($attachment['file_type'])) {
                switch ($attachment['file_type']) {
                    case 'video':
                        return asset('images/thumbnails/video-thumbnail.png');
                    case 'document':
                        $extension = $attachment['extension'] ?? 'doc';
                        return $this->getDocumentThumbnail($extension);
                    default:
                        return asset('images/thumbnails/file-thumbnail.png');
                }
            }
        }

        return asset('images/default-project.jpg');
    }

    private function getDocumentThumbnail($extension)
    {
        $thumbnails = [
            'pdf' => 'images/thumbnails/pdf-thumbnail.png',
            'doc' => 'images/thumbnails/word-thumbnail.png',
            'docx' => 'images/thumbnails/word-thumbnail.png',
        ];

        return asset($thumbnails[$extension] ?? 'images/thumbnails/document-thumbnail.png');
    }

    // Updated budget formatting method
    public function getFormattedBudgetAttribute()
    {
        switch ($this->budget_type) {
            case 'fixed':
                return 'Rp ' . number_format($this->fixed_budget, 0, ',', '.');
                
            case 'range':
                return 'Rp ' . number_format($this->min_budget, 0, ',', '.') . 
                       ' - Rp ' . number_format($this->max_budget, 0, ',', '.');
                
            default:
                return 'Budget belum ditentukan';
        }
    }

    // New method to get payment method text
    public function getPaymentMethodTextAttribute()
    {
        switch ($this->payment_method) {
            case 'full':
                return 'Bayar Lunas';
            case 'dp_and_final':
                return 'DP ' . $this->dp_percentage . '% + Pelunasan ' . (100 - $this->dp_percentage) . '%';
            default:
                return 'Belum ditentukan';
        }
    }

    // New method to calculate DP amount
    public function getDpAmountAttribute()
    {
        if ($this->payment_method !== 'dp_and_final' || !$this->dp_percentage) {
            return 0;
        }

        $totalBudget = 0;
        if ($this->budget_type === 'fixed') {
            $totalBudget = $this->fixed_budget;
        } elseif ($this->budget_type === 'range') {
            // Use minimum budget for DP calculation
            $totalBudget = $this->min_budget;
        }

        return ($totalBudget * $this->dp_percentage) / 100;
    }

    // New method to calculate final payment amount
    public function getFinalAmountAttribute()
    {
        if ($this->payment_method !== 'dp_and_final' || !$this->dp_percentage) {
            return $this->budget_type === 'fixed' ? $this->fixed_budget : $this->min_budget;
        }

        $totalBudget = 0;
        if ($this->budget_type === 'fixed') {
            $totalBudget = $this->fixed_budget;
        } elseif ($this->budget_type === 'range') {
            $totalBudget = $this->min_budget;
        }

        return $totalBudget - $this->dp_amount;
    }

    // Updated timeline text method
    public function getTimelineTextAttribute()
    {
        if (!$this->timeline_duration) {
            return 'Belum ditentukan';
        }

        $weeks = $this->timeline_duration;
        
        if ($weeks == 1) {
            return '1 Minggu';
        } elseif ($weeks < 4) {
            return $weeks . ' Minggu';
        } elseif ($weeks == 4) {
            return '1 Bulan';
        } elseif ($weeks == 8) {
            return '2 Bulan';
        } elseif ($weeks == 12) {
            return '3 Bulan';
        } elseif ($weeks == 16) {
            return '4 Bulan';
        } elseif ($weeks == 24) {
            return '6 Bulan';
        } else {
            // For other cases, convert to months if >= 4 weeks
            if ($weeks >= 4) {
                $months = round($weeks / 4, 1);
                return $months . ' Bulan';
            } else {
                return $weeks . ' Minggu';
            }
        }
    }

    // Method to get deadline status
    public function getDeadlineStatusAttribute()
    {
        if (!$this->deadline) {
            return 'no_deadline';
        }

        $now = Carbon::now();
        $deadline = Carbon::parse($this->deadline);
        $daysRemaining = $now->diffInDays($deadline, false);

        if ($daysRemaining < 0) {
            return 'overdue';
        } elseif ($daysRemaining <= 3) {
            return 'urgent';
        } elseif ($daysRemaining <= 7) {
            return 'soon';
        } else {
            return 'normal';
        }
    }

    // Method to get days remaining until deadline
    public function getDaysRemainingAttribute()
    {
        if (!$this->deadline) {
            return null;
        }

        $now = Carbon::now();
        $deadline = Carbon::parse($this->deadline);
        return $now->diffInDays($deadline, false);
    }

    // Method to get formatted deadline
    public function getFormattedDeadlineAttribute()
    {
        if (!$this->deadline) {
            return 'Tidak ada deadline';
        }

        $deadline = Carbon::parse($this->deadline);
        return $deadline->format('d M Y');
    }

    // Di Model Project
public function getAttachmentsByType($type = null)
{
    if (empty($this->attachments)) {
        return [];
    }

    // Jika attachments adalah array, proses seperti biasa
    if (is_array($this->attachments)) {
        $result = [];
        foreach ($this->attachments as $attachment) {
            $fileType = $attachment['file_type'] ?? 'other';
            
            if ($type === null || $fileType === $type) {
                $url = null;
                if (isset($attachment['path'])) {
                    // Pastikan path benar
                    $url = asset('storage/' . $attachment['path']);
                }

                if ($url) {
                    $result[] = [
                        'url' => $url,
                        'original_name' => $attachment['original_name'] ?? 'File',
                        'file_type' => $fileType,
                        'size' => $attachment['size'] ?? 0,
                        'extension' => $attachment['extension'] ?? '',
                        'mime_type' => $attachment['mime_type'] ?? '',
                        'thumbnail' => isset($attachment['thumbnail']) ? asset($attachment['thumbnail']) : null
                    ];
                }
            }
        }
        return $result;
    }

    return [];
}

// Method untuk mendapatkan semua gambar
public function getImages()
{
    return $this->getAttachmentsByType('image');
}

// Method untuk mendapatkan semua video
public function getVideos()
{
    return $this->getAttachmentsByType('video');
}

// Method untuk mendapatkan semua dokumen
public function getDocuments()
{
    return $this->getAttachmentsByType('document');
}

// Method untuk mendapatkan attachment utama
public function getMainAttachmentAttribute()
{
    $images = $this->getImages();
    if (!empty($images)) {
        return $images[0];
    }
    
    $videos = $this->getVideos();
    if (!empty($videos)) {
        return $videos[0];
    }
    
    $documents = $this->getDocuments();
    if (!empty($documents)) {
        return $documents[0];
    }

    return null;
}

    public function getTotalFileSizeAttribute()
    {
        if (empty($this->attachments)) {
            return 0;
        }

        $totalSize = 0;
        foreach ($this->attachments as $attachment) {
            $totalSize += $attachment['size'] ?? 0;
        }

        return $totalSize;
    }

    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->total_file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getAttachmentInfoAttribute()
    {
        if (empty($this->attachments)) {
            return null;
        }

        $totalFiles = count($this->attachments);
        $images = count($this->getImages());
        $videos = count($this->getVideos());
        $documents = count($this->getDocuments());
        
        $info = [];
        if ($images > 0) $info[] = $images . ' gambar';
        if ($videos > 0) $info[] = $videos . ' video';
        if ($documents > 0) $info[] = $documents . ' dokumen';
        
        return [
            'total' => $totalFiles,
            'description' => implode(', ', $info),
            'size' => $this->formatted_file_size
        ];
    }

    public function getUrgencyTextAttribute()
    {
        $urgencyMap = [
            'normal' => 'Normal',
            'urgent' => 'Segera',
            'asap' => 'Sangat Mendesak'
        ];

        return $urgencyMap[$this->urgency] ?? 'Normal';
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function clientProfile()
    {
        return $this->hasOneThrough(
            ClientProfile::class,
            User::class,
            'id',        // Foreign key di users
            'user_id',   // Foreign key di client_profiles
            'client_id', // Foreign key di projects
            'id'         // Local key di users
        );
    }

    public function proposalls()
    {
        return $this->hasMany(Proposal::class, 'project_id');
    }

    public function timelines()
    {
        return $this->hasMany(Timeline::class);
    }

    public function getProgressAttribute()
    {
        $totalTimelines = $this->timelines()->count();
        
        if ($totalTimelines === 0) {
            return 0;
        }
        
        $completedTimelines = $this->timelines()->where('status', 'selesai')->count();
        
        return round(($completedTimelines / $totalTimelines) * 100, 0);
    }

    public function submitProjects()
    {
        return $this->hasMany(SubmitProject::class, 'project_id', 'id');
    }

    /**
     * Check if project is cancelled
     */
    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    /**
     * Get cancellation reason if exists
     */
    public function getCancellationReasonAttribute()
    {
        return $this->cancellation ? $this->cancellation->reason : null;
    }

    public function cancellation()
{
    return $this->hasOne(ProjectCancellation::class);
}

public function projectCancellation()
{
    return $this->hasOne(ProjectCancellation::class);
}



}