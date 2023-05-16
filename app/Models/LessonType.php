<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonType extends Model
{
    protected $fillable = [
        'name', 
        'active'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson_types';

}
