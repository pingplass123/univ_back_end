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
        Schema::create('coures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userID')->unsigned();
            $table->foreign('userID')->references('id')->on('users');
            $table->bigInteger('sub_id')->unsigned();
            $table->foreign('sub_id')->references('id')->on('subcategories');
            $table->string('title');
            $table->text('body');
            $table->json('hastag')->nullable();
            $table->json('videoList')->nullable();
            $table->string('nameCreate');
            $table->longtext('image');
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
        Schema::dropIfExists('coures');
    }
};