<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatorStatusLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicator_status_log', function (Blueprint $table) {
            $table->bigIncrements('id_log');
            $table->unsignedBigInteger('indicator_status_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('year_id');
            $table->string('comment',500);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->foreign('indicator_status_id')->references('id_indicator_status')->on('sys_indicator_status');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('year_id')->references('id_year')->on('config_years');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicator_status_log');
    }
}
