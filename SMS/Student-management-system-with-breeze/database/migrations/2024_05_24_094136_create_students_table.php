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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('gr_no',30)->unique();
            $table->string('first_name',20);
            $table->string('middle_name',20);
            $table->string('last_name',20);
            $table->string('photo')->nullable();
            $table->string('phone',20);
            $table->text('current_address');
            $table->text('permanent_address',);
            $table->string('email',50)->nullable()->unique();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->json('schedule')->nullable();
            $table->string('from_shift',20);
            $table->string('to_shift',20);
            $table->date('date_of_birth',20);
            $table->date('joining_date',20)->nullable(); 
            $table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
            $table->string('emergency_contact',20);
            $table->string('blood_group')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
