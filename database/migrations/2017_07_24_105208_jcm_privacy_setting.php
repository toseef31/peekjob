<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmPrivacySetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_privacy_setting', function (Blueprint $table) {
            $table->bigIncrements('privacyId');
            $table->bigInteger('userId');
            $table->enum('profile',['Yes','No'])->default('Yes');
            $table->enum('profileImage',['Yes','No'])->default('Yes');
            $table->enum('academic',['Yes','No'])->default('Yes');
            $table->enum('experience',['Yes','No'])->default('Yes');
            $table->enum('skills',['Yes','No'])->default('Yes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jcm_privacy_setting');
    }
}
