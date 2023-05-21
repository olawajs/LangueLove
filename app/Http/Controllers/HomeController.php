<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\Mail;
use App\Mail\FreeConsultation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
   

    public function sendConsultationMail(Request $request)
    {
        try {
           $mailData=[
            'name' => $request->name,
            'email' => $request->email,
            'language_id' => $request->language_id,
            'message' => $request->message
           ]; 
           Mail::to('kontakt@languelove.pl')->send(new FreeConsultation($mailData));
           return redirect()->back()->with('success','Wiadomość przesłana poprawnie');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','UPS...Coś poszło nie tak');
        }
    }

}
