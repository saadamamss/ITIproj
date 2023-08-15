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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('desc')->nullable();
            $table->decimal('price',8,2);
            $table->decimal('sale_price',8,2)->nullable();
            $table->enum('stock',['in','out'])->default('in');
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('quantity')->default(0);
            $table->string('image');
            $table->text('images')->nullable();
            $table->bigInteger('cat_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
