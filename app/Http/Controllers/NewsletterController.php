<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Code;
use App\Mail\Newsletter;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Newsletter as NW;
use Auth;
use Carbon\Carbon;
use GuzzleHttp\Client;

class NewsletterController extends Controller
{
    public function generateCode()
    {
        $k = false;
       while($k == false){
            $code = '';
            $znaki = 'QWERTYUIOPASDFGHJKLZXCVBNM';
            while(strlen($code)<15){
                $i = rand(0,strlen($znaki)-1);
                $code .= $znaki[$i];
            }
            if($doesExist = Code::where('code',$code)->first()){
            }
            else{
                $k=true;
            }
       }
        return $code;
    }
    public function sendMail(string $code,string $email){
        
         $mailData=[
            'code' =>  $code
           ]; 
           Mail::to($email)->send(new Newsletter($mailData));

    }
    public function checkCode(Request $request){
        $code = Code::where('code',$request->code)->where('lesson_type',$request->type)->whereNull('use_date')->first();
        if($code){
            return $code;
        }
        else{
            return 0;
        }
       
    }
    public function useCode(Request $request){
        Code::where('code',$request->code)
        ->WhereNull('use_date')
        ->update(['use_date' => Carbon::now() ]);
       
    }
    public function checkPacketCode(Request $request){
        $code = Code::where('code',$request->code)
                    ->whereNull('use_date')
                    ->where('lesson_type',$request->type)
                    ->where('packet_amount',$request->amount)
                    ->first();
        if($code){
            return $code;
        }
        else{
              return 0;
        }

       
    }
    public function signOff(Request $request){
        $email = $request->email;
        $res = NW::where('email',$email)->delete();
        $apiKey = 'uxoyxqmxffsx492qr4gshcp997wcqf4j';
        $url = "https://api.getresponse.com/v3/contacts?query[email]={$email}";
        
        $client = new Client([
            'headers' => [
                'X-Auth-Token' => "api-key {$apiKey}",
                'Content-Type' => 'application/json'
            ]
        ]);
        
        try {
            $response = $client->request('GET', $url);
            if ($response->getStatusCode() === 200) {
                $contactData = json_decode($response->getBody(), true);
              
                foreach($contactData as $c){
                        $t = $c['contactId'];
                      $url2 = "https://api.getresponse.com/v3/contacts/{$t}";
                      $response = $client->request('DELETE', $url2);
                }
            } else {
                return response()->json(['error' => 'Error occurred while fetching contact'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return 1;
    }
    public function signIn(Request $request){
        $code = $this->generateCode();
        $c = 0;
        $email = $request->email;
        if($doesExist = NW::where('email',$email)->first()) {
        }
        else{
            if($doesExist = Code::where('email',$email)->where('lesson_type',2)->first()) {
                Mail::to($email)->send(new NewsletterMail());
            }else{
                $code2 = Code::create([
                    'code' => $code,
                    'email' => $email,
                    'lesson_type' => 2,
                    'amount' => 10,
                    'type' => '%'
                ]);
                $newsletter = NW::create([
                    'email' => $email,
                    'code_id' => $code2->id,
                ]);
                $c = $code2->id;
                $mail = $this->sendMail($code,$email); 
            }
            $newsletter = NW::create([
                'email' => $email,
                'code_id' => $c,
            ]);
            $campaignId = '5mEk1';
            $apiKey = 'uxoyxqmxffsx492qr4gshcp997wcqf4j';
            $url = "https://api.getresponse.com/v3/contacts";
            
            $client = new Client([
                'headers' => [
                    'X-Auth-Token' => "api-key {$apiKey}",
                    'Content-Type' => 'application/json'
                ]
            ]);
            $response = $client->request('POST', $url, [
                'json' => [
                    'email' => $email,
                    'campaign' => [
                        'campaignId' => $campaignId
                    ]
                ]
            ]);
        }
       return 1;
    }
}
