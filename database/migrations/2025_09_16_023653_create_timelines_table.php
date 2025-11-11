<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); 
            $table->enum('type', ['weekly', 'daily']); // tipe timeline
            $table->string('title'); // judul milestone
            $table->text('description')->nullable(); // deskripsi milestone
            $table->integer('week_number')->nullable(); // kalau weekly
            $table->date('due_date')->nullable(); // kalau daily
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timelines');
    }
};
