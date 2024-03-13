<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_jobs', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('job_id')->nullable();
            $table->integer('job_by')->unsigned()->nullable();
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
            $table->integer('is_stock_joint')->unsigned()->nullable();
            $table->string('stock_is')->nullable();
            $table->integer('muccaduum_id')->unsigned()->nullable();
            $table->integer('is_print_muccaduum')->unsigned()->nullable();
            $table->integer('is_print_representative')->unsigned()->nullable();
            $table->string('muccaduum_representative')->nullable();
            $table->string('muccaduum_representative_nic')->nullable();
            $table->string('muccaduum_representative_desig')->nullable();
            $table->string('muccaduum_representative_phone')->nullable();
            $table->string('muccaduum_representative_email')->nullable();
            $table->integer('is_rotation')->unsigned()->nullable();
            $table->date('last_do')->nullable();
            $table->date('request_date')->nullable();
            $table->date('site_start')->nullable();
            $table->integer('facility_id')->unsigned()->nullable();
            $table->integer('is_facility_print')->unsigned()->nullable();
            $table->string('sactioned_limit')->nullable();
            $table->string('scope')->nullable();
            $table->string('collateral')->nullable();
            $table->string('quantity')->nullable();
            $table->string('ownership_evidance')->nullable();
            $table->decimal('service_charges',9,2)->nullable();
            $table->integer('is_service_charges_corporate')->unsigned()->nullable();
            $table->integer('is_sales_tax')->unsigned()->nullable();
            $table->integer('sale_reg')->unsigned()->nullable();
            $table->decimal('total_amount',9,2)->nullable();
           




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
        Schema::dropIfExists('inspection_jobs');
    }
}
