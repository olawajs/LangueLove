<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();

            $table->string('typPlatnosci');
            $table->string('start')->nullable();
            $table->string('hour')->nullable();
            $table->integer('duration_id')->nullable();
            $table->integer('language_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('lectorId')->nullable();
            $table->integer('ileFaktura')->nullable();
            $table->integer('ile')->default(1);
            $table->integer('cert')->default(0);
            $table->integer('zajecia')->default(0);
            $table->integer('cykliczne')->default(0);
            $table->float('priceG')->default(0);
            $table->integer('lessonI')->nullable();
            $table->string('title');
            $table->integer('calendarId')->nullable();
            $table->integer('lessonId')->nullable();
            $table->string('name');
            $table->string('nip');
            $table->string('city');
            $table->string('postcode');
            $table->string('street');
            $table->string('session_id');
            $table->integer('payment_id');
            $table->string('langDesc')->nullable();
            $table->integer('packet')->nullable();
            $table->integer('typeA')->nullable();
            $table->integer('certyficate')->nullable();
            $table->integer('user_id');
            $table->string('P24token');

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
        Schema::dropIfExists('payment_details');
    }
}
