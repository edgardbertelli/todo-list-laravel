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
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->index();
            $table->tinyText('description')->nullable();
            $table->timestamp('deadline');
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignUuid('user_id');
            $table->foreignUuid('checklist_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
