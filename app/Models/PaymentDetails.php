<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    protected $fillable = [
        'typPlatnosci', 
        'start',
        'hour',
        'duration_id',
        'language_id',
        'type_id',
        'lectorId',
        'ileFaktura',
        'ile',
        'cert',
        'zajecia',
        'cykliczne',
        'priceG',
        'lessonI',
        'title',
        'calendarId',
        'lessonId',
        'name',
        'nip',
        'city',
        'postcode',
        'street',
        'session_id',
        'payment_id',
        'langDesc',
        'typeA',
        'packet',
        'certyficate',
        'user_id',
        'P24token',
    ];
}
