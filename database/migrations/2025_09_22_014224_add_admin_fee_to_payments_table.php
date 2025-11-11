<?php
// database/migrations/xxxx_xx_xx_add_admin_fee_to_payments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Tambah kolom baru setelah kolom amount
            $table->decimal('service_amount', 15, 2)->after('amount')->nullable()->comment('Harga jasa freelancer tanpa admin fee');
            $table->decimal('admin_fee', 15, 2)->after('service_amount')->nullable()->comment('Biaya admin platform 2.5%');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['service_amount', 'admin_fee']);
        });
    }
};