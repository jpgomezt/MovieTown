<?php

/**
 * @author Juan Pablo Gómez
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieWatchlistTable extends Migration
{

    public function up()
    {
        Schema::create('movie_watchlist', function (Blueprint $table) {
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->foreignId('watchlist_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('movie_watchlist');
    }
}
