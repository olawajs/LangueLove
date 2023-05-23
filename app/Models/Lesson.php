<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'type_id', 
        'duration_id', 
        'amount_of_lessons', 
        'amount_of_students', 
        'price',
        'photo',
        'start',
        'description',
        'draft',
        'lector_id',
        'language_id',
        'title',
        'status',
        'certificat'
    ];
}
