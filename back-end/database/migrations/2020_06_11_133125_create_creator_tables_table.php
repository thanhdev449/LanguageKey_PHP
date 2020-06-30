<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatorTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creator_tables', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('user_name');
            $table->string('email');
            $table->string('password');
            $table->date('birthday');
            $table->text('avatar')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('api_token')->nullable();
            $table->integer('score');
            $table->integer('words');
            $table->integer('level');
            $table->integer('subcriber');
            $table->integer('follower');
            $table->integer('role');
            $table->integer('is_deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creator_tables');
    }
}
