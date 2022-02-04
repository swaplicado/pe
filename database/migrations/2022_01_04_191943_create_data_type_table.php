<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_data_type', function (Blueprint $table) {
            $table->bigIncrements('id_data_type');
            $table->string('name',100);
            $table->string('html',100);
            $table->boolean('is_delete');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

        /*DB::table('sys_data_type')->insert([
        	['id_data_type' => '1','name' => 'entero', 'html' => 'number', 'is_delete' => 0 , 'created_by' => '1', 'updated_by' => '1' ],
        	['id_data_type' => '2','name' => 'decimal' , 'html' => 'number', 'is_delete' => 0 , 'created_by' => '1', 'updated_by' => '1'],
            ['id_data_type' => '3', 'name' => 'fecha' , 'html' => 'date', 'is_delete' => 0 , 'created_by' => '1', 'updated_by' => '1']
        ]);*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_data_type');
    }
}
