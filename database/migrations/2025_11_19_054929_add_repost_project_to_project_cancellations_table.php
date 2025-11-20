<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('project_cancellations', function (Blueprint $table) {
            $table->boolean('repost_project')->default(false)->after('rejection_reason');
        });
    }

    public function down()
    {
        Schema::table('project_cancellations', function (Blueprint $table) {
            $table->dropColumn('repost_project');
        });
    }
};