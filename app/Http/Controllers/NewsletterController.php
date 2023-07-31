<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Code;
use App\Mail\Newsletter;
use Illuminate\Support\Facades\Mail;

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
}
