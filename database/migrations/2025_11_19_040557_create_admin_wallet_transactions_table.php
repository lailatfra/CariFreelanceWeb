<?php
// database/migrations/2024_01_20_000002_create_admin_wallet_transactions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admin_wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_wallet_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('withdrawal_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type', ['credit_service', 'credit_admin_fee', 'debit_transfer'])->comment('Jenis transaksi');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('completed');
            $table->decimal('amount', 15, 2);
            $table->text('description');
            $table->decimal('service_balance_before', 15, 2)->default(0);
            $table->decimal('service_balance_after', 15, 2)->default(0);
            $table->decimal('admin_fee_balance_before', 15, 2)->default(0);
            $table->decimal('admin_fee_balance_after', 15, 2)->default(0);
            $table->decimal('total_balance_before', 15, 2)->default(0);
            $table->decimal('total_balance_after', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_wallet_transactions');
    }
};