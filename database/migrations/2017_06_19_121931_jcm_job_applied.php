<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmJobApplied extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_job_applied', function (Blueprint $table) {
            $table->bigIncrements('applyId');
            $table->bigInteger('userId');
            $table->bigInteger('jobId');
            $table->datetime('applyTime');
            $table->enum('applicationStatus',['Delivered','Junk','Shortlist','Screened','Interview','Offer','Hire','Reject'])->default('Delivered');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jcm_job_applied');
    }
}
