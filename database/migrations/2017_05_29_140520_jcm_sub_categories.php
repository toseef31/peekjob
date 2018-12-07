<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmSubCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('subCategoryId');
            $table->bigInteger('categoryId');
            $table->string('subName',255);
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
        Schema::dropIfExists('jcm_sub_categories');
    }
}
