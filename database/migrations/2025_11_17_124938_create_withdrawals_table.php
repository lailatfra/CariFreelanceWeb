<?php
// database/migrations/2025_01_xx_create_withdrawals_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->string('withdrawal_id')->unique(); // WD-20250117-ABC123
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Freelancer
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            
            // Bank Details
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_holder_name');
            
            // Admin notes
            $table->text('admin_notes')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null'); // Admin ID
            $table->timestamp('processed_at')->nullable();
            
            // Bukti transfer dari admin
            $table->string('proof_image')->nullable();
            
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index('withdrawal_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
};