<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectorPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lector_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('lector_type_id');
            $table->unsignedBigInteger('duration_id');
            $table->foreign('type_id')->references('id')->on('lesson_types')->onDelete('cascade');
            $table->foreign('lector_type_id')->references('id')->on('lector_types')->onDelete('cascade');
            $table->foreign('duration_id')->references('id')->on('lesson_durations')->onDelete('cascade');
            $table->boolean('certification');
            $table->float('price');
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
        Schema::dropIfExists('lector_prices');
    }
}
