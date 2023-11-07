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
        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('customer_id');
            $table->string('first_name', 55);
            $table->string('last_name', 55);
            $table->string('email', 55);
            $table->string('address', 100);
            $table->string('phone_number', 10);
            $table->string('number_cccd', 12);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
