<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name');
            $table->char('email');
            $table->text('password');
            $table->string('type',1);
            $table->string('phone',20);
            $table->date('dob');
            $table->text('profile');
            $table->integer('create_user_id');
            $table->integer('updated_user_id');
            $table->integer('deleted_user_id');
            $table->timestamps();
            $table->integer('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
