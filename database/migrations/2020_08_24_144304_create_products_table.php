<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->unsignedBigInteger('category_id');
            $table->string('bar_code', 50)->unique();
            $table->string('name', 50)->unique();
            $table->string('description', 256)->nullable();
            $table->string('image')->nullable();
            $table->double('buy_price',11,2);
            $table->double('unit_price',11,2);
            $table->double('wholesale_price',11,2);
            $table->unsignedBigInteger('stock');
            $table->boolean('status')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
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
}
