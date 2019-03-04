<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('email');
            $table->text('password');
            $table->date('birthday');
            $table->integer('age');
            $table->integer('reason');
            $table->text('comment');
            $table->integer('notice');
        });
        Schema::create('mtb_notice', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
        });
        Schema::create('mtb_reason', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
        });
    }

    /**
     * Reverse the migrations.SS
     *
     * @return void
     */
    //public function down()
    //{
    //    Schema::dropIfExists('member_list');
    //}
}
