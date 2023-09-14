<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectorPrices extends Model
{
    protected $fillable = [
        'type_id', 
        'lector_type_id',
        'duration_id',
        'certification',
        'price',
    ];
}
