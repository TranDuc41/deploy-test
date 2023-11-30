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
        Schema::create('reservations_room', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reservations_id');
            $table->unsignedBigInteger('room_id');
            $table->timestamps();
            $table->foreign('reservations_id')->references('reservations_id')->on('reservations')->onDelete('cascade');
            $table->foreign('room_id')->references('room_id')->on('room')->onDelete('cascade');
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
