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
            $table->timestamp('start_date')->nullable()->useCurrent(); 
            $table->timestamp('end_date')->nullable()->useCurrent();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // Liên kết với bảng 'users' qua trường 'user_id'
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
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
