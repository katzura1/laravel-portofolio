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
        Schema::create('project_stacks', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('id_project')->references('id')->on('projects');
            $table->foreignId('id_stacks')->references('id')->on('stacks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_stacks');
    }
};
