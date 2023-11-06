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
        Schema::create('rooms_booked', function (Blueprint $table) {
            $table->bigIncrements('room_booked_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('booking_id');
            $table->string('price', 10);
            $table->integer('number_people');
            $table->timestamps();

            // Liên kết với bảng 'rooms' qua trường 'room_id'
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');

            // Liên kết với bảng 'bookings' qua trường 'booking_id'
            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms_booked');
    }
};
