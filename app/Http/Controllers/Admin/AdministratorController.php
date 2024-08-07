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
use App\Models\Lesson;
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
use App\Mail\Podsumowanie;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Http;

class AdministratorController extends Controller
{
    public function sendMail(){
        
          Mail::to('olawjs@gmail.com')->send(new Podsumowanie());
        //   Mail::to('aleksandrawajs@interia.pl')->send(new Podsumowanie());

        //   Mail::to('aleksandrawajs@interia.pl')->send(new Podsumowanie());
  

   }
    public function GenerateCodes(Request $request){
        for($i=1; $i<=40; $i++){
            $result = app('App\Http\Controllers\NewsletterController')->generateCode();
            $code = Code::create([
                'code' => $result,
                'email' => '',
                'lesson_type' => 2,
                'amount' => 15,
                'type' => '%'
            ]);
            echo $result.'<br>';  
        }
        
    }
    public function FullClaendars(Request $request){
        $ch = curl_init();
        $first = Carbon::now()->addMonths(1)->startOfMonth()->format('Y-m-d');
        $last =  Carbon::now()->addMonths(1)->endOfMonth()->format('Y-m-d');
        
        curl_setopt($ch, CURLOPT_URL, "https://openholidaysapi.org/PublicHolidays?countryIsoCode=PL&languageIsoCode=PL&validFrom=$first&validTo=$last");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = json_decode(curl_exec($ch));
        curl_close($ch);  
        $lectors = Lector::where('active','1')
                            ->where('id', '!=', 14) // Faustyna
                            ->where('id', '!=', 8) //wera
                            ->where('active',1)
                            ->get();
        // $lectors = Lector::where('id','11')->get();
        foreach($lectors as $le){
            $id = $le->id;
            foreach($output as $o){
                
                $today = new Carbon($o->startDate);
              
                if($today->dayOfWeek != Carbon::SUNDAY && $today->dayOfWeek != Carbon::SATURDAY ){
                    $start = $o->startDate.' 07:00:00';
                    $end = $o->startDate.' 21:00:00';
                    $data=[
                        'start'=>$start,
                        'end'=>$end,
                        'lector_id'=>$id,
                        'type'=>0, //wolny
                    ];
                    $CS = CalendarSetup::create($data);
                    echo $le->name.' Uzupelniony <br>';
                }
            }
             $day = $first;
            $l =  Carbon::now()->addMonths(1)->endOfMonth();
            $l = $l->addDays(1)->format('Y-m-d');
            while($day != $l){
                $start2 = $day.' 07:00:00';
                $end2 = $day.' 21:00:00';
                $data2=[
                    'start'=>$start2,
                    'end'=>$end2,
                    'lector_id'=>$id,
                    'type'=>1, //wolny
                ];
                $today = new Carbon($day);
                if($today->dayOfWeek != Carbon::SUNDAY){
                    $CS2 = CalendarSetup::create($data2);
                }
                $h = new Carbon($day);
                $day = $h->addDays(1)->format('Y-m-d');
            }
        }

        
       
           

    }
    public function Database(Request $request){
        $codes = Code::all();
        $newsletters = Newsletter::all();
        $users = User::all();
        $payments = Payment::orderBy('created_at')->get();
        $packets = [];
        $lessons = DB::table('lessons_banks')
                    ->join('payments', 'payments.id', '=', 'lessons_banks.payment_id')
                    ->join('users', 'users.id', '=', 'lessons_banks.user_id')
                    ->select(
                        'lessons_banks.use_date',
                        'lessons_banks.overdue_date',
                        'payments.description',
                        'payments.id',
                        'payments.created_at',
                        'users.name as uczen',
                        'users.email as uEmail',
                    )
                    ->get();
        foreach ($lessons as $key => $l) {
            if(!key_exists($l->id,$packets)){
                $packets[$l->id]=[
                    'title' => $l->description,
                    'dataDo' => $l->overdue_date,
                    'dataZakupu' => $l->created_at,
                    'terminyUzycia' => [],
                    'uczen' => $l->uczen,
                    'uczenMail' => $l->uEmail,
                ];
            }
            $web = Lesson::where('type_id',3)->where('active',1)->get();

            $packets[$l->id]['dataDo']=$l->overdue_date;
            $packets[$l->id]['terminyUzycia'][]=$l->use_date;

        }
        return view('admin/dataBase',[
            'codes'=> $codes,
            'newsletters'=> $newsletters,
            'payments'=> $payments,
            'users'=> $users,
            'packets'=> $packets,
            'webinar'=> $web,
        ]);
    }
    public function getPeople(Request $request){
        $id= $request->id;
        $calendar =  DB::table('calendar_events')
        ->join('event_users', 'event_users.calendar_id', '=', 'calendar_events.id')
        ->join('users', 'users.id', '=', 'event_users.user_id')
        ->select(
            'users.name',
            'users.email'
            )
        ->where('calendar_events.lesson_id',$id)
        ->groupBy('email')->groupBy('name')
        ->get();
        return $calendar;
    }
    public function showLector(Request $request){
       
        $lector = Lector::where('id',$request->id)->first();
        // $calendarLessons = CalendarEvent::where('lector_id',$request->id)->orderBy('start')->get();
        $duratons = LessonDuration::all();
        $languageTypes = LanguageLevel::where('lector_id',$request->id)->get();
        $languageT = LanguageLevel::where('lector_id',$request->id)->pluck('language_id')->toArray();
        $languages = Language::whereIn('id',$languageT)->get();
        // $calendarEvents = CalendarSetup::where('lector_id',$request->id)->get(); // czy potrzebne teraz? tylko widok lektora? i indywidualne zajęcia?
        $wykupioneLekcje = [];
        if(Auth::check()){
            // $lessonsIndEu = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',0)->where('priceType',1)->count();
            // $lessonsIndEuC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',1)->where('priceType',1)->count();

            // $lessonsParEu = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',0)->where('priceType',1)->count();
            // $lessonsParEuC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',1)->where('priceType',1)->count();

            // $lessonsIndAz = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',0)->where('priceType',2)->count();
            // $lessonsIndAzC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',1)->where('priceType',2)->count();

            // $lessonsParAz = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',0)->where('priceType',2)->count();
            // $lessonsParAzC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',1)->where('priceType',2)->count();

            // typ;typJezyka;certyfikat
            // 1 - ind; 4-para
            $bank = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->WhereNull('use_date')->where('priceType',$lector->lector_type_id)->get();
            $typesN = ['','Zajęcia indywidualne','','','Zajęcia w parze'];
            $durN = ['','','55min','85min'];
            $cerN = ['','do egzaminu'];
           
            foreach($bank as $b){
                $jezyk = Payment::where('id',$b->payment_id)->first();
                $t = $typesN[$b->type_id];
                $d = $durN[$b->duration];
                $c = $cerN[$b->certificat];
                // $wykupioneLekcje['typ']['dlugosc']['certyfikat']
                if(!array_key_exists($t,$wykupioneLekcje) 
                || !array_key_exists($d,$wykupioneLekcje[$t]) 
                || !array_key_exists($c,$wykupioneLekcje[$t][$d])){
                    $wykupioneLekcje[$t][$d][$c]['ile'] = 1;
                    $wykupioneLekcje[$t][$d][$c]['jezyk'] = $jezyk->id_language;
                    $wykupioneLekcje[$t][$d][$c]['dlugosc'] = $b->duration;
                    $wykupioneLekcje[$t][$d][$c]['typ'] = $b->type_id;
                    $wykupioneLekcje[$t][$d][$c]['cert'] = $b->certificat;
                }else{
                    $wykupioneLekcje[$t][$d][$c]['ile']++;
                }
               
            }
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
        header("Cache-Control: no-cache, no-store, must-revalidate");
         $id = isset(Auth::user()->id) ? Auth::user()->id : 0;
             return view('test/lector',[
                'durations' => $duratons,
                'levels' => $levels,
                'topics' => $levels2,
                'lector' => $lector,
                'languages' => $languages,
                'lessonAmount' => $wykupioneLekcje,
                'calendar' => $calendarTab,
                'calendarMobile' => $calendarTabMobile,
                'User' => $id
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
                    ->where('lessons.type_id','!=',3)
                    ->orderby('calendar_events.start')
                    ->get();

        $lectors=[];
        
        foreach($lessons as $lesson){ 
            // Maile do uczniów
            $godzina = new Carbon($lesson->start);
            $lektor = $lesson->Emaillektor;
            $lectors[$lektor][$godzina->format('H:i')]= $lesson->title;
            if($lesson->type_id == 2 || $lesson->type_id == 3){
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
               echo "Mail do: ".$lesson->uEmail." lektor: ".$lesson->lektor." ,jezyk:".$lesson->name." godzina: ". $godzina->format('H:i').' skype: '.$s;
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
        echo "Mail do: ".$k." tresc: ".$lekcje;
        Mail::to($k)->send(new LectorMailLessonNotification($mailData));

    } 
 }
}
