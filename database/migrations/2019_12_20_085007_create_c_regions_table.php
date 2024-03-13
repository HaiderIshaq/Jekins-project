<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_region', function (Blueprint $table) {
            $table->increments('reg_id');
            $table->integer('reg_city_id')->unsigned();
            $table->string('reg_address');
            $table->string('reg_phone');
            $table->string('reg_fax');
            $table->string('reg_prefix');
            $table->foreign('reg_city_id')->references('city_id')->on('c_city')->onDelete('cascade');
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
        Schema::dropIfExists('c_region');
    }
}
