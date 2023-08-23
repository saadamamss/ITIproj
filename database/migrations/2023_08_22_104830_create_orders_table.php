<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('subtotal',8,2);
            $table->decimal('discount',8,2)->default(0);
            $table->decimal('tax',8,2);
            $table->decimal('total',8,2);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('mobile');
            $table->string('country');
            $table->string('city');
            $table->string('province');
            $table->string('zipcode');
            $table->string('line1');
            $table->string('line2');
            $table->enum('status' , ['ordered' , 'confirm', 'withpost','inway','deliverd','canceled'])->default('ordered');
            $table->tinyInteger('rstatus')->default(0);
            $table->tinyInteger('is_shipping_different')->default(0);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
};
