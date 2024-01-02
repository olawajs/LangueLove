<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lector extends Model
{
    protected $fillable = [
        'name', 
        'surname', 
        'email', 
        'native_language_id', 
        'education',
        'photo',
        'description',
        'city',
        'street',
        'post_code',
        'id_user',
        'id_language',
        'phone',
        'skype',
        'lector_type_id',
        'active',
        'yt'
    ];
}
