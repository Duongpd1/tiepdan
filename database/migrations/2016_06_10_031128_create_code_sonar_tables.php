<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeSonarTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table)
        {
            $table->increments('accountid');
            $table->char('accountname',100)
                ->unique();
            $table->char('password',32);
            $table->integer('accounttype')
                ->unsigned();
            $table->dateTime('registertime');
            $table->tinyInteger('status');
        });

        Schema::create('accountmanager', function (Blueprint $table)
        {
            $table->tinyInteger('permission');
            $table->integer('accountid')->unsigned();
            $table->foreign('accountid')->references('accountid')->on('account');
        });

        Schema::create('accountinfo', function (Blueprint $table)
        {
            $table->char('socialnumber', 12);
            $table->char('emailaddress', 100);
            $table->char('phonenumber', 20);
            $table->char('fullname', 100);
            $table->char('address', 200);
            $table->date('birthday');
            $table->tinyInteger('gender');
            $table->integer('accountid')->unsigned();
            $table->foreign('accountid')->references('accountid')->on('account');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('"account"');
        Schema::drop('"accountmanager"');
        Schema::drop('"accountinfo"');
    }
}
