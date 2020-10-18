<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperimentalSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experimental_submissions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->boolean('rso');
            $table->string('rso_name')->nullable();
            $table->unsignedInteger('rso_num_participants')->nullable();
            $table->string('faculty_adviser')->nullable();
            $table->unsignedInteger('walls');
            $table->unsignedInteger('pedestals');
            $table->boolean('brick_ok');
            $table->text('additional_resources')->nullable();
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
        Schema::dropIfExists('experimental_submissions');
    }
}
