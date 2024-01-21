<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons_banks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users'); 

            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')->references('id')->on('payments');  

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('lesson_types');  

            $table->dateTime('use_date', $precision = 0)->nullable();
            $table->dateTime('overdue_date', $precision = 0);
            $table->integer('priceType');
            $table->integer('duration')->default(1);
            $table->boolean('certificat')->default(false);
            
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
        Schema::dropIfExists('lessons_banks');
    }
}
