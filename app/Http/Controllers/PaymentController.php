<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp;
use Illuminate\Support\Facades\Http;
use App\Models\Payment;
use \Devpark\Transfers24\Requests\Transfers24;
use Auth;

class PaymentController extends Controller
{
    private Transfers24 $transfers24;

   public function __construct(Transfers24 $transfers24){
        $this->transfers24 = $transfers24;
   }


   


    public function status(){

    }

    public function  transaction(){
        // dd( '\o/' );
        $payment = new Payment();
        // $payment -> order_id = ss; uzupełniamy model
// 100 to price
        $this->transfers24->setEmail(Auth::user()->email)->setAmount(100);
        try{
            // dd($this->transfers24);
             $response = $this->transfers24->init();
             dd($response);
            if($response->isSuccess())
            {
                
                $payment->session_id = $response->getSessionId();
                // save registration parameters in payment object
                
                return redirect($this->transfers24->execute($response->getToken()));
            }
            else{
                dd('tu error itp');
            }
        }catch(RequestException $e){
            return back()->with('warning','Ups... Coś poszło nie tak');
        }
      

    }
    
    
    public function getReturn(){
        //naprawianie
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
        $session_id = 'Testowasejsa';
        $sign = '{"sessionId":"'.$session_id.'","merchantId":'.$merchant_id.',"amount":'.$kwota.',"currency":"PLN","crc":"'.$crc_code.'"}';
        $sign = hash('sha384', $sign);
        $email = 'olawjs@gmail.com';
        $curl = curl_init();
       $name = 'Testowy klient';
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
            "urlReturn": "http://127.0.0.1:8000/getReturn",
            "urlStatus": "http://127.0.0.1:8000/getReturn",
            "timeLimit": 0,
            "channel": 7,
            "waitForResult": true,
            "transferLabel": "Platnosc z LangueLove",
            "sign": "'.$sign.'" 
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic MTcyOTQ3OjQzN2RiYjVkYjJjYjdhZjhjNmQ5YjUxNzY1OTYwMjY0',
            'Content-Type: application/json',
        ),
        ));
  
        $response = json_decode(curl_exec($curl));
        curl_close($curl);
        
        dd($response);
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
