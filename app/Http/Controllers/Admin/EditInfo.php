<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\PriceType;
use App\Models\LessonDuration;
use App\Models\LessonType;
use App\Models\Lesson;
use App\Models\Lector;
use App\Models\LanguageLevel;
use App\Models\Price;
use App\Models\DiscountPacket;
use App\Models\PaymentDetails;
use App\Models\Payment;
use App\Models\CalendarEvent;
use App\Models\CalendarSetup;
use App\Models\User;
use App\Models\LessonsBank;
use App\Models\EventUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ZapisNaZajeciaGrupowe;
use App\Mail\NewLessonInfo;
use Auth;
use Carbon\Carbon;

class EditInfo extends Controller
{
    public function Test(){
        $user = User::where('id',94)->first();
        dd($user->email);
    }
    // public function Test(){
    //     $id = 'QAHZ1FFoRWB4QLZ6SuG0WiWEZ7vdsHXlv4uThBgY20230913214139';
    //     $data = PaymentDetails::where('session_id',$id)->first();
    //     $userId =  $data['user_id'];
    //     $user = User::where('id',$userId)->first();
    //     if($data['typPlatnosci'] == 'LEKCJA'){
    //         $start = $data['start'];
    //         $hour = $data['hour'];
    //         $duration_id = $data['duration_id'];
    //         $language_id = $data['language_id'];
    //         $type_id =$data['type_id'] ;
    //         $lectorId = $data['lectorId'];
    //         $ileFaktura = $data['ileFaktura'];
    //         $cykliczne = $data['cykliczne'];
    //         $cert = $data['cert'];
    //         $ile = $data['ile'];
    //         $zajecia = $data['zajecia'];
    //         $priceG =$data['priceG'];

    //         $l = Language::where('id',$language_id)->first();
    //         $type = $l->price_type;
    //         $lName = $l->name;
    //         if($zajecia == 1){
    //             $price = $priceG;
    //             $kwota = $price;
    //         }else{
    //             $price = Price::where('type_id',$type_id)
    //                         ->where('price_type_id',$type)
    //                         ->where('duration_id',$duration_id)
    //                         ->where('certification',$cert)
    //                         ->first()
    //                         ->price; 
    //                         $kwota = $price*$ile;
    //         }

    //         $start2 =  date('Y-m-d H:i', strtotime($start.' '.$hour));
    //         $dlugosc = LessonDuration::where('id',$duration_id)->first()->duration;
    //         $end = date('Y-m-d H:i', strtotime($start2. ' + '.$dlugosc.' minutes'));
            
    //         if($zajecia != 1){
    //             $lesson = new Lesson;
    //             $lesson->type_id = $type_id;
    //             $lesson->duration_id = $duration_id;
    //             $lesson->amount_of_lessons = $ile;
    //             if($type_id == 1){
    //                 $studentow = 1;
    //                 $desc = 'Lekcja indywidualna z języka '.$lName.'ego';
    //             }
    //             else{
    //                 $studentow = 2;
    //                 $desc = 'Lekcja w parze z języka '.$lName.'ego';
    //             }
    //             $lesson->amount_of_students = $studentow;
    //             $lesson->price = $kwota;
    //             $lesson->start = $start2;
    //             $lesson->lector_id = $lectorId;
    //             $lesson->language_id = $language_id;
    //             $lesson->title = 'Zajęcia z '.$user->name.' '.$user->surname;
    //             $lesson->status = 0;
    //             $lesson->certificat = $cert;
    //             $lesson->save();
    //             $lessonId = $lesson->id;
    //             $ileFaktura = $ile;
    //             $lecMail = Lector::where('id', $lectorId)->first();
    //             try {
    //                 $mailData=[
    //                  'lector' => $lecMail->name.' ['.$lecMail->email.']',
    //                  'user' => $user->name.' '.$user->surname.' ['.$user->email.']',
    //                  'date' => $lesson->start,
    //                  'language' => 'Język '.$lName
    //                 ]; 
    //                 Mail::to('kontakt@languelove.pl')->send(new NewLessonInfo($mailData));
    //                 // return redirect()->back()->with('success','Wiadomość przesłana poprawnie');
    //              } catch (\Throwable $th) {
    //                 //  return redirect()->back()->with('error','UPS...Coś poszło nie tak');
    //              }
    //             Mail::to($lecMail->email)->send(new AcceptTermin());
    //         }else{
    //             $lessonId =  $data['lessonId'];
    //             $desc =  $data['title'];
    //             $info = CalendarEvent::where('lesson_id',$lessonId)->orderBy('start', 'desc')->first();
    //             $lesson = Lesson::where('id', $lessonId)->first();
    //             $s = new Carbon($lesson->start);
    //             $d = new Carbon($lesson->start);
    //             $day = $d->dayOfWeek;
    //             $mailData=[
    //                 'nazwa' => $desc,
    //                 'start' => $s->format('Y-m-d'),
    //                 'dzien' => Carbon::parse( $info->start)->locale('pl')->dayName,
    //                 'godzina' =>  Carbon::parse($info->start)->format('H:i'),
    //                ]; 
    //                Mail::to($user->email)->send(new ZapisNaZajeciaGrupowe($mailData));
    //         }

