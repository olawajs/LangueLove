<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name', 
        'short', 
        'price_type',
        'active'
    ];
           /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'languages';

}
