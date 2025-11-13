<?php
// database/migrations/xxxx_xx_xx_create_messages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('conversations')->cascadeOnDelete();
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            $table->text('message')->nullable(); // nullable karena bisa file saja
            
            // File attachments (stored as JSON array)
            $table->json('attachments')->nullable(); // [{name, path, size, type}]
            
            // Read status (untuk centang biru)
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            
            // Performance indexes
            $table->index(['conversation_id', 'created_at']);
            $table->index(['sender_id']);
            $table->index(['is_read']); // untuk count unread
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};