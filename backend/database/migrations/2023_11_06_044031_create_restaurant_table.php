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
        Schema::create('restaurant', function (Blueprint $table) {
            $table->bigIncrements('restaurant_id');
            $table->string('name', 55);
            $table->string('slug', 100);
            $table->unsignedBigInteger('img_id');
            $table->text('description');
            $table->timestamps();

            // Liên kết với bảng 'images' qua trường 'img_id'
            $table->foreign('img_id')->references('img_id')->on('images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant');
    }
};
