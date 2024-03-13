<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIbrCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibr_company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('address');
            $table->string('street');
            $table->string('po_box');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('ibr_country')->onDelete('cascade');
            $table->string('email');
            $table->string('fax');
            $table->string('website');
            $table->string('registration_id');
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
        Schema::dropIfExists('ibr_company');
    }
}
