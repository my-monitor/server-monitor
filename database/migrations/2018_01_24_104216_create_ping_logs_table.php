<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ping_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ping_id');
            $table->integer('user_id');
            $table->text('header');
            $table->timestamps();

            $table->foreign('ping_id')->references('id')->on('pings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ping_logs');
    }
}
