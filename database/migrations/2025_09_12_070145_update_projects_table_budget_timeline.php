<?php
// database/migrations/xxxx_xx_xx_xxxxxx_update_projects_table.php

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
        Schema::table('projects', function (Blueprint $table) {
            // Remove unused columns
            $table->dropColumn([
                'hourly_rate',
                'estimated_hours', 
                'timeline',
                'milestones'
            ]);
            
            // Add new columns
            $table->enum('payment_method', ['full', 'dp_and_final'])->after('budget_type');
            $table->integer('dp_percentage')->nullable()->after('payment_method');
            $table->integer('timeline_duration')->after('dp_percentage'); // in weeks
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Restore old columns
            $table->decimal('hourly_rate', 10, 0)->nullable()->after('max_budget');
            $table->integer('estimated_hours')->nullable()->after('hourly_rate');
            $table->string('timeline')->after('estimated_hours');
            $table->text('milestones')->nullable()->after('deadline');
            
            // Remove new columns
            $table->dropColumn([
                'payment_method',
                'dp_percentage',
                'timeline_duration'
            ]);
        });
    }
};