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
        Schema::create('freelancer_additional_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Basic Information
            $table->string('full_name')->nullable();
            $table->string('location')->nullable();
            $table->string('headline')->nullable();
            $table->string('category')->nullable();
            $table->string('profile_photo')->nullable();
            
            // Bio & Experience
            $table->text('bio')->nullable();
            $table->text('experience')->nullable();
            
            // Skills
            $table->text('skills')->nullable(); // Store as comma-separated
            $table->string('experience_level')->nullable();
            
            // Portfolio
            $table->string('portfolio_title')->nullable();
            $table->text('portfolio_description')->nullable();
            $table->string('portofolio_link')->nullable();
            $table->string('portfolio_category')->nullable();
            $table->string('portfolio_tech')->nullable();
            
            // Education & Certifications
            $table->string('education')->nullable();
            $table->integer('graduation_year')->nullable();
            $table->text('certifications')->nullable();
            $table->text('courses')->nullable();
            $table->json('languages')->nullable();
            
            // Rate & Availability
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->decimal('project_rate', 10, 2)->nullable();
            $table->json('service_types')->nullable();
            $table->string('availability')->nullable();
            $table->string('response_time')->nullable();
            
            // Stats
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('review_count')->default(0);
            $table->integer('project_count')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_profiles');
    }
};