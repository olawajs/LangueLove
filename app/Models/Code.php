<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = [
        'email', 
        'code', 
        'use_date',
        'lesson_type',
        'amount',
        'type',
        'payment_id',
        'packet_amount'
    ];
}
