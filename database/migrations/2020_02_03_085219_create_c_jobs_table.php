<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_id');
            $table->date('taken_on');
            $table->integer('company_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->string('service');
            $table->integer('bank_id')->unsigned()->nullable();
            $table->integer('byvendor_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->text('remarks');
            $table->string('status');
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
        Schema::dropIfExists('c_jobs');
    }
}