    //         if($zajecia != 1){
    //             for($i=0; $i<$ile; $i++){
    //                 $event = new CalendarEvent;
    //                 $event->start = $start2;
    //                 $event->end = $end;
    //                 $event->lector_id = $lectorId;
    //                 $event->type = 3;
    //                 $event->lesson_id =  $lessonId;
    //                 $event->save();
    
    
    //                 $calendar = new EventUsers;
    //                 $calendar->calendar_id = $event->id;
    //                 $calendar->user_id = $user->id;
    //                 $calendar->comment = '';
    //                 $calendar->status = 1;
    //                 $calendar->lector_accept = 0;
    //                 $calendar->student_accept = 1;
    //                 $calendar->save();
                    
    //                 $start2 = date('Y-m-d H:i', strtotime($start2. ' + 1 week'));
    //                 $end = date('Y-m-d H:i', strtotime($start2. ' + '.$dlugosc.' minutes'));
    //             }
    //         }else{
    //             $events = CalendarEvent::where('lesson_id',$lessonId)->get();
    //             foreach($events as $event){
    
    //                 $calendar = new EventUsers;
    //                 $calendar->calendar_id = $event->id;
    //                 $calendar->user_id = $user->id;
    //                 $calendar->comment = '';
    //                 $calendar->status = 3;
    //                 $calendar->lector_accept = 0;
    //                 $calendar->student_accept = 1;
    //                 $calendar->save();
    //             }
    //             $eventId =  $data['calendarId'];
    //         }
    //     }elseif($data['typPlatnosci'] == 'PAKIET')
    //     {
    //         $language_id = $data['langDesc'];
    //         $l = Language::where('id',$language_id)->first();
    //         $type = $l->price_type;
    //         $kwota =  $data['priceG'];
    //         $desc =  $data['title'];
    //         $pakiet = $data['packet'];
    //         $ileFaktura = 1;
    //         for($i=1; $i<=$pakiet; $i++){
    //               $bank = new LessonsBank;
    //                 $bank->user_id = $user->id;
    //                 $bank->payment_id = session()->get('payment_id') ; 
    //                 $bank->overdue_date = Carbon::now()->addDays(30);
    //                 $bank->type_id = $data['typeA'];
                    
    //                 $bank->priceType = $type;
    //                 $bank->certificat = $data['certyficate'];
    //                 $bank->save();
    //         }
          
    //     }
    //     $api = array();
    //     $api["api_id"] = "deeff9e22df4f2135e00ad03d29ccda7";
    //     $api["api_zadanie"] = "1";
    //     $api["dokument_dostep"] = "1";
    //     $api["dokument_rodzaj"] = "0";
    //     $api["dokument_marza"] = "0";
    //     $api["dokument_drugi_jezyk"] = "2";
    //     $api["dokument_zaplata"] = "20";
    //     $api["dokument_pokaz_zaplata"] = "1";
    //     $api["dokument_zaplacono"] = $kwota;
    //     $api["dokument_status"] = "1";
    //     $api["dokument_rodzaj_podstawa_zw"] = "3";
    //     $api["dokument_podstawa_zw"] = "Zgodnie z art. 43 ust. 1 pkt 1 ustawy o podatku od towarów i usług, szkoły językowe są zwolnione z podatku VAT.";
    //     $api["dokument_fp"] = "0";
    //     $api["sprzedawca_nazwa"] = "LangueLove Wiktoria Skrzypczak i Weronika Cieślak spółka cywilna";
    //     $api["sprzedawca_nip"] = "9452266907";
    //     $api["sprzedawca_miasto"] = "Kraków";
    //     $api["sprzedawca_kod"] = "31-445";
    //     $api["sprzedawca_ulica"] = "Łaszkiewicza";
    //     $api["sprzedawca_budynek"] = "4";
    //     $api["sprzedawca_lokal"] = "39";
    //     if($data['nip'] != ''){
    //         $api["nabywca_osoba"] = 0;
    //         $api["nabywca_nazwa"] = $data['name'];
    //         $api["nabywca_nip"] = $data['nip'];
    //     }else{
    //         $dane = explode(" ",$data['name']);
    //         $api["nabywca_osoba"] = 1;
    //         $api["nabywca_imie"] = $dane[0];
    //         $api["nabywca_nazwisko"] = $dane[1];
    //     }
        
