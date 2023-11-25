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
        Schema::create('reservations_keep_room', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reservations_id');
            $table->unsignedBigInteger('keep_room_id');
            $table->timestamps();

            $table->foreign('reservations_id')->references('reservations_id')->on('reservations')->onDelete('cascade');
            $table->foreign('keep_room_id')->references('keep_room_id')->on('keep_rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations_keep_room');
    }
};
