<?php
// database/migrations/xxxx_xx_xx_create_conversations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('freelancer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('proposal_id')->constrained('proposalls')->cascadeOnDelete();
            
            // Performance indexes
            $table->index(['client_id', 'freelancer_id']);
            $table->index(['project_id']);
            
            // Last activity tracking
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();
            
            // Ensure unique conversation per project
            $table->unique(['project_id', 'client_id', 'freelancer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};