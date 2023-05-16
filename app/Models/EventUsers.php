<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUsers extends Model
{
    protected $fillable = [
        'calendar_id',
        'user_id',
        'comment',
        'status',
        'lector_accept',
        'student_accept',
    ];
}