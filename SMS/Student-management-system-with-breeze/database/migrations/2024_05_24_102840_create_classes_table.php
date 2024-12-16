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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('year',10);
            $table->string('section',10);
            $table->unsignedBigInteger('teacher_id');
            $table->tinyInteger('status')->default(0)->comment('1=active,0=inactive');
            $table->softDeletes();
        
            $table->timestamps();
            $table->foreign('teacher_id')->references('id')->on('teachers');
   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
