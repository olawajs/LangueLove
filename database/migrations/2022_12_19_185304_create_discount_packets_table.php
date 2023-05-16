<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountPacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_packets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price_type_id');
            $table->foreign('price_type_id')->references('id')->on('price_types')->onDelete('cascade');
            $table->integer('discount');
            $table->integer('amount');
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
        Schema::dropIfExists('discount_packets');
    }
}
