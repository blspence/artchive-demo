<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('exhibit_id')->unsigned();
            $table->text('comments')->nullable();
            $table->boolean('status');
            $table->text('admin_comments')->nullable();
            $table->boolean('notified');
            $table->integer('submitable_id')->nullable();
            $table->string('submitable_type')->nullable();
            $table->timestamps();
        });

        Schema::table('submissions', function (Blueprint $table){
          $table->foreign('user_id', 'submission_of_user')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('exhibit_id', 'submission_to_exhibit')->references('id')->on('exhibits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
