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
        Schema::create('keep_rooms', function (Blueprint $table) {
            $table->id('keep_room_id');
            $table->timestamp('start_date')->nullable()->useCurrent(); 
            $table->timestamp('end_date')->nullable()->useCurrent();
            $table->integer('adults');
            $table->integer('children')->nullable();
            $table->timestamps();

            //khoa ngoai
            $table->unsignedBigInteger('room_id');
             // Liên kết với bảng 'room' qua trường 'room_id'
             $table->foreign('room_id')->references('room_id')->on('room')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keep_rooms');
    }
};
