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
            $table->string('place_slug');
            $table->string('place');
            $table->smallInteger('open')->nullable;
            $table->time('open_time', 2)->nullable;
            $table->smallInteger('closed')->nullable;
            $table->time('close_time', 2)->nullable;
            $table->string('metro')->nullable; # Eventually, could have a table for this.
            $table->string('region')->nullable; # Eventually, could have a table for this.
            $table->string('address')->nullable;
            $table->smallInteger('visit_length')->nullable;
            $table->boolean('reservation_reqd')->nullable;
            $table->boolean('fee')->nullable;
            $table->string('url')->nullable;
            $table->text('description')->nullable;
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