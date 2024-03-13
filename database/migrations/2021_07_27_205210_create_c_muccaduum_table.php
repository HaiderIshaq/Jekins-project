<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCMuccaduumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_muccaduum', function (Blueprint $table) {
            $table->increments('id');
            $table->string('muc_name');
            $table->text('muc_address');  
            $table->string('muc_phone');
            $table->string('muc_fax');
            $table->string('muc_contact_person');
            $table->string('muc_contact_person_desig');
            $table->integer('muc_city');
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
        Schema::dropIfExists('c_muccaduum');
    }
}
