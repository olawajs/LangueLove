<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonsBank extends Model
{
    protected $fillable = [
        'user_id', 
        'payment_id',
        'use_date',
        'overdue_date',
        'type_id'
    ];
}
