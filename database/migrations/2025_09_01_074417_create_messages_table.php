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
    Schema::create('messages', function (Blueprint $table) {
        $table->id();

        $table->foreignId('chat_id')
              ->constrained('chats')
              ->cascadeOnDelete();

        // pengirim pesan (user mana saja)
        $table->foreignId('sender_id')
              ->constrained('users')
              ->cascadeOnDelete();

        // isi pesan
        $table->text('message');

        // status baca
        $table->boolean('is_read')->default(false);
        $table->timestamp('read_at')->nullable();

        $table->timestamps();

        // untuk performa urut waktu
        $table->index(['chat_id', 'created_at']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
