<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatorStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_indicator_status', function (Blueprint $table) {
            $table->bigIncrements('id_indicator_status');
            $table->string('name',100);
            $table->string('abbreviation',50);
            $table->boolean('is_delete');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

        /*DB::table('sys_indicator_status')->insert([
        	['id_indicator_status' => '1','name' => 'por aprobar', 'abbreviation' => 'PA', 'is_delete' => 0 , 'created_by' => '1', 'updated_by' => '1' ],
        	['id_indicator_status' => '2','name' => 'aprobado' , 'abbreviation' => 'A', 'is_delete' => 0 , 'created_by' => '1', 'updated_by' => '1'],
            ['id_indicator_status' => '3', 'name' => 'rechazado' , 'abbreviation' => 'R', 'is_delete' => 0 , 'created_by' => '1', 'updated_by' => '1'],
            ['id_indicator_status' => '4','name' => 'por aprobar resultado', 'abbreviation' => 'PAR', 'is_delete' => 0 , 'created_by' => '1', 'updated_by' => '1' ],
        	['id_indicator_status' => '5','name' => 'resultado aprobado' , 'abbreviation' => 'RA', 'is_delete' => 0 , 'created_by' => '1', 'updated_by' => '1'],
            ['id_indicator_status' => '6', 'name' => 'resultado rechazado' , 'abbreviation' => 'RR', 'is_delete' => 0 , 'created_by' => '1', 'updated_by' => '1']
        ]);*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicator_status');
    }
}
