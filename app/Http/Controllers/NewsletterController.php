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
        return 1;
    }
    public function signIn(Request $request){
        $code = $this->generateCode();
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
                $mail = $this->sendMail($code,$email); 
            }
           
        }
       return 1;
    }
}
