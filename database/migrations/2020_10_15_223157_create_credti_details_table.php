<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredtiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credti_details', function (Blueprint $table) {
            $table->unsignedBigInteger('credit_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('pices');
            $table->unsignedInteger('cost');
            $table->unsignedInteger('sub_total');
            $table->SoftDeletes();

            $table->foreign('credit_id')->references('id')->on('credits');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credti_details');
    }
}
