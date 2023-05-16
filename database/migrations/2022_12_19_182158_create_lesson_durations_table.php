<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonDurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_durations', function (Blueprint $table) {
            $table->id();
            $table->integer('duration');
            $table->boolean('active');
            $table->timestamps();
        });
        DB::table('lesson_durations')->insert(
            array(
                [
                    'duration' => 45,
                    'active' => true,
                ],
                [
                    'duration' => 60,
                    'active' => true,
                ],
                [
                    'duration' => 90,
                    'active' => true,
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_durations');
    }
}
