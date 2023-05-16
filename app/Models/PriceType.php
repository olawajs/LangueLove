<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceType extends Model
{
    protected $fillable = [
        'name', 
        'active',
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'price_types';

}
