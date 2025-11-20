<?php
// database/migrations/2024_01_20_000001_create_admin_wallets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admin_wallets', function (Blueprint $table) {
            $table->id();
            $table->decimal('service_balance', 15, 2)->default(0)->comment('Saldo murni untuk transfer ke freelancer');
            $table->decimal('admin_fee_balance', 15, 2)->default(0)->comment('Saldo dari biaya admin platform (keuntungan)');
            $table->decimal('total_balance', 15, 2)->default(0)->comment('Total saldo keseluruhan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_wallets');
    }
};