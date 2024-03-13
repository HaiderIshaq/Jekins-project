<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCCitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_city', function (Blueprint $table) {
            $table->increments('city_id');
            $table->integer('city_country_id')->unsigned();
            $table->string('city_name');
            $table->foreign('city_country_id')->references('country_id')->on('c_country');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('c_city');
    }
}
