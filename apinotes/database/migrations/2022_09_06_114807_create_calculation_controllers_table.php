<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculation_controllers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('userID');
            $table->string('first');
            $table->string('second');
            $table->string('add');
            $table->string('sub');
            $table->string('multi');
            $table->string('div');
            $table->string('percenatge');
            $table->string('percenatgeIntoDigit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calculation_controllers');
    }
};
