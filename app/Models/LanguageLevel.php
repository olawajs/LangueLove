<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageLevel extends Model
{
    protected $fillable = [
        'lector_id', 
        'language_id', 
        'level'
    ]; 
}
