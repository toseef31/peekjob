<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmCmsPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_cms_pages', function (Blueprint $table) {
            $table->bigIncrements('pageId');
            $table->string('title',255);
            $table->string('slug',255)->nullable();
            $table->string('featuredImage',255)->nullable();
            $table->longText('pageData')->nullable();
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
        Schema::dropIfExists('jcm_cms_pages');
    }
}
