<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIbrJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibr_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_id')->nullable();
            $table->date('requested_date')->nullable();
            $table->integer('job_by')->unsigned()->nullable();
            $table->integer('regional_id')->unsigned()->nullable();
            $table->integer('operational_branch')->unsigned()->nullable();
            $table->date('expiry')->nullable();
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
            $table->integer('country_id')->unsigned()->nullable();
            $table->string('city')->nullable();
            $table->string('company_id')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_street')->nullable();
            $table->string('company_pobox')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_fax')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_url')->nullable();
            $table->string('registration_id')->nullable();
            $table->text('additionals')->nullable();
            $table->integer('vendor_id')->unsigned()->nullable();
            $table->integer('report_type')->unsigned()->nullable();
            $table->integer('delivery_type')->unsigned()->nullable();
            $table->date('EDID')->nullable();
            $table->decimal('service_charges',9,2)->nullable();
            $table->decimal('exchange_rate',9,2)->nullable();
            $table->integer('sales')->nullable();
            $table->decimal('sale_tax',9,2)->nullable();
            $table->integer('tentative')->nullable();
            $table->string('tentativeReport')->nullable();
            $table->date('order_placed')->nullable();
            $table->date('order_recieved')->nullable();
            $table->string('original')->nullable();
            $table->string('client_copy')->nullable();
            $table->integer('completed')->nullable();
            $table->integer('delivery_time')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('duplicate')->nullable();
            $table->string('duplicate_id')->nullable();
            $table->integer('attach_top')->nullable();
            $table->integer('attach_bottom')->nullable();
            $table->integer('remove_first')->nullable();
            $table->integer('remove_bottom')->nullable();
            $table->integer('top_initials')->nullable();
            $table->integer('crop_page')->nullable();
            $table->integer('cancalled')->nullable();
            $table->date('cancalled_date')->nullable();
            $table->text('cancallation_remarks')->nullable();
            $table->string('company_activity')->nullable();
            $table->string('company_rating')->nullable();
            $table->string('company_limit')->nullable();
            $table->string('company_litigation')->nullable();
            $table->integer('customer_delay')->nullable();
            $table->string('given_by')->nullable();
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
        Schema::dropIfExists('ibr_jobs');
    }
}
