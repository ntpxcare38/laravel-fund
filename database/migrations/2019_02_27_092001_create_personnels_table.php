<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->increments('p_id');
            $table->integer('p_title');
            $table->string('p_fname',40);
            $table->string('p_lname',40);
            $table->string('p_photo',100);
            $table->integer('position_fid');
            $table->integer('position_cid');
            $table->char('p_tel',10);
            $table->integer('type_pid');
            $table->string('p_username',30);
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personnel', function (Blueprint $table) {
            //
        });
    }
}
