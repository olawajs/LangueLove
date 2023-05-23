<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonsBank extends Model
{
    protected $fillable = [
        'id_user', 
        'id_payment',
        'use_date',
        'overdue_date'
    ];
}
