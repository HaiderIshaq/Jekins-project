<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_branch', function (Blueprint $table) {

            $table->increments('branch_id');
            $table->integer('branch_bank_id')->unsigned();
            $table->foreign('branch_bank_id')->references('bank_id')->on('c_bank');
            $table->integer('branch_city_id')->unsigned();
            $table->foreign('branch_city_id')->references('city_id')->on('c_city');
            $table->integer('branch_code');
            $table->string('branch_name');
            $table->string('branch_address');
            $table->string('branch_phone');
            $table->string('branch_fax');
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
        Schema::dropIfExists('c_branch');
    }
}
