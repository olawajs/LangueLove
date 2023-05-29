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
use App\Models\CalendarEvent;
use App\Models\EventUsers;
use App\Models\LessonsBank;
use App\Models\Price;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThankYou;
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
                $desc = 'Lekcja indywidualna z języka'.$lName;
            }
            else{
                $studentow = 2;
                $desc = 'Lekcja w parze z języka'.$lName;
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
        }else{
            $lessonId = $request->lessonId;
            $desc = $request->title;
        }

        if($zajecia == 1){
            for($i=0; $i<=$ile; $i++){
                $event = new CalendarEvent;
                $event->start = $start2;
                $event->end = $end;
                $event->lector_id = $lectorId;
                $event->type = $type_id;
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
                
                $start2 = date('Y-m-d', strtotime($start2. ' + 1 week'));
                $end = date('Y-m-d H:i', strtotime($start2. ' + '.$dlugosc.' minutes'));
            }
        }else{
            $events = CalendarEvent::where('lesson_id',$lessonId)->get();
            foreach($events as $event){

                $calendar = new EventUsers;
                $calendar->calendar_id = $event->id;
                $calendar->user_id = Auth::user()->id;
                $calendar->comment = '';
                $calendar->status = 1;
                $calendar->lector_accept = 0;
                $calendar->student_accept = 1;
                $calendar->save();
            }
            // $eventId =  $request->calendarId;
        }
       

        // $calendar = new EventUsers;
        // $calendar->calendar_id = $eventId;
        // $calendar->user_id = Auth::user()->id;
        // $calendar->comment = '';
        // $calendar->status = 1;
        // $calendar->lector_accept = 0;
        // $calendar->student_accept = 1;
        // $calendar->save();
        

        $link = 'https://sandbox.przelewy24.pl/';
        $merchant_id = 207228;
        $crc_code = '53567c4b2d150c3d';
        $apiKey = 'fba1a0238b6ea8982053bbef3915c12b';

        $payment = new Payment;
        $payment->price = $kwota;
        $payment->description =  $desc;
        $payment->id_language = $language_id;
        $payment->id_user = Auth::user()->id;
        $session_id = Session::getId().date('YmdHis');
        Session::put('payment_session', $session_id);
        $payment->session_id = $session_id;
        $payment->quantity = 1;
        $payment->status = 1;

        $payment->name = $request->name;
        $payment->street = $request->street;
        $payment->postcode = $request->postcode;
        $payment->city = $request->city;
        $payment->nip = isset($request->nip) ? $request->nip : '';
        $payment->save();
        

        $suma_zamowienia = $kwota*100 ; //wartość musi być podana w groszach
        $tytul = $desc ;
        
        $token = $this->getToken($suma_zamowienia,$tytul,$session_id);
        return new RedirectResponse($link.'trnRequest/'.$token);

    }
    public function  transaction(Request $request)
    {
       
        $link = 'https://sandbox.przelewy24.pl/';
        $merchant_id = 207228;
        $crc_code = '53567c4b2d150c3d';
        $apiKey = 'fba1a0238b6ea8982053bbef3915c12b';

        $payment = new Payment;
        $payment->price = $request->price;
        $payment->description = $request->desc;
        $payment->id_language = $request->langDesc;
        $payment->id_user = Auth::user()->id;
        $session_id = Session::getId().date('YmdHis');
        Session::put('payment_session', $session_id);
        $payment->session_id = $session_id;
        $payment->quantity = 1;
        $payment->status = 1;
        $payment->save();
        
        $pakiet = $request->packet;
        for($i=1; $i<=$pakiet; $i++){
              $bank = new LessonsBank;
                $bank->user_id = Auth::user()->id;
                $bank->payment_id = $payment->id;
                $bank->overdue_date = Carbon::now()->addWeeks($pakiet);
                $bank->type_id = $request->typeA;
                $bank->save();
        }
      

        $suma_zamowienia = $request->price*100 ; //wartość musi być podana w groszach
        $tytul = $request->desc;
        
        $token = $this->getToken($suma_zamowienia,$tytul,$session_id);
        return new RedirectResponse($link.'trnRequest/'.$token);

    }
    
    public function  status(){
        dd('status');
    }
    
    public function getReturn(){
        
            $link = 'https://sandbox.przelewy24.pl/';
    $merchant_id = 207228;
    $crc_code = '53567c4b2d150c3d';
    $apiKey = 'fba1a0238b6ea8982053bbef3915c12b';

        $session_id = Session::get('payment_session', 'default');
        $payment = Payment::where('session_id',$session_id)->first();
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
        // curl_close($curl2);
        if($response2->data->status == 'success'){
            Mail::to(Auth::user()->email)->send(new ThankYou());
            return view('thankYou');
        }else{
            dd('Wystąpił niespodziewany błąd');
        }
    
  
    }
    public static function getToken($kwota,$zamowienie,$session_id){
        
            $link = 'https://sandbox.przelewy24.pl/';
    $merchant_id = 207228;
    $crc_code = '53567c4b2d150c3d';
    $apiKey = 'fba1a0238b6ea8982053bbef3915c12b';

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
                "urlStatus": "https://languelove.pl/payment/status",
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
