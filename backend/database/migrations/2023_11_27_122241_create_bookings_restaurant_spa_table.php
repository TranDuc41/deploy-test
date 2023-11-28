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
        Schema::create('bookings_restaurant_spa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sw_id')->nullable();
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->string('full_name', 55);
            $table->string('phone_number', 20);
            $table->string('date_time', 100);
            $table->string('email', 100);
            $table->string('note', 120)->nullable();
            $table->timestamps();

            $table->foreign('sw_id')->references('sw_id')->on('spa')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('restaurant_id')->on('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings_restaurant_spa');
    }
};
