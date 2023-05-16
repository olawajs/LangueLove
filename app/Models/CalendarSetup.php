<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarSetup extends Model
{
    protected $fillable = [
        'start', 
        'end', 
        'lector_id',
        'type',
    ];
}
