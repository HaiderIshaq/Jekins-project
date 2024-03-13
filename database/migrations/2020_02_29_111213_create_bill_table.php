<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bill_number');
            $table->string('job_number');
            $table->date('bill_date');
            $table->string('service');
            $table->decimal('service_charges',9,2)->nullable();
            $table->decimal('discount',9,2)->nullable();
            $table->integer('recievable');
            $table->decimal('old_debt',9,2)->nullable();
            $table->integer('cancalled')->nullable();
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
        Schema::dropIfExists('bill');
    }
}
