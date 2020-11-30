<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudienceTable extends Migration
{
    public function up()
    {
        Schema::create('audience', function (Blueprint $table) {
            $table->id();
            $table->string('place_name');
            $table->integer('max_capacity');
            $table->boolean('has_projector');
            $table->boolean('has_speakers');
            $table->boolean('has_board');
            $table->timestamps();
            $table->integer('status')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('audience');
    }
}