    //     $api["nabywca_miasto"] = $data['city'];
    //     $api["nabywca_kod"] = $data['postcode'];
    //     $api["nabywca_ulica"] = $data['street'];


    //     $api["produkt_nazwa"] = $desc;
    //     $api["produkt_ilosc"] = $ileFaktura;
    //     $api["produkt_jm"] = "2";
    //     $api["produkt_stawka_vat"] = "zw";
    //     $api["produkt_wartosc_brutto"] = $kwota;
    //     $curl = curl_init();
    //     curl_setopt($curl,CURLOPT_URL,"https://www.fakturowo.pl/api");
    //     curl_setopt($curl,CURLOPT_POST,1);
    //     curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,300);
    //     curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    //     curl_setopt($curl,CURLOPT_POSTFIELDS,$api);
    //     $result = curl_exec($curl);
    //     curl_close($curl);


    //     //Pozytywna odpowiedź otrzymana w wyniku powyższego działania (parametr dokument_dostep=1):

    //     $faktura = '';
    //     $result = explode("\n",$result);

    //     $session_id = $id;
    //     $payment = Payment::where('session_id',$session_id)->first();

    //     if ($result[0]==1)
    //     {
    //        $payment->invoice = $result[3];
    //     }
    //     else
    //     {
    //         $payment->invoice = "ERROR: ".$result[1];
    //     }
    //     $payment->save();
    // }
    // public function Test()
    // {
    //     $lector = 7;
    //     $months = [
    //         '',
    //         'stycznia',
    //         'lutego',
    //         'marca',
    //         'kwietnia',
    //         'maja',
    //         'czerwca',
    //         'lipca',
    //         'sierpnia',
    //         'września',
    //         'października',
    //         'listopada',
    //         'grudnia'
    //     ];
    //     $days=[
    //         'Nd.',
    //         'Pon.',
    //         'Wt.',
    //         'Śr.',
    //         'Czw.',
    //         'Pt.',
    //         'Sb.'
    //     ];

    //     $calendar_Free = CalendarSetup::where('lector_id',$lector)
    //                                     ->where('type',1)
    //                                     ->where('start','>=',Carbon::now())
    //                                     ->get();
    //     $calendar_Events = CalendarEvent::where('lector_id',$lector)
    //                                     ->where('start','>=',Carbon::now())
    //                                     ->get();

    //     $maxDate = CalendarSetup::where('lector_id',$lector)->max('end');
    //     $maxDate2 = CalendarEvent::where('lector_id',$lector)->max('end');
    //     if($maxDate2 >$maxDate ){
    //         $maxDate = $maxDate2;
    //     }
    //     $calendar_Taken= CalendarSetup::where('lector_id',$lector)
    //                                     ->where('type',0)
    //                                     ->where('start','>=',Carbon::now())
    //                                     ->get();

    //     $dateStart = Carbon::tomorrow();
    //     $dataTestowa = new Carbon($maxDate);
    //     $maxDate = new Carbon($maxDate);
    //     $maxDate = $maxDate->endOfWeek()->format('Y-m-d');
    //     $dateUsed = $dateStart->startOfWeek()->format('Y-m-d');
    //     $calendarTab = [];
    //     $calendarTabMobile = [];
    //     $helpDate = new Carbon('01-01-2023 07:00');
    //     while($dateUsed <= $maxDate){

    //         $hpDate = new Carbon($dateUsed);
    //         $weekStart = $hpDate->startOfWeek()->format('d');
    //         $wednesday = $hpDate->startOfWeek()->addDays('2')->format('d').' '.$months[intval($hpDate->format('m'))].' '.$hpDate->endOfWeek()->format('Y');
    //         $thursday = $hpDate->startOfWeek()->addDays('3')->format('d');
    //         $saturday = $hpDate->startOfWeek()->addDays('5')->format('d').' '.$months[intval($hpDate->format('m'))].' '.$hpDate->endOfWeek()->format('Y');
            
