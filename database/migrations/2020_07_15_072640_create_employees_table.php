<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->date('appointed');
            $table->string('name');
            $table->string('fathername');
            $table->date('dob');
            $table->string('nationality');
            $table->string('nic');
            $table->string('experience');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('company_id')->on('c_company')->onDelete('cascade');
            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')->references('reg_id')->on('c_region')->onDelete('cascade');
            $table->string('service');
            $table->integer('designation')->unsigned();
            $table->string('religion');
            $table->string('language');
            $table->string('qualification');
            $table->string('maritalstatus');
            $table->text('address');
            $table->text('karachi_address');
            $table->string('contact');
            $table->string('phone');
            $table->string('reference1');
            $table->string('nic1');
            $table->string('reference2');
            $table->string('nic2');
            $table->date('fired');
            $table->decimal('salary',9,3);
            $table->date('allowancechanged');
            $table->decimal('pallowance',9,3);
            $table->decimal('callowance',9,3);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('c_employees');
    }
}
