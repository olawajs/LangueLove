<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonDuration extends Model
{
    protected $fillable = [
        'duration', 
        'active'
    ];
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson_durations';

}
