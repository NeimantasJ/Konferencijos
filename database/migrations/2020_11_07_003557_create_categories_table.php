<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leader_id')->nullable();
            $table->foreign('leader_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('conference_id');
            $table->foreign('conference_id')->references('id')->on('conference');
            $table->string('name');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();
            $table->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
