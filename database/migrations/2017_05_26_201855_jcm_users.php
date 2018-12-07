<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JcmUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jcm_users', function (Blueprint $table) {
            $table->bigIncrements('userId');
            $table->bigInteger('companyId')->nullable();
            $table->string('secretId',100)->nullable();
            $table->string('firstName',100);
            $table->string('lastName',100);
            $table->string('email',255);
            $table->string('username',50)->nullable();
            $table->string('password',100);
            $table->string('phoneNumber',20);
            $table->enum('type',['Admin','User'])->default('User');
            $table->enum('status',['Active','Inactive'])->default('Active');
            $table->integer('country')->default('0');
            $table->integer('city')->default('0');
            $table->integer('state')->default('0');
            $table->rememberToken();
            $table->string('profilePhoto',255)->nullable();
            $table->text('about')->nullable();
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
        Schema::dropIfExists('jcm_users');
    }
}
