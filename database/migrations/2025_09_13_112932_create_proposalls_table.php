<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proposalls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->nullable(); // relasi ke tabel jobs/projects
            $table->unsignedBigInteger('user_id'); // siapa yang submit proposal

            $table->string('proposal_title');
            $table->longText('proposal_description');

            $table->bigInteger('proposal_price');
            $table->string('timeline');

            $table->json('skills')->nullable();
            $table->longText('experience')->nullable();

            $table->string('portfolio_links')->nullable();
            $table->json('files')->nullable(); // simpan array path file
            $table->longText('additional_message')->nullable();

            $table->timestamps();

            // opsional: foreign key
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposalls');
    }
};
