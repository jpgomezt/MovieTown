<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->date('date');
            $table->string('payment_type');
            $table->date('shipping_date')->nullable(); 
            $table->double('shipping_cost')->default(5.30);
            $table->double('total')->default(0.00);
            $table->boolean('is_shipped')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
