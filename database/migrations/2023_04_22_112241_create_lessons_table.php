<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('lesson_types');
            $table->unsignedBigInteger('duration_id');
            $table->foreign('duration_id')->references('id')->on('lesson_durations');
            $table->unsignedBigInteger('lector_id');
            $table->foreign('lector_id')->references('id')->on('lectors');
            $table->integer('amount_of_lessons');
            $table->integer('amount_of_students');
            $table->integer('status')->default('1');
            $table->float('price');
            $table->string('photo')->nullable();
            $table->string('title');
            $table->dateTime('start', $precision = 0);
            $table->longText('description')->nullable();
            $table->longText('draft')->nullable();
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages');
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
        Schema::dropIfExists('lessons');
    }
}
