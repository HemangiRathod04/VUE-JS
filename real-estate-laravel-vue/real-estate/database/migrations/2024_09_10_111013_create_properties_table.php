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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('property_type');
            $table->unsignedTinyInteger('status')->default(1)->comment('1 = Available, 2 = Pending, 3 = Sold, 4 = Rented, 5 = Under Maintenance, 6 = Off Market, 7 = Expired, 8 = Draft');
            $table->decimal('price', 15, 2);
            $table->integer('area')->comment('Square feet');
            $table->integer('rooms');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('country');
            $table->string('state');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
