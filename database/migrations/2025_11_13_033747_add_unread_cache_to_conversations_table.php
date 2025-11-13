<?php
// database/migrations/xxxx_xx_xx_add_unread_cache_to_conversations.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            // Cache unread count untuk client & freelancer (avoid COUNT query)
            $table->unsignedInteger('client_unread_count')->default(0)->after('last_message_at');
            $table->unsignedInteger('freelancer_unread_count')->default(0)->after('client_unread_count');
            
            // Last message preview (untuk list conversations tanpa JOIN)
            $table->text('last_message_preview')->nullable()->after('freelancer_unread_count');
            
            // Index untuk sorting by unread
            $table->index(['client_id', 'client_unread_count']);
            $table->index(['freelancer_id', 'freelancer_unread_count']);
        });
    }

    public function down(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropColumn(['client_unread_count', 'freelancer_unread_count', 'last_message_preview']);
        });
    }
};