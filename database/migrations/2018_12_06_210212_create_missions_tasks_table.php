<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->integer('mission_id')->unsigned()->references('id')->on('missions')->onDelete('cascade');
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
        Schema::dropIfExists('missions_tasks');
    }
}
