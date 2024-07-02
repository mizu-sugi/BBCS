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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->enum('subtype', [
                'hormone_positive_her2_negative', 
                'hormone_positive_her2_positive', 
                'hormone_negative_her2_positive', 
                'triple_negative'
            ])->nullable();
            $table->enum('stage', [
                'stage0', 
                'stage1', 
                'stage2', 
                'stage3', 
                'stage4'
            ])->nullable();
            $table->json('current_treatment')->nullable();
            $table->text('introduction')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
