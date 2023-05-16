<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_types', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->boolean('active');
            $table->timestamps();
        });
        DB::table('lesson_types')->insert(
            array(
                [
                    'name' => 'Indywidualne',
                    'active' => true,
                ],
                [
                    'name' => 'Grupowe',
                    'active' => true,
                ],
                [
                    'name' => 'Webinarium',
                    'active' => true,
                ],
                [
                    'name' => 'w Parach',
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
        Schema::dropIfExists('lesson_types');
    }
}
