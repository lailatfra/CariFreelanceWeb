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
        Schema::create('project_cancellations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Client yang cancel
            $table->enum('project_status', ['open', 'working'])->default('open'); // Status saat dicancel
            $table->text('reason'); // Alasan pembatalan
            $table->json('evidence_files')->nullable(); // File bukti (array of paths)
            $table->string('bank_name')->nullable(); // Nama bank untuk refund
            $table->string('account_number')->nullable(); // Nomor rekening
            $table->decimal('refund_amount', 10, 2)->nullable(); // Jumlah refund
            $table->enum('refund_status', ['pending', 'processed', 'completed'])->default('pending');
            $table->timestamp('cancelled_at')->useCurrent();
            $table->timestamps();
            
            // Indexes
            $table->index('project_id');
            $table->index('user_id');
            $table->index('project_status');
            $table->index('refund_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_cancellations');
    }
};