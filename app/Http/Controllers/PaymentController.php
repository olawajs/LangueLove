<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp;
use Illuminate\Support\Facades\Http;
use App\Models\Payment;
use App\Models\Lesson;
use App\Models\LessonDuration;
use App\Models\Language;
use App\Models\Lector;
use App\Models\CalendarEvent;
use App\Models\Code;
use App\Models\EventUsers;
use App\Models\LessonsBank;
use App\Models\Price;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThankYou;
use App\Mail\NewLessonInfo;
use App\Mail\AcceptTermin;
use Auth;
use Carbon\Carbon;

class PaymentController extends Controller
{   
    // $link = 'https://secure.przelewy24.pl/';
    // $merchant_id = 207228;
    // $crc_code = '89cb17cc0941683b';
    // $apiKey = 'bc839088e33f425cd818e56eac59d080';

    // testowe
    // $link = 'https://sandbox.przelewy24.pl/';
    // $merchant_id = 207228;
    // $crc_code = '53567c4b2d150c3d';
    // $apiKey = 'fba1a0238b6ea8982053bbef3915c12b';

    public function  buyLesson(Request $request){
        $PromoCode = isset($request->PromoCode) ? $request->PromoCode : '';
    $RequestTab = [
        'typPlatnosci' => 'LEKCJA',
        'start' => $request->data,
        'hour' => $request->godzina,
        'duration_id' => $request->duration_id,
        'language_id' => $request->jezyk,
        'type_id' => $request->rodzaj,
        'lectorId' => $request->lectorId,
        'ileFaktura' => 1,
        'ile' => isset($request->ile) ? $request->ile : 1,
        'cert' => isset($request->cert) ? 1 : 0,
        'zajecia' => isset($request->zajecia) ? 1 : 0,
        'cykliczne' => isset($request->cykliczne) ? 1 : 0,
        'priceG' => isset($request->price) ? $request->price : 0,
        'lessonI' => $request->lessonI,
        'title' => $request->title,
        'calendarId' => $request->calendarId,
        'lessonId' => $request->lessonId,
        'name' => $request->name,
        'nip' => isset($request->nip) ? $request->nip : '',
        'city' => $request->city,
        'postcode' => $request->postcode,
        'street' => $request->street,
    ];
        $request->session()->put('data', $RequestTab);
       
        $language_id = $request->jezyk;
        $duration_id = $request->duration_id;
        $cert = isset($request->cert) ? 1 : 0;
        $zajecia =  isset($request->zajecia) ? 1 : 0;
        $priceG = isset($request->price) ? $request->price : 0;
        $ile = isset($request->ile) ? $request->ile : 1;
        $type_id = $request->rodzaj;
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
        
        if($type_id == 1){
            $desc = 'Lekcja indywidualna z języka '.$lName.'ego';
        }else if($type_id == 4){
           $desc = 'Lekcja w parze z języka '.$lName.'ego';
        }
        else{
             $desc = $request->title;
        }
        $link = 'https://secure.przelewy24.pl/';
        $merchant_id = 207228;
        $crc_code = '89cb17cc0941683b';
        $apiKey = 'bc839088e33f425cd818e56eac59d080';

    
        $payment = new Payment;
        $payment->price = $kwota;
        $payment->description =  $desc;
        $payment->id_language = $language_id;
        $payment->id_user = Auth::user()->id;
            $session_id = Session::getId().date('YmdHis');
            // Session::put('payment_session', $session_id);
            $request->session()->put('payment_session', $session_id);
            
        $payment->session_id = $session_id;
        $payment->quantity = 1;
        $payment->status = 1;

        $payment->name = $request->name;
        $payment->street = $request->street;
        $payment->postcode = $request->postcode;
        $payment->city = $request->city;
        $payment->nip = isset($request->nip) ? $request->nip : '';
      $payment->save();
        Session::put('payment_id',$payment->id);
        $request->session()->put('payment_id', $payment->id);

      if($PromoCode != ''){
        Code::where('code',$PromoCode)->update(['use_date' => Carbon::now(),'payment_id' => $payment->id ]);
      }

        $suma_zamowienia = $kwota*100 ; //wartość musi być podana w groszach
        $tytul = $desc ;
        $token = $this->getToken($suma_zamowienia,$tytul,$session_id);
        return new RedirectResponse($link.'trnRequest/'.$token);

    }
    public function  useLessons(Request $request){
        $start = $request->data;
        $hour = $request->godzina;
        $duration_id = $request->duration_id;
        $language_id = $request->jezyk;
        $type_id = $request->rodzaj;
        $lectorId = $request->lectorId;


        $cykliczne = isset($request->cykliczne) ? 1 : 0;
        $cert = isset($request->cert) ? 1 : 0;
        $ile = isset($request->ile) ? $request->ile : 1;
        $zajecia = isset($request->zajecia) ? 1 : 0;
        $priceG = isset($request->price) ? $request->price : 0;

        
        $l = Language::where('id',$language_id)->first();
        $type = $l->price_type;
        $lName = $l->name;
       
         $start2 =  date('Y-m-d H:i', strtotime($start.' '.$hour));
        $dlugosc = LessonDuration::where('id',$duration_id)->first()->duration;
        $end = date('Y-m-d H:i', strtotime($start2. ' + '.$dlugosc.' minutes'));

            $lesson = new Lesson;
            $lesson->type_id = $type_id;
            $lesson->duration_id = $duration_id;
            $lesson->amount_of_lessons = $ile;
            if($type_id == 1){
                $studentow = 1;
            }
            else{
                $studentow = 2;
            }
            $lesson->amount_of_students = $studentow;
            $lesson->price = '0';
            $lesson->start = $start2;
            $lesson->lector_id = $lectorId;
            $lesson->language_id = $language_id;
            $lesson->title = 'Zajęcia z '.Auth::user()->name.' '.Auth::user()->surname;
            $lesson->status = 0;
            $lesson->certificat = $cert;
            $lesson->save();
            $lessonId = $lesson->id;

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
                $calendar->user_id = Auth::user()->id;
                $calendar->comment = '';
                $calendar->status = 1;
                $calendar->lector_accept = 0;
                $calendar->student_accept = 1;
                $calendar->save();
                // 
                $lessonBank = LessonsBank::where(['user_id' => Auth::user()->id, 
                                    'priceType' => $type,
                                    'certificat' => $cert,
                                    'type_id' => $type_id
                                    ])
                            ->where('overdue_date','>=',Carbon::now())
                            ->whereNull('use_date')
                            ->first()   ;
                 $lessonBank->use_date = Carbon::now();
                 $lessonBank->save();
                $Hdate = $lessonBank->created_at;
                $check = LessonsBank::where('payment_id', $lessonBank->payment_id)->whereNotNull('use_date')->count();
                if($check == 1){
                    $date = new Carbon($Hdate);
                    $ileL=LessonsBank::where('payment_id', $lessonBank->payment_id)->count(); 

                    $date = $date->addWeeks($ileL);
                    $lessonBank = LessonsBank::where('payment_id', $lessonBank->payment_id)
                    ->whereNull('use_date')
                    ->update(['overdue_date' => $date]);
                }
                

                $start2 = date('Y-m-d H:i', strtotime($start2. ' + 1 week'));
                $end = date('Y-m-d H:i', strtotime($start2. ' + '.$dlugosc.' minutes'));
            }
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
            return redirect()->back()->with('success','Lekcja zarezerwowana poprawnie');
            // return Redirect::to('https://languelove.pl/priceList/search/1/1');
    }
    public function  transaction(Request $request)
    {
       
        $RequestTab = [
            'typPlatnosci' => 'PAKIET',
            'priceG' => isset($request->price) ? $request->price : 0,
            'title' => $request->desc,
            'name' => $request->name,
            'nip' => isset($request->nip) ? $request->nip : '',
            'city' => $request->city,
            'postcode' => $request->postcode,
            'street' => $request->street,
            'langDesc' => $request->langDesc,
            'packet' => $request->packet,
            'typeA' => $request->typeA,
            'certyficate' => $request->certyficate,
        ];
        $request->session()->put('data', $RequestTab);
        $link = 'https://secure.przelewy24.pl/';
        $merchant_id = 207228;
        $crc_code = '89cb17cc0941683b';
        $apiKey = 'bc839088e33f425cd818e56eac59d080';

        $payment = new Payment;
        $payment->price = $request->price;
        $payment->description = $request->desc;
        $payment->id_language = $request->langDesc;
        $payment->id_user = Auth::user()->id;
        $session_id = Session::getId().date('YmdHis');
            // Session::put('payment_session', $session_id);
            $request->session()->put('payment_session', $session_id);
        $payment->session_id = $session_id;
        $payment->quantity = 1;
        $payment->status = 1;
        $payment->name = $request->name;
        $payment->street = $request->street;
        $payment->postcode = $request->postcode;
        $payment->city = $request->city;
        $payment->nip = isset($request->nip) ? $request->nip : '';
        $payment->save();
        // Session::put('payment_id',$payment->id);
        $request->session()->put('payment_id', $payment->id);
        

        $suma_zamowienia = $request->price*100 ; //wartość musi być podana w groszach
        $tytul = $request->desc;
        
        $token = $this->getToken($suma_zamowienia,$tytul,$session_id);
        return new RedirectResponse($link.'trnRequest/'.$token);

    }
    
    public function  status(){
        // dd('status');
    }
    
    public function getReturn(){
        
        $link = 'https://secure.przelewy24.pl/';
        $merchant_id = 207228;
        $crc_code = '89cb17cc0941683b';
        $apiKey = 'bc839088e33f425cd818e56eac59d080';

        // $session_id = Session::get('payment_session');
        $session_id = $request->session()->get('payment_session');
        $payment_id = $request->session()->get('payment_id');

        $payment = Payment::where('session_id',$session_id)->orWhere('id',$payment_id)->first();

        $basicAuth = base64_encode($merchant_id.':'.$apiKey );
        $kwota =  ($payment->price)*100;
        $sign = '{"sessionId":"'.$session_id.'","amount":'.$kwota.',"currency":"PLN","crc":"'.$crc_code.'"}';
        $sign = hash('sha384', $sign);

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $link.'api/v1/transaction/by/sessionId/'.$session_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.$basicAuth,
        )));

        $response = json_decode(curl_exec($curl));
        // dd ($curl);
        $OrderId = $response->data->orderId;
        
        curl_close($curl);

        $sign2 = '{"sessionId":"'.$session_id.'","orderId":'.$OrderId.',"amount":'.$kwota.',"currency":"PLN","crc":"'.$crc_code.'"}';
        $sign2 = hash('sha384', $sign2);
        $curl2 = curl_init();
        curl_setopt_array($curl2, array(
        CURLOPT_URL => $link.'api/v1/transaction/verify',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS =>'{
            "merchantId": '.$merchant_id.',
            "posId": '.$merchant_id.',
            "sessionId": "'.$session_id.'",
            "amount": '.$kwota.',
            "currency": "PLN",
            "orderId": '.$OrderId.',
            "sign": "'.$sign2.'" 
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.$basicAuth,
            'Content-Type: application/json',
        ),
        ));

        $response2 = json_decode(curl_exec($curl2));
        if($response2->data->status == 'success'){
            $payment->status = 2;
            $payment->save();
            $this->CreateLessons();
            Mail::to(Auth::user()->email)->send(new ThankYou());
           
            return view('thankYou');
        }else{
            $payment->status = 3;
            $payment->save();
            dd('Wystąpił niespodziewany błąd');
        }

    
  
    }
    public static function CreateLessons(){
        $data = session()->get('data');
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
                    $calendar->user_id = Auth::user()->id;
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
                    $calendar->user_id = Auth::user()->id;
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
                    $bank->user_id = Auth::user()->id;
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

        $session_id = Session::get('payment_session', 'default');
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
    public static function getToken($kwota,$zamowienie,$session_id){
        
        $link = 'https://secure.przelewy24.pl/';
        $merchant_id = 207228;
        $crc_code = '89cb17cc0941683b';
        $apiKey = 'bc839088e33f425cd818e56eac59d080';

        $sign = '{"sessionId":"'.$session_id.'","merchantId":'.$merchant_id.',"amount":'.$kwota.',"currency":"PLN","crc":"'.$crc_code.'"}';
        $sign = hash('sha384', $sign);
        $basicAuth = base64_encode($merchant_id.':'.$apiKey );
        $email = Auth::user()->email;
        $name = Auth::user()->name.' '.Auth::user()->surname;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $link.'api/v1/transaction/register',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
                "merchantId": '.$merchant_id.',
                "posId": '.$merchant_id.',
                "sessionId": "'.$session_id.'",
                "amount": '.$kwota.',
                "currency": "PLN",
                "description": "'.$zamowienie.'",
                "email": "'.$email.'",
                "client": "'. $name.'",
                "country": "PL",
                "language": "pl",
                "method": 0,
                "urlReturn": "https://languelove.pl/payment/validate",
                "urlStatus": "https://languelove.pl/payment/validate",
                "timeLimit": 0,
                "channel": 7,
                "waitForResult": true,
                "transferLabel": "Platnosc z LangueLove",
                "sign": "'.$sign.'" 
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$basicAuth,
                'Content-Type: application/json',
            ),
        ));
    
  
        $response = json_decode(curl_exec($curl));
        return $response->data->token;
    }
    public static function getOrderId(){
        $curl = curl_init();
        $session_id = session()->get('kuchnia_payment_session');
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sandbox.przelewy24.pl/api/v1/transaction/by/sessionId/'.$session_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic MTcyOTQ3OjQzN2RiYjVkYjJjYjdhZjhjNmQ5YjUxNzY1OTYwMjY0'),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
      
        return $response;
    }
    
    public static function VerifyPament($kwota,$orderId){
      $curl = curl_init();
      $session_id = session()->get('kuchnia_payment_session');
      $crc_code = '1f877e568ba89a84';
      $sign = '{"sessionId":"'.$session_id.'","orderId":'.$orderId.',"amount":'.$kwota.',"currency":"PLN","crc":"'.$crc_code.'"}';
      $sign = hash('sha384', $sign);
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://secure.przelewy24.pl/api/v1/transaction/verify',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS =>'{
          "merchantId": 172947,
          "posId": 172947,
          "sessionId": "'.$session_id.'",
          "amount": '.$kwota.',
          "currency": "PLN",
          "orderId": '.$orderId.',
          "sign": "'.$sign.'"
      }',
        CURLOPT_HTTPHEADER => array(
          'Authorization: Basic MTcyOTQ3OjQzN2RiYjVkYjJjYjdhZjhjNmQ5YjUxNzY1OTYwMjY0',
          'Content-Type: application/json' ),
      ));
      
      $response = curl_exec($curl);
      
      curl_close($curl);
      return $response;
    }
}
