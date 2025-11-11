<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_additional_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Company Information
            $table->string('company_name')->nullable();
            $table->string('industry')->nullable();
            $table->string('company_size')->nullable();
            $table->text('company_description')->nullable();
            $table->string('website')->nullable();
            
            // Vision & Mission
            $table->text('company_vision')->nullable();
            $table->text('company_mission')->nullable();
            $table->text('company_values')->nullable();
            $table->text('company_goals')->nullable();
            
            // Communication Preferences
            $table->json('communication_platforms')->nullable(); // Store as JSON array
            $table->string('update_frequency')->nullable();
            $table->string('timezone')->nullable();
            
            // Social Media
            $table->string('social_website')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_facebook')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_tiktok')->nullable();
            $table->text('social_other')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_additional_infos');
    }
};