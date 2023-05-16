<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'price', 
        'quantity',
        'user_id',
        'description',
        'error_code',
        'error_desc',
        'status',
        'session_id',
    ];
}
