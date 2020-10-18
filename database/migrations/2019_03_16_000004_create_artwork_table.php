<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artworks', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            //a submission id can be nullable if the user only created the artwork to be displayed on
            //his/her profile page
            $table->integer('submission_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('medium');
            $table->text('description');
            $table->string('submission_photo_url')->nullable();
            $table->string('public_photo_url')->nullable();
            $table->timestamps();
        });

        Schema::table('artworks', function (Blueprint $table){
          $table->foreign('user_id','artwork_of_user')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork');
    }
}
