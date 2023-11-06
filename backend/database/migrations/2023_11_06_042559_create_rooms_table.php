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
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('room_id');
            $table->string('title', 100);
            $table->string('slug', 100);
            $table->integer('price')->notNull();
            $table->integer('adults')->notNull();
            $table->integer('children')->notNull();
            $table->text('description');
            $table->unsignedBigInteger('rty_id');
            $table->unsignedBigInteger('amenities_id');
            $table->unsignedBigInteger('packages_id');
            $table->unsignedBigInteger('img_id');
            $table->timestamps();

            // Liên kết với bảng 'room_types' qua trường 'rty_id'
            $table->foreign('rty_id')->references('rty_id')->on('room_types')->onDelete('cascade');

            // Liên kết với bảng 'amenities' qua trường 'amenities_id'
            $table->foreign('amenities_id')->references('amenities_id')->on('amenities')->onDelete('cascade');

            // Liên kết với bảng 'packages' qua trường 'packages_id'
            $table->foreign('packages_id')->references('packages_id')->on('packages')->onDelete('cascade');

            // Liên kết với bảng 'images' qua trường 'img_id'
            $table->foreign('img_id')->references('img_id')->on('images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
