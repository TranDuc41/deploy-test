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
        Schema::create('sale', function (Blueprint $table) {
            $table->bigIncrements('sale_id');
            $table->integer('discount');
            $table->unsignedBigInteger('room_id');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->unsignedBigInteger('ad_id');
            $table->timestamps();

            // Liên kết với bảng 'rooms' qua trường 'room_id'
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');

             // Liên kết với bảng 'admin' qua trường 'ad_id'
             $table->foreign('ad_id')->references('ad_id')->on('admin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale');
    }
};
