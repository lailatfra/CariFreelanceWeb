<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('timeline_id')->constrained('timelines')->onDelete('cascade');
            $table->text('description'); // deskripsi progress
            $table->string('link_url'); // bisa link apa saja, bukan cuma GDrive
            $table->text('client_notes')->nullable(); // catatan opsional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_uploads');
    }
};
