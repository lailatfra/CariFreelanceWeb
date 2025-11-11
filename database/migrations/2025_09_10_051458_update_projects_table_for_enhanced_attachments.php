<?php
// database/migrations/2024_XX_XX_update_projects_table_for_enhanced_attachments.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Karena kita menggunakan JSON untuk attachments, tidak perlu menambah kolom baru
        // Migration ini hanya untuk memastikan struktur tabel sudah benar
        
        // Pastikan folder thumbnails ada
        $thumbnailPath = public_path('images/thumbnails');
        if (!file_exists($thumbnailPath)) {
            mkdir($thumbnailPath, 0755, true);
        }

        // Buat file thumbnail default jika belum ada
        $this->createDefaultThumbnails();
    }

    public function down()
    {
        // Tidak ada yang perlu di-rollback
    }

    private function createDefaultThumbnails()
    {
        // Kita akan membuat placeholder SVG untuk thumbnail
        $thumbnails = [
            'pdf-thumbnail.png' => $this->createSvgThumbnail('#dc2626', 'fas fa-file-pdf', 'PDF'),
            'word-thumbnail.png' => $this->createSvgThumbnail('#2563eb', 'fas fa-file-word', 'DOC'),
            'video-thumbnail.png' => $this->createSvgThumbnail('#ef4444', 'fas fa-video', 'VIDEO'),
            'document-thumbnail.png' => $this->createSvgThumbnail('#6b7280', 'fas fa-file', 'FILE'),
            'file-thumbnail.png' => $this->createSvgThumbnail('#8b5cf6', 'fas fa-file-alt', 'FILE')
        ];

        foreach ($thumbnails as $filename => $svgContent) {
            $filePath = public_path('images/thumbnails/' . $filename);
            if (!file_exists($filePath)) {
                // Convert SVG to PNG menggunakan GD atau ImageMagick
                // Untuk sekarang, kita simpan sebagai SVG dengan ekstensi PNG
                file_put_contents($filePath, $svgContent);
            }
        }
    }

    private function createSvgThumbnail($color, $icon, $text)
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
<svg width="160" height="120" viewBox="0 0 160 120" fill="none" xmlns="http://www.w3.org/2000/svg">
  <rect width="160" height="120" rx="8" fill="#f8f9fa"/>
  <rect x="20" y="20" width="120" height="80" rx="4" fill="' . $color . '"/>
  <text x="80" y="70" font-family="Arial" font-size="12" fill="white" text-anchor="middle">' . $text . '</text>
</svg>';
    }
};