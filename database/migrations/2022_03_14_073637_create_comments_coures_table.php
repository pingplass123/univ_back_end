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
        Schema::create('couresComment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userID')->unsigned();
            $table->foreign('userID')->references('id')->on('users');
            $table->bigInteger('couresID')->unsigned();
            $table->foreign('couresID')->references('id')->on('coures');
            $table->string('description');
            $table->decimal('score');
            $table->string('nameCreate');
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
        Schema::dropIfExists('couresComment');
    }
};