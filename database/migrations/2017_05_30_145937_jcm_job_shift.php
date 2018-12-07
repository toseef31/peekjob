<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmJobShift extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_job_shift', function (Blueprint $table) {
            $table->bigIncrements('shiftId');
            $table->string('name',255);
            $table->datetime('createdTime');
            $table->datetime('modifiedTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jcm_job_shift');
    }
}
