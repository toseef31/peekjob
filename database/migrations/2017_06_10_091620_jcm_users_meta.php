<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmUsersMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_users_meta', function (Blueprint $table) {
            $table->bigIncrements('metaId');
            $table->bigInteger('userId');
            $table->string('fatherName',100)->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->string('gender',50)->nullable();
            $table->string('maritalStatus',50)->nullable();
            $table->string('experiance',20)->nullable();
            $table->string('education',255)->nullable();
            $table->bigInteger('industry')->nullable();
            $table->string('currentSalary',20)->default('0')->nullable();
            $table->string('expectedSalary',20)->default('0')->nullable();
            $table->string('currency',10)->nullable();
            $table->string('cnicNumber',50)->nullable();
            $table->string('address',255)->nullable();
            $table->text('expertise')->nullable();
            $table->string('facebook',255)->nullable();
            $table->string('linkedIn',255)->nullable();
            $table->string('twitter',255)->nullable();
            $table->string('website',255)->nullable();
            $table->text('follow')->nullable();
            $table->text('saved')->nullable();
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
        Schema::dropIfExists('jcm_users_meta');
    }
}
