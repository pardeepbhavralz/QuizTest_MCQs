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
        Schema::create('questions_ans', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id ');
            $table->string('question');
            $table->string('optionA');
            $table->string('optionB');
            $table->string('optionC');
            $table->string('optionD');
            $table->string('correctAnswer');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions_ans');
    }
};
