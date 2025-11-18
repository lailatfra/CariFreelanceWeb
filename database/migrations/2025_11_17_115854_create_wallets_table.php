<?php
// database/migrations/2025_01_xx_create_wallets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tabel untuk menyimpan saldo freelancer
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->decimal('pending_balance', 15, 2)->default(0.00); // Saldo yang belum bisa ditarik
            $table->timestamps();

            $table->unique('user_id');
            $table->index('balance');
        });

        // Tabel untuk history transaksi saldo
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type', ['credit', 'debit']); // credit = masuk, debit = keluar
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('completed');
            $table->decimal('amount', 15, 2);
            $table->string('description');
            $table->decimal('balance_before', 15, 2);
            $table->decimal('balance_after', 15, 2);
            $table->timestamps();

            $table->index(['wallet_id', 'created_at']);
            $table->index('payment_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallet_transactions');
        Schema::dropIfExists('wallets');
    }
};