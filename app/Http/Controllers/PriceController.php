<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\PriceType;
use App\Models\LessonDuration;
use App\Models\LessonType;
use App\Models\Price;
use App\Models\DiscountPacket;
use DB;

class PriceController extends Controller
{
    public function showPrices()
    {

        
        $packet = DiscountPacket::all();
        $language = Language::all();
        $duration2 =  DB::table('lesson_durations')->join('prices', 'lesson_durations.id', '=', 'prices.duration_id')->take(3)->get();
        return view('prices',[
            'packets' => $packet,
            'durations' => $duration2,
            'languages' => $language
        ]);
    }


}
