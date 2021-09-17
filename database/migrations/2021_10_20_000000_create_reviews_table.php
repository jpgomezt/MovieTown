<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{

    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('opinion');
            $table->float('stars');
            $table->date('date');
            $table->boolean('is_visible'); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
