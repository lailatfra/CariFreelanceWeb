<?php
// database/migrations/xxxx_add_escrow_fields_to_payments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Track apakah dana sudah direlease ke freelancer
            $table->boolean('is_released_to_freelancer')->default(false)->after('paid_at');
            $table->timestamp('released_at')->nullable()->after('is_released_to_freelancer');
            $table->text('release_notes')->nullable()->after('released_at');
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['is_released_to_freelancer', 'released_at', 'release_notes']);
        });
    }
};