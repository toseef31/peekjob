<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmUpskills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_upskills', function (Blueprint $table) {
            $table->bigIncrements('skillId');
            $table->bigInteger('userId');
            $table->string('title',255);
            $table->string('type',20)->nullable();
            $table->string('organiser',255)->nullable();
            $table->longText('description')->nullable();
            $table->integer('cost')->default('0');
            $table->string('currency')->nullable();
            $table->string('address',255)->nullable();
            $table->integer('country')->default('0');
            $table->integer('state')->default('0');
            $table->integer('city')->default('0');
            $table->string('contact',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('website',255)->nullable();
            $table->string('facebook',255)->nullable();
            $table->string('linkedin',255)->nullable();
            $table->string('twitter',255)->nullable();
            $table->string('google',255)->nullable();
            $table->date('startDate');
            $table->date('endDate');
            $table->text('timing')->nullable();
            $table->string('upskillImage',255)->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
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
        Schema::dropIfExists('jcm_upskills');
    }
}
