<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_company', function (Blueprint $table) {
            $table->increments('company_id');
            $table->string('company_name');
            $table->string('company_prefix');
            $table->integer('company_reg_id')->unsigned();
            $table->foreign('company_reg_id')->references('reg_id')->on('c_region'); 
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
        Schema::dropIfExists('companies');
    }
}
