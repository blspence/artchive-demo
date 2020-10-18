<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibits', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            //the three exhibit types are ANNUAL_STUDENT_SHOW, BFA_SHOW, and
            //EXPERIMENTAL SPACE show
            $table->string('type');

            $table->string('title');
            $table->text('description');

            //the image to be displayed on the exibit's view page
            $table->string('featured_image_url');
            $table->string('start_date_time');
            $table->string('end_date_time');
            $table->string('registration_start_date_time');
            $table->string('registration_end_date_time');
            $table->string('reception_start_date_time');
            $table->string('reception_end_date_time');
            $table->boolean('published');
            $table->text('default_accept_message');
            $table->text('default_reject_message');
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
        Schema::dropIfExists('exhibits');
    }
}
