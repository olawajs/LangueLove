<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'type_id', 
        'price_type_id',
        'duration_id',
        'certification',
        'price',
    ];
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prices';

}
