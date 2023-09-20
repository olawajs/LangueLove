<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    protected $fillable = [
        'lector_type_id', 
        'duration_id', 
        'amount',
        'certyficate',
        'price',
        'type_id',
    ];
}
