<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->increments('acc_id');
            $table->string('acc_name');
            $table->date('acc_date');
            $table->integer('group_acid');
            $table->integer('acc_piece');
            $table->decimal('acc_price',16,2);
            $table->decimal('acc_total',16,2);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
