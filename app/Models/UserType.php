<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $fillable = [
        'name'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_types';

}
