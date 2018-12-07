<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('jcm_jobs', function (Blueprint $table) {
            $table->bigIncrements('jobId');
            $table->bigInteger('userId');
            $table->bigInteger('companyId');
            $table->string('title',255);
            $table->enum('jType',['Free','Paid'])->default('Free');
            $table->bigInteger('department')->default('0');
            $table->bigInteger('category')->nullable();
            $table->bigInteger('subCategory')->nullable();
            $table->string('careerLevel',255)->nullable();
            $table->string('experience',255)->nullable();
            $table->integer('vacancies')->nullable();
            $table->text('description')->nullable();
            $table->text('skills')->nullable();
            $table->string('qualification',255)->nullable();
            $table->string('jobType',255)->nullable();
            $table->string('jobShift',255)->nullable();
            $table->integer('minSalary')->nullable();
            $table->integer('maxSalary')->nullable();
            $table->string('currency',10)->nullable();
            $table->text('benefits')->nullable();
            $table->integer('country')->default('0');
            $table->integer('city')->default('0');
            $table->integer('state')->default('0');
            $table->date('expiryDate')->nullable();
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
        Schema::dropIfExists('jcm_jobs');
    }
}
