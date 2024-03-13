<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuation_vehicleDetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_number');
            $table->string('make');
            $table->string('reg_no');
            $table->string('engine_no');
            $table->string('chassis_no');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('vehicles_detail');
    }
}
