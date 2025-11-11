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
    Schema::create('chats', function (Blueprint $table) {
        $table->id();

        // dua peserta: client & freelancer (keduanya refer ke users.id)
        $table->foreignId('client_id')
              ->constrained('users')
              ->cascadeOnDelete();

        $table->foreignId('freelancer_id')
              ->constrained('users')
              ->cascadeOnDelete();

        // opsional: simpan ringkas info terakhir
        $table->timestamp('last_message_at')->nullable();

        $table->timestamps();

        // batasi: 1 pasangan client-freelancer hanya 1 chat
        $table->unique(['client_id', 'freelancer_id']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
