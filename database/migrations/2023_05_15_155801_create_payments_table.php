<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('error_desc',2000)->nullable();
            $table->string('session_id',100)->nullable();
            $table->string('description',500);
            $table->integer('error_code')->nullable();
            $table->integer('status')->default(1);
            $table->integer('quantity');
            $table->float('price');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_lesson');
            $table->foreign('id_lesson')->references('id')->on('lessons');
            $table->unsignedBigInteger('id_language');
            $table->foreign('id_language')->references('id')->on('languages');
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
        Schema::dropIfExists('payments');
    }
}
