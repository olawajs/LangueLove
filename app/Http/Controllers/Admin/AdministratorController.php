<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Code;
use App\Models\Newsletter;
use App\Models\Payment;
use App\Models\User;
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
use App\Models\Lector;
use App\Models\LectorPrices;
use App\Models\Packets;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\LectorMailLessonNotification;
use App\Mail\StudentMailLessonNotification;

class AdministratorController extends Controller
{
    public function Database(Request $request){
        $codes = Code::all();
        $newsletters = Newsletter::all();
        $users = User::all();
        $payments = Payment::orderBy('created_at')->get();
        return view('admin/dataBase',[
            'codes'=> $codes,
            'newsletters'=> $newsletters,
            'payments'=> $payments,
            'users'=> $users,
        ]);
    }
    public function showLector(Request $request){
       
        $lector = Lector::where('id',$request->id)->first();
        // $calendarLessons = CalendarEvent::where('lector_id',$request->id)->orderBy('start')->get();
        $duratons = LessonDuration::all();
        $languageTypes = LanguageLevel::where('lector_id',$request->id)->get();
        $languageT = LanguageLevel::where('lector_id',$request->id)->pluck('language_id')->toArray();
        $languages = Language::whereIn('id',$languageT)->get();
        // $calendarEvents = CalendarSetup::where('lector_id',$request->id)->get(); // czy potrzebne teraz? tylko widok lektora? i indywidualne zajęcia?
      
        if(Auth::check()){
            $lessonsIndEu = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',0)->where('priceType',1)->count();
            $lessonsIndEuC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',1)->where('priceType',1)->count();

            $lessonsParEu = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',0)->where('priceType',1)->count();
            $lessonsParEuC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',1)->where('priceType',1)->count();

            $lessonsIndAz = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',0)->where('priceType',2)->count();
            $lessonsIndAzC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',1)->where('priceType',2)->count();

            $lessonsParAz = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',0)->where('priceType',2)->count();
            $lessonsParAzC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',1)->where('priceType',2)->count();

            // typ;typJezyka;certyfikat
            // 1 - ind; 4-para
            $wykupioneLekcje['1']['1']['0']= $lessonsIndEu;
            $wykupioneLekcje['1']['1']['1']= $lessonsIndEuC;
            $wykupioneLekcje['1']['2']['0']= $lessonsIndAz;
            $wykupioneLekcje['1']['2']['1']= $lessonsIndAzC;
            $wykupioneLekcje['4']['1']['0']= $lessonsParEu;
            $wykupioneLekcje['4']['1']['1']= $lessonsParEuC;
            $wykupioneLekcje['4']['2']['0']= $lessonsParAz;
            $wykupioneLekcje['4']['2']['1']= $lessonsParAzC;
        }else{
            $wykupioneLekcje['1']['1']['0']= 0;
            $wykupioneLekcje['1']['1']['1']= 0;
            $wykupioneLekcje['1']['2']['0']= 0;
            $wykupioneLekcje['1']['2']['1']= 0;
            $wykupioneLekcje['4']['1']['0']= 0;
            $wykupioneLekcje['4']['1']['1']= 0;
            $wykupioneLekcje['4']['2']['0']= 0;
            $wykupioneLekcje['4']['2']['1']= 0;
        }

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
            'Nd.',
            'Pon.',
            'Wt.',
            'Śr.',
            'Czw.',
            'Pt.',
            'Sb.'
        ];

        $calendar_Free = CalendarSetup::where('lector_id',$request->id)
                                        ->where('type',1)
                                        ->where('start','>=',Carbon::now())
                                        ->get();
        $calendar_Events = CalendarEvent::where('lector_id',$request->id)
                                        ->where('start','>=',Carbon::now())
                                        ->get();

