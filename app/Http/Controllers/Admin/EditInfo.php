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
use App\Models\PaymentDetails;
use App\Models\CalendarSetup;
use App\Models\LessonsBank;
use App\Models\EventUsers;
use Auth;
use Carbon\Carbon;

class EditInfo extends Controller
{
    public function Test()
    {
        // $data = PaymentDetails::where('session_id',$id)->first();
        $id = 'nzokEZkn0FeoEdo1Ku9oONoZIo5MbPxEDgwDfU8J20230910140125';
        $data = PaymentDetails::where('session_id',$id)->first();
        if($data['typPlatnosci'] == 'LEKCJA'){
            $start = $data['start'];
            $hour = $data['hour'];
            $duration_id = $data['duration_id'];
            $language_id = $data['language_id'];
            $type_id =$data['type_id'] ;
            $lectorId = $data['lectorId'];
            $ileFaktura = $data['ileFaktura'];
            $cykliczne = $data['cykliczne'];
            $cert = $data['cert'];
            $ile = $data['ile'];
            $zajecia = $data['zajecia'];
            $priceG =$data['priceG'];

            $l = Language::where('id',$language_id)->first();
            $type = $l->price_type;
            $lName = $l->name;
            if($zajecia == 1){
                $price = $priceG;
                $kwota = $price;
            }else{
                $price = Price::where('type_id',$type_id)
                            ->where('price_type_id',$type)
                            ->where('duration_id',$duration_id)
                            ->where('certification',$cert)
                            ->first()
                            ->price; 
                            $kwota = $price*$ile;
            }

            $start2 =  date('Y-m-d H:i', strtotime($start.' '.$hour));
            $dlugosc = LessonDuration::where('id',$duration_id)->first()->duration;
            $end = date('Y-m-d H:i', strtotime($start2. ' + '.$dlugosc.' minutes'));
            
            if($zajecia != 1){
                $lesson = new Lesson;
                $lesson->type_id = $type_id;
                $lesson->duration_id = $duration_id;
                $lesson->amount_of_lessons = $ile;
                if($type_id == 1){
                    $studentow = 1;
                    $desc = 'Lekcja indywidualna z języka '.$lName.'ego';
                }
                else{
                    $studentow = 2;
                    $desc = 'Lekcja w parze z języka '.$lName.'ego';
                }
                $lesson->amount_of_students = $studentow;
                $lesson->price = $kwota;
                $lesson->start = $start2;
                $lesson->lector_id = $lectorId;
                $lesson->language_id = $language_id;
                $lesson->title = 'Zajęcia z '.Auth::user()->name.' '.Auth::user()->surname;
                $lesson->status = 0;
                $lesson->certificat = $cert;
                $lesson->save();
                $lessonId = $lesson->id;
                $ileFaktura = $ile;
                $lecMail = Lector::where('id', $lectorId)->first();
                try {
                    $mailData=[
                     'lector' => $lecMail->name.' ['.$lecMail->email.']',
                     'user' => Auth::user()->name.' '.Auth::user()->surname.' ['.Auth::user()->email.']',
                     'date' => $lesson->start,
                     'language' => 'Język '.$lName
                    ]; 
                    Mail::to('kontakt@languelove.pl')->send(new NewLessonInfo($mailData));
                    // return redirect()->back()->with('success','Wiadomość przesłana poprawnie');
                 } catch (\Throwable $th) {
                    //  return redirect()->back()->with('error','UPS...Coś poszło nie tak');
                 }
                Mail::to($lecMail->email)->send(new AcceptTermin());
            }else{
                $lessonId =  $data['lessonId'];
                $desc =  $data['title'];
            }

            if($zajecia != 1){
                for($i=0; $i<$ile; $i++){
                    $event = new CalendarEvent;
                    $event->start = $start2;
                    $event->end = $end;
                    $event->lector_id = $lectorId;
                    $event->type = 3;
                    $event->lesson_id =  $lessonId;
                    $event->save();
    
    
                    $calendar = new EventUsers;
                    $calendar->calendar_id = $event->id;
                    $calendar->user_id = 89;
                    $calendar->comment = '';
                    $calendar->status = 1;
                    $calendar->lector_accept = 0;
                    $calendar->student_accept = 1;
                    $calendar->save();
                    
                    $start2 = date('Y-m-d H:i', strtotime($start2. ' + 1 week'));
                    $end = date('Y-m-d H:i', strtotime($start2. ' + '.$dlugosc.' minutes'));
                }
            }else{
                $events = CalendarEvent::where('lesson_id',$lessonId)->get();
                foreach($events as $event){
    
                    $calendar = new EventUsers;
                    $calendar->calendar_id = $event->id;
                    $calendar->user_id = 89;
                    $calendar->comment = '';
                    $calendar->status = 3;
                    $calendar->lector_accept = 0;
                    $calendar->student_accept = 1;
                    $calendar->save();
                }
                $eventId =  $data['calendarId'];
            }
        }elseif($data['typPlatnosci'] == 'PAKIET')
        {
            $language_id = $data['langDesc'];
            $l = Language::where('id',$language_id)->first();
            $type = $l->price_type;
            $kwota =  $data['priceG'];
            $desc =  $data['title'];
            $pakiet = $data['packet'];
            $ileFaktura = 1;
            for($i=1; $i<=$pakiet; $i++){
                  $bank = new LessonsBank;
                    $bank->user_id = 89;
                    $bank->payment_id = session()->get('payment_id') ; 
                    $bank->overdue_date = Carbon::now()->addDays(30);
                    $bank->type_id = $data['typeA'];
                    
                    $bank->priceType = $type;
                    $bank->certificat = $data['certyficate'];
                    $bank->save();
            }
          
        }
        $api = array();
        $api["api_id"] = "deeff9e22df4f2135e00ad03d29ccda7";
        $api["api_zadanie"] = "1";
        $api["dokument_dostep"] = "1";
        $api["dokument_rodzaj"] = "0";
        $api["dokument_marza"] = "0";
        $api["dokument_drugi_jezyk"] = "2";
        $api["dokument_zaplata"] = "20";
        $api["dokument_pokaz_zaplata"] = "1";
        $api["dokument_zaplacono"] = $kwota;
        $api["dokument_status"] = "1";
        $api["dokument_rodzaj_podstawa_zw"] = "3";
        $api["dokument_podstawa_zw"] = "Zgodnie z art. 43 ust. 1 pkt 1 ustawy o podatku od towarów i usług, szkoły językowe są zwolnione z podatku VAT.";
        $api["dokument_fp"] = "0";
        $api["sprzedawca_nazwa"] = "LangueLove Wiktoria Skrzypczak i Weronika Cieślak spółka cywilna";
        $api["sprzedawca_nip"] = "9452266907";
        $api["sprzedawca_miasto"] = "Kraków";
        $api["sprzedawca_kod"] = "31-445";
        $api["sprzedawca_ulica"] = "Łaszkiewicza";
        $api["sprzedawca_budynek"] = "4";
        $api["sprzedawca_lokal"] = "39";
        if($data['nip'] != ''){
            $api["nabywca_osoba"] = 0;
            $api["nabywca_nazwa"] = $data['name'];
            $api["nabywca_nip"] = $data['nip'];
        }else{
            $dane = explode(" ",$data['name']);
            $api["nabywca_osoba"] = 1;
            $api["nabywca_imie"] = $dane[0];
            $api["nabywca_nazwisko"] = $dane[1];
        }
        
        $api["nabywca_miasto"] = $data['city'];
        $api["nabywca_kod"] = $data['postcode'];
        $api["nabywca_ulica"] = $data['street'];


        $api["produkt_nazwa"] = $desc;
        $api["produkt_ilosc"] = $ileFaktura;
        $api["produkt_jm"] = "2";
        $api["produkt_stawka_vat"] = "zw";
        $api["produkt_wartosc_brutto"] = $kwota;
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,"https://www.fakturowo.pl/api");
        curl_setopt($curl,CURLOPT_POST,1);
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,300);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$api);
        $result = curl_exec($curl);
        curl_close($curl);


        //Pozytywna odpowiedź otrzymana w wyniku powyższego działania (parametr dokument_dostep=1):

        $faktura = '';
        $result = explode("\n",$result);

        $session_id = $id;
        $payment = Payment::where('session_id',$session_id)->first();

        if ($result[0]==1)
        {
           $payment->invoice = $result[3];
        }
        else
        {
            $payment->invoice = "ERROR: ".$result[1];
        }
        $payment->save();
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
