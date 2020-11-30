<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationTable extends Migration
{
    public function up()
    {
        Schema::create('registration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('conference_id');
            $table->foreign('conference_id')->references('id')->on('conference')->onDelete('cascade');
            $table->timestamps();
            $table->integer('status')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('registration');
    }
}
