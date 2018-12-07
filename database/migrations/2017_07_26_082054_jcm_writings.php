<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmWritings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_writings', function (Blueprint $table) {
            $table->bigIncrements('writingId');
            $table->bigInteger('userId');
            $table->string('title',255);
            $table->integer('category')->default('0');
            $table->longText('description')->nullable();
            $table->text('citation')->nullable();
            $table->string('wIcon','255');
            $table->enum('status',['Publish','Draft'])->default('Publish');
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
        Schema::dropIfExists('jcm_writings');
    }
}
