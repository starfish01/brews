<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Brews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('brews', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brew_id')->index();
            $table->string('title');
            $table->integer('step_count');
            $table->longText('description');
            $table->foreign('brew_id')->references('id')->on('brews')->onDelete('cascade');
        });

        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brew_id')->index();
            $table->string('ingredient');
            $table->string('url');
            $table->foreign('brew_id')->references('id')->on('brews')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('ingredients');
        Schema::drop('steps');
        Schema::drop('brews');
    }
}
