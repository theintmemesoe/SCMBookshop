<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // $table->increments('id');
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->rememberToken();
            // $table->timestamps();

            $table->increments('id');
            $table->char('name');
            $table->char('email');
            $table->text('password');
            $table->boolean('verified')->default(false);
            $table->string('type',1)->default(1);
            $table->string('phone',20);
            $table->date('dob')->nullable();
            $table->text('profile')->nullable();
            $table->integer('create_user_id')->unsigned();
            $table->foreign('create_user_id')->references('id')->on('users');
            $table->integer('updated_user_id')->unsigned();
            $table->foreign('updated_user_id')->references('id')->on('users');
            $table->integer('deleted_user_id')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->string('remember_token',100)->nullable()->default(null);
            // $table->integer('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
