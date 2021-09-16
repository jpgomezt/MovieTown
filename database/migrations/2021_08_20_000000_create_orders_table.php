<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->date('date');
            $table->string('paymentType');
            $table->date('shippingDate'); 
            $table->float('shippingCost');
            $table->float('total');
            $table->boolean('isShipped');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            // It has to be json, because there is no array native data type
            //$table->json(foreignId('items')->constrained()->onDelete('cascade'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
