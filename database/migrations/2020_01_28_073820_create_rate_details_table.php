<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibr_rate_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('region')->unsigned();
            $table->foreign('region')->references('id')->on('ibr_regions');
            $table->decimal('normal_rate',9,3);
            $table->decimal('urgent_rate',9,3);
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
        Schema::dropIfExists('rate_details');
    }
}