    //         $weekEnd= $hpDate->endOfWeek()->format('d').' '.$months[intval($hpDate->format('m'))].' '.$hpDate->endOfWeek()->format('Y');
    //         // dd($saturday);
    //         $dayNum = new Carbon($dateUsed);
    //         if($dayNum->dayOfWeek > 3){
    //             $TabName = $thursday.'-'.$saturday;
    //         }
    //         else{
    //             $TabName = $weekStart.'-'.$wednesday;
    //         }
    //         if($dayNum->dayOfWeek != 0){
    //             $calendarTabMobile[$TabName][$dateUsed]=[];
    //         }
           

    //         $calendarTab[$weekStart.'-'.$weekEnd][$dateUsed]=[];
    //         $nweDate = new Carbon($dateUsed);
    //         $day = $nweDate->dayOfWeek;
    //         $calendarTab[$weekStart.'-'.$weekEnd][$dateUsed]['name']=$days[$day];
    //         if($day != 0){
    //             $calendarTabMobile[$TabName][$dateUsed]['name']=$days[$day];
    //         }
    //         $calendarTab[$weekStart.'-'.$weekEnd][$dateUsed]['shortDate']=$nweDate->format('d.m');
    //         if($day != 0){
    //             $calendarTabMobile[$TabName][$dateUsed]['shortDate']=$nweDate->format('d.m');
    //         }
    //         $hourMax = '20:30';
    //         while($helpDate->roundMinute(30)->format('H:i') != $hourMax){
    //             $calendarTab[$weekStart.'-'.$weekEnd][$dateUsed][$helpDate->roundMinute(30)->format('H:i')] = [];
    //             if($day != 0){
    //                 $calendarTabMobile[$TabName][$dateUsed][$helpDate->roundMinute(30)->format('H:i')] = [];
    //             }
    //             $helpDate = $helpDate->addMinutes(30);
    //         }
            
    //         $helpDate = new Carbon('01-01-2023 07:00');
    //         $dateUsed = new Carbon($dateUsed);
    //         $dateUsed = $dateUsed->addDay();
    //         $dateUsed = $dateUsed->format('Y-m-d');
    //     }
    //     foreach($calendar_Free as $cF){
            
    //         $start = new Carbon($cF->start);
    //         $start2 =  new Carbon($cF->start);
    //         $startDate = $start->format('Y-m-d');
    //         $startHour = $start2->format('H:i');
            
    //         $weekStart = $start->startOfWeek()->format('d');
    //             $wednesday = $start->startOfWeek()->addDays('2')->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
    //             $thursday = $start->startOfWeek()->addDays('3')->format('d');
    //             $saturday = $start->startOfWeek()->addDays('5')->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
    //         $weekEnd= $start->endOfWeek()->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');

    //         $dayNum = new Carbon($startDate);
    //         if($dayNum->dayOfWeek > 3){
    //             $TabName = $thursday.'-'.$saturday;
    //         }
    //         else{
    //             $TabName = $weekStart.'-'.$wednesday;
    //         }

    //         $end = new Carbon($cF->end);
    //         $end = $end->subMinutes(60);
    //         $endHour = $end->format('H:i');
    //         while($startHour <= $endHour){
    //             $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['free'] = 1;
    //                      $calendarTabMobile[$TabName][$startDate][$startHour]['free'] = 1;
    //             $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['60'] = 1;
    //                      $calendarTabMobile[$TabName][$startDate][$startHour]['60'] = 1;
    //             $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['90'] = 1;
    //                      $calendarTabMobile[$TabName][$startDate][$startHour]['90'] = 1;
    //             // echo '['.$weekStart.'-'.$weekEnd.']['.$startDate.']['.$startHour.']<br>';
    //             $start = $start2->addMinutes(30);
    //             $startHour = $start->format('H:i');
    //         }
    //         $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['free'] = 1;
    //             $calendarTabMobile[$TabName][$startDate][$startHour]['free'] = 1;
    //         $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['60'] = 1;
    //             $calendarTabMobile[$TabName][$startDate][$startHour]['60'] = 1;
    //         $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['90'] = 0;
    //             $calendarTabMobile[$TabName][$startDate][$startHour]['90'] = 0;
    //     }
       
    //     foreach($calendar_Taken as $cF){
    //         $start = new Carbon($cF->start);
    //         $start2 = new Carbon($cF->start);
    //         $startDate = $start->format('Y-m-d');
    //         $startHour = $start2->format('H:i');

    //         $weekStart = $start->startOfWeek()->format('d');
    //             $wednesday = $start->startOfWeek()->addDays('2')->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
    //             $thursday = $start->startOfWeek()->addDays('3')->format('d');
    //             $saturday = $start->startOfWeek()->addDays('5')->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
    //         $weekEnd= $start->endOfWeek()->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');

