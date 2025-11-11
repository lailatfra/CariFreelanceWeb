<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proposalls', function (Blueprint $table) {
            $table->enum('status', ['pending', 'accepted', 'rejected'])
                  ->default('pending')
                  ->after('additional_message');
        });
    }

    public function down(): void
    {
        Schema::table('proposalls', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

