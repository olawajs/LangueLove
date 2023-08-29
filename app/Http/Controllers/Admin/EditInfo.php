<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\PriceType;
use App\Models\LessonDuration;
use App\Models\LessonType;
use App\Models\LanguageLevel;
use App\Models\Price;
use App\Models\DiscountPacket;
use App\Models\CalendarEvent;
use App\Models\CalendarSetup;
use App\Models\LessonsBank;
use App\Models\EventUsers;
use Auth;
use Carbon\Carbon;

class EditInfo extends Controller
{
    public function Test()
    {
        $lessonsParEu = LessonsBank::where('user_id',81)->where('overdue_date','>=',Carbon::today())->whereNull('use_date')->where('type_id',4)->where('priceType',1)->count();
dd($lessonsParEu);
        $months = [
            '',
            'stycznia',
            'lutego',
            'marca',
            'kwietnia',
            'maja',
            'czerwca',
            'lipca',
            'sierpnia',
            'września',
            'października',
            'listopada',
            'grudnia'
        ];
        $days=[
            '',
            'Pon.',
            'Wt.',
            'Śr.',
            'Czw.',
            'Pt.',
            'Sb.',
            'Nd.'
        ];
$lector = 8;
        $calendar_Free = CalendarSetup::where('lector_id',$lector)
                                        ->where('type',1)
                                        ->where('start','>=',Carbon::now())
                                        ->get();
        $calendar_Events = CalendarEvent::where('lector_id',$lector)
                                        ->where('start','>=',Carbon::now())
                                        ->get();

        $maxDate = CalendarSetup::where('lector_id',$lector)->max('end');
        $maxDate2 = CalendarEvent::where('lector_id',$lector)->max('end');
        if($maxDate2 >$maxDate ){
            $maxDate = $maxDate2;
        }
        $calendar_Taken= CalendarSetup::where('lector_id',$lector)
                                        ->where('type',0)
                                        ->where('start','>=',Carbon::now())
                                        ->get();
                                        $dateStart = Carbon::tomorrow();
                                        $dataTestowa = new Carbon($maxDate);
                                        $maxDate = new Carbon($maxDate);
                                        $maxDate = $maxDate->endOfWeek()->format('Y-m-d');
                                        $dateUsed = $dateStart->startOfWeek()->format('Y-m-d');
                                        $calendarTab = [];
                                        $helpDate = new Carbon('01-01-2023 07:00');
                                        while($dateUsed <= $maxDate){
                                            $hpDate = new Carbon($dateUsed);
                                            $weekStart = $hpDate->startOfWeek()->format('d');
                                            $weekEnd= $hpDate->endOfWeek()->format('d').' '.$months[intval($hpDate->format('m'))].' '.$hpDate->endOfWeek()->format('Y');
                                
                                            $calendarTab[$weekStart.'-'.$weekEnd][$dateUsed]=[];
                                            $nweDate = new Carbon($dateUsed);
                                            $day = $nweDate->dayOfWeek;
                                            $calendarTab[$weekStart.'-'.$weekEnd][$dateUsed]['name']=$days[$day];
                                            $calendarTab[$weekStart.'-'.$weekEnd][$dateUsed]['shortDate']=$nweDate->format('d.m');;
                                            $hourMax = '20:30';
                                            while($helpDate->roundMinute(30)->format('H:i') != $hourMax){
                                                $calendarTab[$weekStart.'-'.$weekEnd][$dateUsed][$helpDate->roundMinute(30)->format('H:i')] = [];
                                                $helpDate = $helpDate->addMinutes(30);
                                            }
                                          
                                            $helpDate = new Carbon('01-01-2023 07:00');
                                            $dateUsed = new Carbon($dateUsed);
                                            $dateUsed = $dateUsed->addDay();
                                            $dateUsed = $dateUsed->format('Y-m-d');
                                        }
                                        foreach($calendar_Free as $cF){
                                           
                                            $start = new Carbon($cF->start);
                                            $start2 =  new Carbon($cF->start);
                                            $startDate = $start->format('Y-m-d');
                                            $startHour = $start2->format('H:i');
                                          
                                            $weekStart = $start->startOfWeek()->format('d');
                                            $weekEnd= $start->endOfWeek()->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
                                
                                            $end = new Carbon($cF->end);
                                            $end = $end->subMinutes(60);
                                            $endHour = $end->format('H:i');
                                            while($startHour <= $endHour){
                                                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['free'] = 1;
                                                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['60'] = 1;
                                                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['90'] = 1;
                                                // echo '['.$weekStart.'-'.$weekEnd.']['.$startDate.']['.$startHour.']<br>';
                                                $start = $start2->addMinutes(30);
                                                $startHour = $start->format('H:i');
                                               
                                            }
                                            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['free'] = 1;
                                            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['60'] = 1;
                                            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['90'] = 0;
                                        }
                                
                                        foreach($calendar_Taken as $cF){
                                            $start = new Carbon($cF->start);
                                            $startDate = $start->format('Y-m-d');
                                            $startHour = $start->roundMinute(30)->format('H:i');
                                
                                            $weekStart = $start->startOfWeek()->format('d');
                                            // $weekEnd= $start->endOfWeek()->format('d F Y');
                                            $weekEnd= $start->endOfWeek()->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
                                
                                
                                            $end = new Carbon($cF->end);
                                            $end = $end->subMinutes(30);
                                            $endHour = $end->roundMinute(30)->format('H:i');
                                
                                            $h = $start;
                                            $del1 = $h->subMinutes(30);
                                            $del1 = $del1->roundMinute(30)->format('H:i');
                                            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['free'] = 0;
                                            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['60'] = 0;
                                            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['90'] = 0;
                                
                                
                                            $del2 = $h->subMinutes(30);
                                            $del2 = $del2->roundMinute(30)->format('H:i');
                                            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del2]['90'] = 0;
                                
                                            while($startHour <= $endHour){
                                                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['free'] = 0;
                                                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['60'] = 0;
                                                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['90'] = 0;
                                                $start = $start->addMinutes(30);
                                                $startHour = $start->roundMinute(30)->format('H:i');
                                            }
                                        }
                                        foreach($calendar_Events as $cF){
                                            
                                            $start = new Carbon($cF->start);
                                            $startDate = $start->format('Y-m-d');
                                            $startHour = $start->roundMinute(30)->format('H:i');
                                
                                            $weekStart = $start->startOfWeek()->format('d');
                                            // $weekEnd= $start->endOfWeek()->format('d F Y');
                                            $weekEnd= $start->endOfWeek()->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
                                
                                
                                
                                            $end = new Carbon($cF->end);
                                            $end = $end->subMinutes(30);
                                            $endHour = $end->roundMinute(30)->format('H:i');
                                
                                            $h = $start;
                                            $del1 = $h->subMinutes(30);
                                            $del1 = $del1->roundMinute(30)->format('H:i');
                                            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['free'] = 0;
                                            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['60'] = 0;
                                            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['90'] = 0;
                                
                                
                                            $del2 = $h->subMinutes(30);
                                            $del2 = $del2->roundMinute(30)->format('H:i');
                                            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del2]['90'] = 0;
                                            // $calendarTab[$startDate][$del2]['90'] = 0;
                                            // dd($startDate);
                                
                                            while($startHour <= $endHour){
                                                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['free'] = 0;
                                                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['60'] = 0;
                                                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['90'] = 0;
                                                $start = $start->addMinutes(30);
                                                $startHour = $start->roundMinute(30)->format('H:i');
                                            }
                                        }
        dd($calendarTab);
     
    
    }
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
