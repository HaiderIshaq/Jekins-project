<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuationVehicleImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuation_vehicle_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->string('title');
            $table->text('path');
            $table->integer('bright')->unsigned();
            $table->integer('half_page')->unsigned();
            $table->integer('type')->unsigned();
            $table->foreign('type')->references('id')->on('valuation_vehicle_image_types')->onDelete('cascade');
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
        Schema::dropIfExists('valuation_vehicle_images');
    }
}
