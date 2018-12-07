<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmResume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_resume', function (Blueprint $table) {
            $table->bigIncrements('resumeId');
            $table->bigInteger('userId');
            $table->string('type',100);
            $table->longText('resumeData');
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
        Schema::dropIfExists('jcm_resume');
    }
}
