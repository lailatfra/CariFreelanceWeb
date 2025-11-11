<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('timelines', function (Blueprint $table) {
            $table->enum('status', ['belum selesai', 'selesai'])
                  ->default('belum selesai')
                  ->after('due_date'); // ganti 'kolom_sebelumnya' dengan nama kolom terakhir sebelum status
        });
    }

    public function down(): void
    {
        Schema::table('timelines', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