        $maxDate = CalendarSetup::where('lector_id',$request->id)->max('end');
        $maxDate2 = CalendarEvent::where('lector_id',$request->id)->max('end');
        if($maxDate2 >$maxDate ){
            $maxDate = $maxDate2;
        }
        $calendar_Taken= CalendarSetup::where('lector_id',$request->id)
                                        ->where('type',0)
                                        ->where('start','>=',Carbon::now())
                                        ->get();

        $dateStart = Carbon::tomorrow();
        $dataTestowa = new Carbon($maxDate);
        $maxDate = new Carbon($maxDate);
        $maxDate = $maxDate->endOfWeek()->format('Y-m-d');
        $dateUsed = $dateStart->startOfWeek()->format('Y-m-d');
        $calendarTab = [];
        $calendarTabMobile = [];
        $helpDate = new Carbon('01-01-2023 07:00');
        while($dateUsed <= $maxDate){

            $hpDate = new Carbon($dateUsed);
            $weekStart = $hpDate->startOfWeek()->format('d');
            $wednesday = $hpDate->startOfWeek()->addDays('2')->format('d').' '.$months[intval($hpDate->format('m'))].' '.$hpDate->endOfWeek()->format('Y');
            $thursday = $hpDate->startOfWeek()->addDays('3')->format('d');
            $saturday = $hpDate->startOfWeek()->addDays('5')->format('d').' '.$months[intval($hpDate->format('m'))].' '.$hpDate->endOfWeek()->format('Y');
            
            $weekEnd= $hpDate->endOfWeek()->format('d').' '.$months[intval($hpDate->format('m'))].' '.$hpDate->endOfWeek()->format('Y');
            // dd($saturday);
            $dayNum = new Carbon($dateUsed);
            if($dayNum->dayOfWeek > 3){
                $TabName = $thursday.'-'.$saturday;
            }
            else{
                $TabName = $weekStart.'-'.$wednesday;
            }
            if($dayNum->dayOfWeek != 0){
                $calendarTabMobile[$TabName][$dateUsed]=[];
            }
           

            $calendarTab[$weekStart.'-'.$weekEnd][$dateUsed]=[];
            $nweDate = new Carbon($dateUsed);
            $day = $nweDate->dayOfWeek;
            $calendarTab[$weekStart.'-'.$weekEnd][$dateUsed]['name']=$days[$day];
            if($day != 0){
                $calendarTabMobile[$TabName][$dateUsed]['name']=$days[$day];
            }
            $calendarTab[$weekStart.'-'.$weekEnd][$dateUsed]['shortDate']=$nweDate->format('d.m');
            if($day != 0){
                $calendarTabMobile[$TabName][$dateUsed]['shortDate']=$nweDate->format('d.m');
            }
            $hourMax = '20:30';
            while($helpDate->roundMinute(30)->format('H:i') != $hourMax){
                $calendarTab[$weekStart.'-'.$weekEnd][$dateUsed][$helpDate->roundMinute(30)->format('H:i')] = [];
                if($day != 0){
                    $calendarTabMobile[$TabName][$dateUsed][$helpDate->roundMinute(30)->format('H:i')] = [];
                }
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
                $wednesday = $start->startOfWeek()->addDays('2')->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
                $thursday = $start->startOfWeek()->addDays('3')->format('d');
                $saturday = $start->startOfWeek()->addDays('5')->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
            $weekEnd= $start->endOfWeek()->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');

            $dayNum = new Carbon($startDate);
            if($dayNum->dayOfWeek > 3){
                $TabName = $thursday.'-'.$saturday;
            }
            else{
                $TabName = $weekStart.'-'.$wednesday;
            }

            $end = new Carbon($cF->end);
            $end = $end->subMinutes(60);
            $endHour = $end->format('H:i');
            while($startHour < $endHour){
                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['free'] = 1;
                         $calendarTabMobile[$TabName][$startDate][$startHour]['free'] = 1;
                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['60'] = 1;
                         $calendarTabMobile[$TabName][$startDate][$startHour]['60'] = 1;
                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['90'] = 1;
                         $calendarTabMobile[$TabName][$startDate][$startHour]['90'] = 1;
                // echo '['.$weekStart.'-'.$weekEnd.']['.$startDate.']['.$startHour.']<br>';
                $start = $start2->addMinutes(30);
                $startHour = $start->format('H:i');
            }
            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['free'] = 1;
                $calendarTabMobile[$TabName][$startDate][$startHour]['free'] = 1;
            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['60'] = 1;
                $calendarTabMobile[$TabName][$startDate][$startHour]['60'] = 1;
            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['90'] = 0;
                $calendarTabMobile[$TabName][$startDate][$startHour]['90'] = 0;
        }
       
        foreach($calendar_Taken as $cF){
            $start = new Carbon($cF->start);
            $start2 = new Carbon($cF->start);
            $startDate = $start->format('Y-m-d');
            $startHour = $start2->format('H:i');

            $weekStart = $start->startOfWeek()->format('d');
                $wednesday = $start->startOfWeek()->addDays('2')->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
                $thursday = $start->startOfWeek()->addDays('3')->format('d');
                $saturday = $start->startOfWeek()->addDays('5')->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
            $weekEnd= $start->endOfWeek()->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');

            $dayNum = new Carbon($startDate);
            if($dayNum->dayOfWeek > 3){
                $TabName = $thursday.'-'.$saturday;
            }
            else{
                $TabName = $weekStart.'-'.$wednesday;
            }

            $end = new Carbon($cF->end);
            $end = $end->subMinutes(30);
            $endHour = $end->format('H:i');
            
            // dd($endHour);
            
            $h = $start2;
            $del1 = $h->subMinutes(30);
            $del1 = $del1->format('H:i');
            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['free'] = 0;
                     $calendarTabMobile[$TabName][$startDate][$del1]['free'] = 0;
            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['60'] = 0;
                     $calendarTabMobile[$TabName][$startDate][$del1]['60'] = 0;
            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['90'] = 0;
                     $calendarTabMobile[$TabName][$startDate][$del1]['90'] = 0;


            $del2 = $h->subMinutes(30);
            $del2 = $del2->format('H:i');
            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del2]['90'] = 0;
                $calendarTabMobile[$TabName][$startDate][$del2]['90'] = 0;

            while($startHour <= $endHour){
                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['free'] = 0;
                         $calendarTabMobile[$TabName][$startDate][$startHour]['free'] = 0;
                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['60'] = 0;
                         $calendarTabMobile[$TabName][$startDate][$startHour]['60'] = 0;
                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['90'] = 0;
                         $calendarTabMobile[$TabName][$startDate][$startHour]['90'] = 0;
                $start = $start2->addMinutes(30);
                $startHour = $start->format('H:i');
            }
        }
        // dd($calendar_Events);
        foreach($calendar_Events as $cF){
            
            $start = new Carbon($cF->start);
            $start2 = new Carbon($cF->start);
            $startDate = $start->format('Y-m-d');
            $startHour = $start->format('H:i');

            $weekStart = $start->startOfWeek()->format('d');
                $wednesday = $start->startOfWeek()->addDays('2')->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
                $thursday = $start->startOfWeek()->addDays('3')->format('d');
                $saturday = $start->startOfWeek()->addDays('5')->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
            $weekEnd= $start->endOfWeek()->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');

            $dayNum = new Carbon($startDate);
            if($dayNum->dayOfWeek > 3){
                $TabName = $thursday.'-'.$saturday;
            }
            else{
                $TabName = $weekStart.'-'.$wednesday;
            }

            $end = new Carbon($cF->end);
            // $end = $end->subMinutes(30);
            $endHour = $end->format('H:i');

            $h = $start2;
            $del1 = $h->subMinutes(30);
            $del1 = $del1->format('H:i');
            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['free'] = 0;
                     $calendarTabMobile[$TabName][$startDate][$del1]['free'] = 0;
            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['60'] = 0;
                     $calendarTabMobile[$TabName][$startDate][$del1]['60'] = 0;
            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['90'] = 0;
                     $calendarTabMobile[$TabName][$startDate][$del1]['90'] = 0;


            $del2 = $h->subMinutes(30);
            $del2 = $del2->format('H:i');
            $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del2]['90'] = 0;
                     $calendarTabMobile[$TabName][$startDate][$del2]['90'] = 0;
            // $calendarTab[$startDate][$del2]['90'] = 0;
            // dd($startDate);

