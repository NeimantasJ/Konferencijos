<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('audience_id');
            $table->foreign('audience_id')->references('id')->on('audience');
            $table->string('name');
            $table->integer('capacity');
            $table->integer('speech_capacity');
            $table->integer('speech_time')->default(0);
            $table->timestamp('break_time_start')->nullable()->default(null);
            $table->timestamp('break_time_end')->nullable()->default(null);
            $table->timestamp('cafe_time_start')->nullable()->default(null);
            $table->timestamp('cafe_time_end')->nullable()->default(null);
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
        Schema::dropIfExists('conference');
    }
}
