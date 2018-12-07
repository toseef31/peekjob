<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmDepartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_departments', function (Blueprint $table) {
            $table->bigIncrements('departmentId');
            $table->bigInteger('userId');
            $table->string('name',255);
            $table->integer('country')->default('0');
            $table->integer('state')->default('0');
            $table->integer('city')->default('0');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('jcm_departments');
    }
}
