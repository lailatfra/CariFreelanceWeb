<?php
// database/migrations/2024_01_01_000000_create_projects_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Step 1 fields
            $table->string('title');
            $table->string('category');
            $table->string('subcategory')->nullable();
            $table->enum('experience_level', ['entry', 'intermediate', 'expert']);
            $table->enum('project_type', ['one-time', 'ongoing', 'contract']);
            $table->json('skills_required'); // Array of required skills
            
            // Step 2 fields
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->text('deliverables');
            $table->json('attachments')->nullable(); 
            
            // Step 3 fields
            $table->enum('budget_type', ['fixed', 'range', 'hourly']);
            $table->decimal('fixed_budget', 15, 2)->nullable();
            $table->decimal('min_budget', 15, 2)->nullable();
            $table->decimal('max_budget', 15, 2)->nullable();
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->integer('estimated_hours')->nullable();
            $table->string('timeline');
            $table->enum('urgency', ['normal', 'urgent', 'asap'])->default('normal');
            $table->text('milestones')->nullable();
            $table->text('additional_info')->nullable();
            
            // Project status and metadata
            $table->enum('status', ['draft', 'open', 'in_progress', 'completed', 'cancelled', 'paused'])->default('open');
            $table->timestamp('posted_at')->nullable();
            $table->timestamp('deadline')->nullable();
            
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['status', 'posted_at']);
            $table->index(['category', 'status']);
            $table->index(['user_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};