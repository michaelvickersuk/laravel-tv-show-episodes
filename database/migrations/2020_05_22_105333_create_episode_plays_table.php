<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodePlaysTable extends Migration
{
    public function up()
    {
        Schema::create('episode_plays', function (Blueprint $table) {
            $table->unsignedBigInteger('episode_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['episode_id', 'user_id']);
            $table->index(['user_id', 'episode_id']);
            $table->foreign('episode_id')->references('id')->on('episodes')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('episode_plays');
    }
}
