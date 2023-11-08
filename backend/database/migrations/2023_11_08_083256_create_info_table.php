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
        Schema::create('info', function (Blueprint $table) {
            $table->bigIncrements('info_id');
            $table->string('title', 55);
            $table->text('link')->nullable();
            $table->unsignedBigInteger('hotel_id');
            $table->string('content', 255)->nullable();
            $table->timestamps();

            // Liên kết với bảng 'hotels' qua trường 'hotel_id'
            $table->foreign('hotel_id')->references('hotel_id')->on('hotels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info');
    }
};
