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
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('booking_id');
            $table->unsignedBigInteger('ad_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->integer('status');
            $table->timestamps();

            // Liên kết với bảng 'admin' qua trường 'ad_id'
            $table->foreign('ad_id')->references('ad_id')->on('admin')->onDelete('cascade');

            // Liên kết với bảng 'customer' qua trường 'customer_id'
            $table->foreign('customer_id')->references('customer_id')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
