<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('place');
            $table->string('slug');
            $table->string('city')->nullable();
            $table->string('open')->nullable();
            $table->string('closed')->nullable();
            $table->string('metro')->nullable(); # Eventually, could have a table for this.
            $table->string('region')->nullable(); # Eventually, could have a table for this.
            $table->string('address')->nullable();
            $table->smallInteger('visit_length')->nullable();
            $table->boolean('reservation_reqd')->nullable();
            $table->boolean('fee')->nullable();
            $table->char('tag')->nullable();
            $table->string('url');
            $table->text('description')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
};