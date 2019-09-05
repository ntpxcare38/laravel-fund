<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('mem_id');
            $table->char('mem_no',10);
            $table->char('mem_card_id',13);
            $table->integer('mem_title');
            $table->string('mem_fname',40);
            $table->string('mem_lname',40);
            $table->date('mem_birthdate');
            $table->string('mem_add_no',8);
            $table->integer('v_id');
            $table->date('register_date');
            $table->date('resign_date')->nullable()->default(null);
            $table->integer('mem_status');
            $table->string('mem_cause_st',50)->nullable()->default(null);
            $table->string('password');
            $table->integer('type_mid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member', function (Blueprint $table) {
            //
        });
    }
}
