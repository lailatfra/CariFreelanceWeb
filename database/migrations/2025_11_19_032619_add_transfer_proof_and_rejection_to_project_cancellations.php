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
        Schema::table('project_cancellations', function (Blueprint $table) {
            // Kolom untuk bukti transfer admin
            $table->string('transfer_proof')->nullable()->after('refund_status');
            $table->timestamp('processed_at')->nullable()->after('transfer_proof');
            
            // Kolom untuk alasan penolakan admin
            $table->text('rejection_reason')->nullable()->after('processed_at');
            $table->timestamp('rejected_at')->nullable()->after('rejection_reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_cancellations', function (Blueprint $table) {
            $table->dropColumn([
                'transfer_proof',
                'processed_at',
                'rejection_reason',
                'rejected_at'
            ]);
        });
    }
};