<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->text('address');
            $table->boolean('is_staff')->default(0);
            $table->boolean('has_rented_movies')->default(0);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username']);
            $table->dropColumn(['address']);
            $table->dropColumn(['is_staff']);
            $table->dropColumn(['has_rented_movies']);
        });
    }
}
