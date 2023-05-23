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
            $table->string('name',500)->nullable();
            $table->string('street',500)->nullable();
            $table->string('postcode',500)->nullable();
            $table->string('nip',500)->nullable();
            $table->string('city',500)->nullable();
            $table->string('invoice',500)->nullable();
            $table->integer('error_code')->nullable();
            $table->integer('status')->default(1);
            $table->float('quantity');
            $table->float('price');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            
            $table->integer('id_lesson')->nullable();
            $table->integer('id_language')->nullable();
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
