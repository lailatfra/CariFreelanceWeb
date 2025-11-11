<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proposalls', function (Blueprint $table) {
            $table->string('proposal_title')->nullable()->change();
            $table->string('timeline')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('proposalls', function (Blueprint $table) {
            $table->string('proposal_title')->nullable(false)->change();
            $table->string('timeline')->nullable(false)->change();
        });
    }
};
