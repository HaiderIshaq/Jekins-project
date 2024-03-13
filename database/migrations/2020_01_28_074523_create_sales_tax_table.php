<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_tax', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('rate',9,3);
            $table->integer('region')->unsigned();
            $table->foreign('region')->references('id')->on('tax_regions');
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
        Schema::dropIfExists('sales_tax');
    }
}
