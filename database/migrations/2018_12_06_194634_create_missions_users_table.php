<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mission_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mission_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('mission_id')->references('id')->on('missions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mission_user', function (Blueprint $table) {
            Schema::dropIfExists('mission_user');
        });
    }
}
