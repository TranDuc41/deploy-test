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
            $table->id('customer_id');
            $table->string('prefix', 55);
            $table->string('full_name', 55);
            $table->char('email', 55)->unique(); // Thêm unique key cho email
            $table->string('address', 255);
            $table->char('phone_number', 10)->unique(); // Thêm unique key cho phone_number
            $table->char('number_cccd')->unique();
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
