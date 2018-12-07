<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmInterviewVenues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_interview_venues', function (Blueprint $table) {
            $table->bigIncrements('venueId');
            $table->bigInteger('userId');
            $table->string('title',255);
            $table->string('address',255);
            $table->integer('country')->default('0');
            $table->integer('city')->default('0');
            $table->integer('state')->default('0');
            $table->string('contact',255);
            $table->string('email',255)->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('fax',20)->nullable();
            $table->text('instruction')->nullable();
            $table->datetime('createdTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jcm_interview_venues');
    }
}
