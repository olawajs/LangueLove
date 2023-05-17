<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp;
use Illuminate\Support\Facades\Http;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;
use Auth;

class PaymentController extends Controller
{

    public function  transaction(){
    
        $suma_zamowienia = 10*100 ; //wartość musi być podana w groszach
        $tytul = "płatność za zajęcia";
        $token = $this->getToken($suma_zamowienia,$tytul);
        return new RedirectResponse('https://sandbox.przelewy24.pl/trnRequest/'.$token);

    }
    
    public function  status(){
        dd('status');
    }
    
    public function getReturn(){
        //naprawianie
        dd('return');
        $response = json_decode( $this->getOrderId());
        // dd($response);
        $kwota = $response->data->amount;
        $orderId = $response->data->orderId;
        $nr_zamowienia = intval($response->data->description);
        $is_correct = json_decode( $this->VerifyPament($kwota,$orderId));
        if (isset($is_correct->data)) {
        //         $order = kuchniaOrder::where('id', $nr_zamowienia)->first(); 
        //         $order->id_status  = 3;
        //         $order->save();
        //     $message = '';
        dd('udana');
        }
        else{
            $message = 'Płatność nieudana, skontaktuj się administratorem';
            dd('nie udana');
        }
        dd('done');
        // return view('kuchnia.thanks', [
        //     'active' => Route::currentRouteName(),
        //     'title' => 'Dziękujemy!',
        //     'order_id' => $response->data->description,
        //     'message' => $message
        // ]);
    }
    public static function getToken($kwota,$zamowienie){
        $merchant_id = 207228;
        $crc_code = '53567c4b2d150c3d';
        $session_id = Session::getId();
        $sign = '{"sessionId":"'.$session_id.'","merchantId":'.$merchant_id.',"amount":'.$kwota.',"currency":"PLN","crc":"'.$crc_code.'"}';
        $sign = hash('sha384', $sign);
        $email = Auth::user()->email;
        $curl = curl_init();
        $name = 'Testowy klient';
        $basicAuth = base64_encode($merchant_id.':'.'fba1a0238b6ea8982053bbef3915c12b');
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sandbox.przelewy24.pl/api/v1/transaction/register',
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
        curl_close($curl);
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
