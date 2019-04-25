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
            $table->string('name', 255)     ->nullable();
            $table->string('email', 255)    ->nullable();
            $table->string('password', 255) ->nullable();
            $table->date('birthday')        ->nullable();
            $table->integer('age')          ->nullable();
            $table->integer('reason_id')    ->nullable();
            $table->string('comment', 255)  ->nullable();
            $table->integer('notice_id')    ->nullable();
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
        Schema::dropIfExists('users');
    }
}
