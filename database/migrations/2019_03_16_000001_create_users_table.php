<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('profile_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('phone_number');
            $table->string('password');
            $table->string('role')->nullable($value = 'USER');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table)
        {
            $table->foreign('profile_id', 'profile_of_user')->references('id')->on('profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
