<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_companies', function (Blueprint $table) {
            $table->bigIncrements('companyId');
            $table->string('companyName',100);
            $table->bigInteger('category')->nullable();
            $table->string('companyUsername',255)->nullable();
            $table->string('companyAddress',255)->nullable();
            $table->integer('companyCountry')->default('0');
            $table->integer('companyCity')->default('0');
            $table->integer('companyState')->default('0');
            $table->string('companyEmail',255);
            $table->string('companyPhoneNumber',20);
            $table->string('companyWebsite',255)->nullable();
            $table->integer('companyNoOfUsers')->nullable();
            $table->text('companyAbout')->nullable();
            $table->enum('companyStatus',['Active','Inactive'])->default('Active');
            $table->date('companyEstablishDate')->nullable();
            $table->string('companyLogo',255)->nullable();
            $table->string('companyCover',255)->nullable();
            $table->text('companyOperationalHour')->nullable();
            $table->string('companyFb',255)->nullable();
            $table->string('companyTwitter',255)->nullable();
            $table->string('companyLinkedin',255)->nullable();
            $table->datetime('companyCreatedTime');
            $table->datetime('companyModifiedTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jcm_companies');
    }
}
