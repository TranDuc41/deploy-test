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
        Schema::create('room_amenities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('amenities_id');
            $table->timestamps();

            // Liên kết với bảng 'room' qua trường 'room_id'
            $table->foreign('room_id')->references('room_id')->on('room')->onDelete('cascade');

            // Liên kết với bảng 'amenities' qua trường 'amenities_id'
            $table->foreign('amenities_id')->references('amenities_id')->on('amenities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_amenities');
    }
};
