<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lector_type_id');
            $table->foreign('lector_type_id')->references('id')->on('lector_types')->onDelete('cascade');
            $table->unsignedBigInteger('duration_id');
            $table->foreign('duration_id')->references('id')->on('lesson_durations')->onDelete('cascade');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('lesson_types')->onDelete('cascade');
            $table->boolean('certyficate');
            $table->integer('amount');
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
        Schema::dropIfExists('packets');
    }
}
