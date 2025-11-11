<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Update client_profiles
        Schema::table('client_profiles', function (Blueprint $table) {
            // Reputasi
            $table->decimal('rating', 3, 2)->default(0)->after('bio'); 
            $table->unsignedInteger('review_count')->default(0)->after('rating'); 
            $table->unsignedInteger('project_count')->default(0)->after('review_count'); 
        });

        // Update freelancer_profiles
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            // Dokumen verifikasi
            $table->string('identity_document')->nullable()->after('bio'); 
            $table->string('npwp')->nullable()->after('identity_document');

            // Preferensi kerja
            $table->decimal('hourly_rate', 10, 2)->nullable()->after('npwp');
            $table->string('languages')->nullable()->after('hourly_rate');
            $table->enum('work_type', ['remote', 'hybrid', 'fulltime'])->nullable()->after('languages');

            // Reputasi
            $table->decimal('rating', 3, 2)->default(0)->after('work_type'); 
            $table->unsignedInteger('review_count')->default(0)->after('rating'); 
            $table->unsignedInteger('project_count')->default(0)->after('review_count'); 
        });
    }

    public function down(): void
    {
        Schema::table('client_profiles', function (Blueprint $table) {
            $table->dropColumn(['rating', 'review_count', 'project_count']);
        });

        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'identity_document', 'npwp', 'hourly_rate',
                'languages', 'work_type',
                'rating', 'review_count', 'project_count',
            ]);
        });
    }
};


