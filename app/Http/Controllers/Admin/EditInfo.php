<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\PriceType;
use App\Models\LessonDuration;
use App\Models\LessonType;
use App\Models\Price;
use App\Models\DiscountPacket;

class EditInfo extends Controller
{
    public function getLanguages()
    {
        return view('admin/language');
    }

    public function getLessons()
    {
        return view('admin/lessonsOptions');
    }

    public function getPrices()
    {
        $durations = LessonDuration::get()->all();
        $types = LessonType::get()->all();
        $priceTypes = PriceType::get()->all();
        $prices = Price::get()->all();
        $packets = DiscountPacket::get()->all();
        $pricesTable = [];
        foreach ($prices as $price){
            $pricesTable[$price->price_type_id][$price->type_id][$price->duration_id][$price->certification] = $price->price;
        } 
        return view('admin/priceOptions',[
            'durations' => $durations,
            'types' => $types,
            'priceTypes'=> $priceTypes,
            'prices' => $pricesTable,
            'packets' => $packets
        ]);
    }
}
