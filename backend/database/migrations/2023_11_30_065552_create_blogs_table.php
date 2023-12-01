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
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('blog_id');
            $table->string('title', 55);
            $table->string('slug', 100);
            $table->unsignedBigInteger('user_id');
            $table->string('short_desc', 255)->nullable();
            $table->text('description');
            $table->integer('read_time');
            $table->integer('action');
            $table->unsignedBigInteger('categories_id');
            $table->timestamps();

            // Liên kết với bảng 'users' qua trường 'user_id'
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('categories_id')->references('categories_id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
