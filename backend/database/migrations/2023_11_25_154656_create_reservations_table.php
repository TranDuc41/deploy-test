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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservations_id');
            $table->char('method', 10)->nullable();; // phương thức đặt (online đặt tại website/offline đặt tại khách sạn)
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->integer('adults');
            $table->integer('children');
            $table->string('note', 255)->nullable();
            $table->timestamps();
            //tao khoa ngoai
            
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('customer_id')->references('customer_id')->on('customer')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
