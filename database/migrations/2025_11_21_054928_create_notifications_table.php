<?php
// database/migrations/2025_01_XX_create_notifications_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Penerima notifikasi
            $table->string('type'); // proposal_received, proposal_accepted, proposal_rejected, project_submitted, project_approved, project_revision, payment_received
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable(); // Data tambahan (project_id, proposal_id, amount, dll)
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            // Indexes untuk performa
            $table->index('user_id');
            $table->index('type');
            $table->index('is_read');
            $table->index('created_at');

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};