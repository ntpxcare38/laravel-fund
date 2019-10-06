<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_information', function (Blueprint $table) {
            $table->increments('fund_id');
            $table->string('fund_name');
            $table->string('fund_no');
            $table->string('fund_village');
            $table->integer('fund_moo');
            $table->string('fund_soi');
            $table->string('fund_road');
            $table->string('fund_tumbol');
            $table->string('fund_district');
            $table->string('fund_province');
            $table->integer('fund_zipcode');
            $table->string('fund_tel');
            $table->string('fund_tel_m');
            $table->string('fund_fax');
            $table->string('fund_email');
            $table->string('fund_web');
            $table->string('fund_name_h');
            $table->string('fund_name_c');
            $table->integer('fund_habitant');
            $table->integer('p_id');
            $table->dateTime('fund_edit_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fund_information');
    }
}
