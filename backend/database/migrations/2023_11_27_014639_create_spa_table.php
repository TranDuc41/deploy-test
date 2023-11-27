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
        Schema::create('spa', function (Blueprint $table) {
            $table->bigIncrements('sw_id');
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->string('spa_menu', 100);
            $table->time('time_open');
            $table->time('time_close');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spa');
    }
};
