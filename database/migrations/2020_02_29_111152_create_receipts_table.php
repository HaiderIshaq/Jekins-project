<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('receipt_id');
            $table->date('receipt_date');
            $table->integer('region_id');
            $table->integer('private')->nullable();
            $table->integer('bank_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->integer('instrument_type');
            $table->integer('instrument_number')->nullable();
            $table->date('instrument_date')->nullable();
            $table->integer('amount')->nullable();
            $table->text('remarks');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('net')->nullable();
            $table->integer('bank_charges')->nullable();
            $table->integer('post')->nullable();
            $table->integer('cancalled')->nullable();
            $table->integer('taxable_amount')->nullable();
            $table->integer('sales_tax')->nullable();
            $table->integer('deposit_bank')->nullable();
            $table->date('deposit_date')->nullable();
            $table->string('write_off')->nullable();
            $table->integer('ST_value')->nullable();
            $table->integer('advance')->nullable();
            $table->integer('slip_number')->nullable();
            $table->integer('client_copy')->nullable();
            $table->integer('deposit_copy')->nullable();
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
        Schema::dropIfExists('receipts');
    }
}
