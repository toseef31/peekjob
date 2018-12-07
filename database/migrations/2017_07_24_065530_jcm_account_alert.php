<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmAccountAlert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_account_alert', function (Blueprint $table) {
            $table->bigIncrements('alertId');
            $table->bigInteger('userId');
            $table->enum('serviceAlert',['Yes','No'])->default('No');
            $table->enum('messageAlert',['Yes','No'])->default('No');
            $table->enum('newApplication',['Yes','No'])->default('No');
            $table->enum('closingJobs',['Yes','No'])->default('No');
            $table->enum('jobAlert',['Yes','No'])->default('No');
            $table->integer('country')->default('0');
            $table->integer('state')->default('0');
            $table->integer('city')->default('0');
            $table->integer('category')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jcm_account_alert');
    }
}
