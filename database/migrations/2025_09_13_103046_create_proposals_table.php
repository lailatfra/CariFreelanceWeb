<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id'); // relasi ke jobs
            $table->unsignedBigInteger('user_id'); // freelancer yang submit proposal

            $table->string('proposal_title');
            $table->longText('proposal_description');
            $table->decimal('proposal_price', 15, 2);
            $table->string('timeline');
            $table->text('skills')->nullable();
            $table->longText('experience')->nullable();
            $table->string('portfolio_links')->nullable();
            $table->json('files')->nullable(); // simpan path file upload
            $table->longText('additional_message')->nullable();

            $table->timestamps();

            // relasi opsional
            // $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
