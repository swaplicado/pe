<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->bigIncrements('id_indicator');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('year_id');
            $table->string('name');
            $table->string('description');
            $table->string('unit_measurement');
            $table->unsignedBigInteger('data_type_id');
            $table->integer('minimum_value');
            $table->integer('expected_value');
            $table->integer('excellent_value');
            $table->integer('weighing');
            $table->unsignedBigInteger('indicator_status_id');
            $table->integer('is_deleted');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('year_id')->references('id_year')->on('config_years');
            $table->foreign('data_type_id')->references('id_data_type')->on('sys_data_type');
            $table->foreign('indicator_status_id')->references('id_indicator_status')->on('sys_indicator_status');
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
        Schema::dropIfExists('indicators');
    }
}
