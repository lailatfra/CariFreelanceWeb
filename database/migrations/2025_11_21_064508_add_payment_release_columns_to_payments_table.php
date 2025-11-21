<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Add columns for payment release tracking
            $table->boolean('is_released_to_freelancer')->default(false)->after('status');
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