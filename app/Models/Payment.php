<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'price', 
        'quantity',
        'id_user',
        'description',
        'error_code',
        'error_desc',
        'status',
        'session_id',
        'id_lesson',
        'id_language',
        'invoice'
    ];
}
