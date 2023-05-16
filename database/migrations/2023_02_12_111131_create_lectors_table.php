<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->unsignedBigInteger('native_language_id');
            $table->foreign('native_language_id')->references('id')->on('languages');
            $table->longText('education');
            $table->string('photo');
            $table->longText('description');
            $table->string('city');
            $table->string('street');
            $table->integer('id_user');
            $table->string('post_code');
            $table->longText('style')->nullable();
            $table->longText('levels')->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('lectors');
    }
}
