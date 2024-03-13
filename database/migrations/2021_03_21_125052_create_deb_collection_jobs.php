<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebCollectionJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deb_collection_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->unsigned()->nullable();
            $table->string('client_name');
            $table->string('company_name');
            $table->string('client_contanct_number');
            $table->text('client_comapany_email_address');
            $table->integer('client_comapany_city')->unsigned()->nullable();
            $table->integer('client_comapany_country')->unsigned()->nullable();
            $table->decimal('amount',9,2)->nullable();
            $table->string('currency')->nullable();
            $table->string('debtor_company_name');
            $table->integer('debtor_comapany_city')->unsigned()->nullable();
            $table->integer('debtor_comapany_country')->unsigned()->nullable();
            $table->text('debtor_comapany_address');
            $table->string('debtor_comapany_representative');
            $table->string('debtor_comapany_representative_designation');
            $table->string('debt_period');
            $table->string('conflict');
            $table->text('conflict_details');
            $table->string('status')->nullable();
            $table->string('comission')->nullable();
            $table->integer('agreement')->unsigned()->nullable();
            $table->text('remarks');






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
        Schema::dropIfExists('deb_collection_jobs');
    }
}