            while($startHour < $endHour){
                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['free'] = 0;
                         $calendarTabMobile[$TabName][$startDate][$startHour]['free'] = 0;
                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['60'] = 0;
                         $calendarTabMobile[$TabName][$startDate][$startHour]['60'] = 0;
                $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['90'] = 0;
                         $calendarTabMobile[$TabName][$startDate][$startHour]['90'] = 0;
                $start2 = $start2->addMinutes(30);
                $startHour = $start2->format('H:i');
            }
        }

            $levels = LanguageLevel::where('lector_id',$request->id)
                                        ->where('level', 'like', '%-%')
                                        ->get();
            $levels2 = LanguageLevel::select('level')->where('lector_id',$request->id)
                                        ->where('level', 'not like', '%-%')
                                        ->distinct()
                                        ->get();     
           
        // $session_id = Session::get('_token');
        $prices = LectorPrices::where('lector_type_id', $lector->lector_type_id)->get();
        // dd($calendarTab);
             return view('test/lector',[
                'durations' => $duratons,
                'levels' => $levels,
                'topics' => $levels2,
                'lector' => $lector,
                'languages' => $languages,
                'lessonAmount' => $wykupioneLekcje,
                'calendar' => $calendarTab,
                'calendarMobile' => $calendarTabMobile
            ]);
    }
    public function HoursMails(Request $request){
        $start = Carbon::tomorrow();

        $end = Carbon::tomorrow();
        $end = $end->addHours(24);

        $lessons = DB::table('event_users')
                    ->join('calendar_events', 'event_users.calendar_id', '=', 'calendar_events.id')
                    ->join('lessons', 'lessons.id', '=', 'calendar_events.lesson_id')
                    ->join('lectors', 'lectors.id', '=', 'calendar_events.lector_id')
                    ->join('users', 'users.id', '=', 'event_users.user_id')
                    ->join('languages', 'languages.id', '=', 'lessons.language_id')
                    ->select(
                        'calendar_events.start',
                        'lessons.title',
                        'lessons.type_id',
                        'languages.name',
                        'users.name as uczen',
                        'users.email as uEmail',
                        'lectors.name as lektor',
                        'lectors.email as Emaillektor',
                        'lectors.id as lektorId',
                        'lectors.skype',
                        'lessons.skype as skype2',
                    )
                    ->whereBetween('calendar_events.start', [$start, $end])
                    ->orderby('calendar_events.start')
                    ->get();

        // dd($lessons);
                    
        $lectors=[];
        
        foreach($lessons as $lesson){
            // Maile do uczniów
            $godzina = new Carbon($lesson->start);
            $lektor = $lesson->Emaillektor;
            $lectors[$lektor][$godzina->format('H:i')]= $lesson->title;
            if($lesson->type_id == 2){
                $s = $lesson->skype2;
            } else{
                $s = $lesson->skype;
            }
            $mailData=[
                'godzina' => $godzina->format('H:i'),
                'jezyk' => $lesson->name,
                'lektor' => $lesson->lektor,
                'skype' => $s
               ]; 
            //    $lesson->uEmail
               Mail::to( $lesson->uEmail)->send(new StudentMailLessonNotification($mailData));
        }
        
  
    foreach ($lectors as $k=>$lector){
        $lekcje = '';
        foreach ($lector as $key=>$lesson){
            $lekcje.= $key.' => '.$lesson.'<br>';
        } 
        $mailData=[
            'lekcje' =>$lekcje
        ]; 
        Mail::to($k)->send(new LectorMailLessonNotification($mailData));

    } 
 }
}
