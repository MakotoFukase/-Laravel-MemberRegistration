<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->date('birthday')->nullable();
            $table->integer('age')->nullable();
            $table->integer('reason')->nullable();
            $table->string('comment', 255)->nullable();
            $table->integer('notice')->nullable();
            $table->timestamps();
        });
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
        });
        Schema::create('reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_customer');
        Schema::dropIfExists('mtb_notice');
        Schema::dropIfExists('mtb_reason');
    }
}
