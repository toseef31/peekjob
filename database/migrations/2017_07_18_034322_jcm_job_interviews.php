<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmJobInterviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_job_interviews', function (Blueprint $table) {
            $table->bigIncrements('interviewId');
            $table->bigInteger('userId');
            $table->bigInteger('jobseekerId');
            $table->bigInteger('jobId');
            $table->date('fromDate');
            $table->date('toDate');
            $table->integer('perInterview');
            $table->bigInteger('venueId');
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
        Schema::dropIfExists('jcm_job_interviews');
    }
}
