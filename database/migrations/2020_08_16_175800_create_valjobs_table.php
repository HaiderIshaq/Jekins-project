<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValjobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuation_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_id')->nullable();
            $table->date('request_date')->nullable();
            $table->integer('job_by')->unsigned()->nullable();
            $table->integer('private')->unsigned()->nullable();
            $table->integer('region_id')->unsigned()->nullable();
            $table->integer('operational_branch')->unsigned()->nullable();
            $table->integer('bank_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->string('bank_address')->nullable();
            $table->string('bank_representative')->nullable();
            $table->string('bank_designation')->nullable();
            $table->string('bank_phone')->nullable();
            $table->string('bank_fax')->nullable();
            $table->string('bank_email')->nullable();
            $table->string('bank_letter')->nullable();
            $table->date('bank_letter_date')->nullable();
            $table->integer('byvendor_id')->unsigned()->nullable();
            $table->string('byvendor_representative')->nullable();
            $table->string('byvendor_designation')->nullable();
            $table->string('byvendor_phone')->nullable();
            $table->text('byvendor_address')->nullable();
            $table->string('byvendor_fax')->nullable();
            $table->string('byvendor_email')->nullable();
            $table->string('byvendor_letter')->nullable();
            $table->date('vendor_letter_date')->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->string('customer_representative')->nullable();
            $table->string('customer_designation')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_fax')->nullable();
            $table->string('customer_email')->nullable();
            $table->date('valuing_date')->nullable();
            $table->decimal('valuing_amount',9,2)->nullable();
            $table->integer('district')->unsigned()->nullable();
            $table->string('asset_class')->nullable();
            $table->string('commodity_code')->nullable();
            $table->text('address')->nullable();
            $table->string('pobox')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('postalcode')->nullable();
            $table->integer('completed')->nullable();
            $table->decimal('service_charges',9,2)->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('servey_date')->nullable();
            $table->integer('pages')->nullable();
            $table->integer('consultancy')->nullable();
            $table->integer('consultant')->unsigned()->nullable();
            $table->integer('corporate')->nullable();
            $table->decimal('value',9,2)->nullable();
            $table->integer('fsv_type')->nullable();
            $table->decimal('fsv_rate',9,2)->nullable();
            $table->decimal('fsv_calculated',9,2)->nullable();
            $table->date('report_date')->nullable();
            $table->decimal('sales_tax')->nullable();
            $table->string('dc_team')->nullable();
            $table->string('signing_team')->nullable();
            $table->string('survey_team')->nullable();
            $table->string('hub')->nullable();
            $table->string('requesting_rcard')->nullable();
            $table->string('rm')->nullable();
            $table->string('valuator')->nullable();
            $table->date('last_report_date')->nullable();
            $table->integer('cpu')->unsigned()->nullable();
            $table->integer('main_category')->unsigned()->nullable();
            $table->integer('category')->unsigned()->nullable();
            $table->string('sub_category')->nullable();
            $table->string('sub_cat_type')->nullable();
            $table->integer('STonfull')->unsigned()->nullable();
            $table->integer('final')->unsigned()->nullable();
            $table->string('client_copy')->nullable();
            $table->integer('customer_delay')->unsigned()->nullable();
            $table->integer('cancalled')->unsigned()->nullable();
            $table->date('cancallation_date')->nullable();
            $table->text('cancallation_remarks')->nullable();
            $table->date('gst_date')->nullable();
            $table->decimal('pocket',9,2)->nullable();
            $table->integer('isSales')->unsigned()->nullable();
            $table->integer('employee')->unsigned()->nullable();
            $table->decimal('vooucher_amount',9,2)->nullable();
            $table->decimal('payment_date',9,2)->nullable();
            $table->string('given_by')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('valuation_jobs');
    }
}