    //         $dayNum = new Carbon($startDate);
    //         if($dayNum->dayOfWeek > 3){
    //             $TabName = $thursday.'-'.$saturday;
    //         }
    //         else{
    //             $TabName = $weekStart.'-'.$wednesday;
    //         }

    //         $end = new Carbon($cF->end);
    //         $end = $end->subMinutes(30);
    //         $endHour = $end->format('H:i');

    //         $h = $start;
    //         $del1 = $h->subMinutes(30);
    //         $del1 = $del1->format('H:i');
    //         $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['free'] = 0;
    //                  $calendarTabMobile[$TabName][$startDate][$del1]['free'] = 0;
    //         $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['60'] = 0;
    //                  $calendarTabMobile[$TabName][$startDate][$del1]['60'] = 0;
    //         $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['90'] = 0;
    //                  $calendarTabMobile[$TabName][$startDate][$del1]['90'] = 0;


    //         $del2 = $h->subMinutes(30);
    //         $del2 = $del2->format('H:i');
    //         $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del2]['90'] = 0;
    //             $calendarTabMobile[$TabName][$startDate][$del2]['90'] = 0;

    //         while($startHour <= $endHour){
    //             $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['free'] = 0;
    //                      $calendarTabMobile[$TabName][$startDate][$startHour]['free'] = 0;
    //             $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['60'] = 0;
    //                      $calendarTabMobile[$TabName][$startDate][$startHour]['60'] = 0;
    //             $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['90'] = 0;
    //                      $calendarTabMobile[$TabName][$startDate][$startHour]['90'] = 0;
    //             $start = $start2->addMinutes(30);
    //             $startHour = $start->format('H:i');
    //         }
    //     }
    //      dd($calendarTabMobile);
    //     foreach($calendar_Events as $cF){
            
    //         $start = new Carbon($cF->start);
    //         $startDate = $start->format('Y-m-d');
    //         $startHour = $start->roundMinute(30)->format('H:i');

    //         $weekStart = $start->startOfWeek()->format('d');
    //             $wednesday = $start->startOfWeek()->addDays('2')->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
    //             $thursday = $start->startOfWeek()->addDays('3')->format('d');
    //             $saturday = $start->startOfWeek()->addDays('5')->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');
    //         $weekEnd= $start->endOfWeek()->format('d').' '.$months[intval($start->format('m'))].' '.$start->endOfWeek()->format('Y');

    //         $dayNum = new Carbon($startDate);
    //         if($dayNum->dayOfWeek > 3){
    //             $TabName = $thursday.'-'.$saturday;
    //         }
    //         else{
    //             $TabName = $weekStart.'-'.$wednesday;
    //         }

    //         $end = new Carbon($cF->end);
    //         $end = $end->subMinutes(30);
    //         $endHour = $end->roundMinute(30)->format('H:i');

    //         $h = $start;
    //         $del1 = $h->subMinutes(30);
    //         $del1 = $del1->roundMinute(30)->format('H:i');
    //         $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['free'] = 0;
    //                  $calendarTabMobile[$TabName][$startDate][$del1]['free'] = 0;
    //         $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['60'] = 0;
    //                  $calendarTabMobile[$TabName][$startDate][$del1]['60'] = 0;
    //         $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del1]['90'] = 0;
    //                  $calendarTabMobile[$TabName][$startDate][$del1]['90'] = 0;


    //         $del2 = $h->subMinutes(30);
    //         $del2 = $del2->roundMinute(30)->format('H:i');
    //         $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$del2]['90'] = 0;
    //                  $calendarTabMobile[$TabName][$startDate][$del2]['90'] = 0;
    //         // $calendarTab[$startDate][$del2]['90'] = 0;
    //         // dd($startDate);

    //         while($startHour <= $endHour){
    //             $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['free'] = 0;
    //                      $calendarTabMobile[$TabName][$startDate][$startHour]['free'] = 0;
    //             $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['60'] = 0;
    //                      $calendarTabMobile[$TabName][$startDate][$startHour]['60'] = 0;
    //             $calendarTab[$weekStart.'-'.$weekEnd][$startDate][$startHour]['90'] = 0;
    //                      $calendarTabMobile[$TabName][$startDate][$startHour]['90'] = 0;
    //             $start = $start->addMinutes(30);
    //             $startHour = $start->roundMinute(30)->format('H:i');
    //         }
    //     }
     
    //     dd($calendarTab);
    // }
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
