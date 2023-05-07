<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_tag_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('place_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('place_id')->references('id')->on('places');
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_tag_user');
    }
};