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
        Schema::create('room_package', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('packages_id');
            $table->timestamps();

            // Liên kết với bảng 'room' qua trường 'room_id'
            $table->foreign('room_id')->references('room_id')->on('room')->onDelete('cascade');

            // Liên kết với bảng 'packages' qua trường 'packages_id'
            $table->foreign('packages_id')->references('packages_id')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_package');
    }
};
