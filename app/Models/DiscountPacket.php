<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountPacket extends Model
{
    protected $fillable = [
        'price_type_id', 
        'discount', 
        'amount',
    ];
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'discount_packets';
}
