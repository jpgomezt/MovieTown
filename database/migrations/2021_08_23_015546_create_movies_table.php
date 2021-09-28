<?php

/**
 * @author Juan Pablo Gómez
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{

    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->longText('plot');
            $table->double('critics_score', 2, 1);
            $table->double('price');
            $table->smallInteger('rent_quantity');
            $table->smallInteger('sell_quantity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
