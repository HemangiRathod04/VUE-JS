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
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('from_shift');
            $table->dropColumn('to_shift');
            $table->dropColumn('schedule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('from_shift', 20)->nullable();
            $table->string('to_shift', 20)->nullable();
            $table->json('schedule')->nullable();
        });
    }
};
