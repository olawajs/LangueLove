<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\Mail;
use App\Mail\FreeConsultation;
use App\Mail\CompanyConsultation;
use App\Models\PriceType;
use App\Models\LessonDuration;
use App\Models\LessonType;
use App\Models\LessonsBank;
use App\Models\LectorPrices;
use App\Models\Price;
use App\Models\DiscountPacket;
use App\Models\CalendarEvent;
use App\Models\CalendarSetup;
use App\Models\Lesson;
use App\Models\Lector;
use App\Models\LanguageLevel;
use App\Models\User;
use App\Models\Packet;
use App\Models\Newsletter;
use DB;
use Session;
use Auth;
use Carbon\Carbon;

class MainController extends Controller
{
    public function showForm()
    {
        $language = Language::all();
        return view('consultation',[
            'languages' => $language
        ]);
    }
    public function showForm2()
    {
        $language = Language::all();
        return view('forCompanies',[
            'languages' => $language
        ]);
    }
    
    public function activate(Request $request){
        User::where('email', $request->mail)->update(['confirmed'=>1]);
            return view('ThankYouForRegistration');
    }
    public function deleteAccount(){
        User::where('id', Auth::user()->id)->update(['active'=>0]);
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function myAccount(){
        $lessonsIndEu = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->whereNull('use_date')->where('type_id',1)->where('priceType',1)->count();
        $lessonsParEu = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->whereNull('use_date')->where('type_id',4)->where('priceType',1)->count();
        $lessonsIndAz = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->whereNull('use_date')->where('type_id',1)->where('priceType',2)->count();
        $lessonsParAz = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->whereNull('use_date')->where('type_id',4)->where('priceType',2)->count();
        $newsletter = Newsletter::where('email',Auth::user()->email)->count();
        // echo $lessonsIndEu.','.$lessonsParEu.','.$lessonsIndAz.','.$lessonsParAz;
        // dd();
        return view('myAccount',[
            'IndEur'=>$lessonsIndEu,
            'IndAzj'=>$lessonsIndAz,
            'ParEur'=>$lessonsParEu,
            'ParAzj'=>$lessonsParAz,
            'newsletter'=>$newsletter
        ]);
    }

    public function myProfile(){
        $user = User::where('id', Auth::user()->id)->first();
        // dd($user);
        $newsletter = Newsletter::where('email',Auth::user()->email)->count();
        return view('myProfile',[
            'user'=>$user,
            'newsletter'=>$newsletter
        ]);
    }
    public function savePhoto(Request $request){
        if($request->file('file')->getSize()>5000000){
            return $request->file('file')->getSize();
        }
        else if($request->file('file')->extension() != 'jpg' && $request->file('file')->extension() != 'png' ){
            return -1;
        }
        else{
             $imageName = Auth::user()->name.'_'.Auth::user()->id.'.'.$request->file('file')->extension(); 
            $user = User::where('id', Auth::user()->id)->first();
            $image = $request->file('file')->move('images/users/', $imageName);
            $user->img = $image;
            $user->save();
            return $imageName;
        }
       
    }
    public function changeName(Request $request){

            $user = User::where('id', Auth::user()->id)->first();
            $user->name = $request->name;
            if($user->save()){
                return 1;
            }else{
                return 0;
            }
            
       
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
    public function sendCompanyMail(Request $request)
    {
        try {
           $mailData=[
            'name' => $request->name,
            'email' => $request->email,
            'language_id' => $request->language_id,
            'kurs' => $request->kurs,
            'miasto' => $request->miasto,
            'message' => $request->message
           ]; 
           Mail::to('kontakt@languelove.pl')->send(new CompanyConsultation($mailData));
           return redirect()->back()->with('success','Wiadomość przesłana poprawnie');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','UPS...Coś poszło nie tak');
        }
    }
    public function myCalendar(){
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $lessons = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->whereNull('use_date')->count();
        $tabSetupF = [];
        $tabSetupZ = [];
        if(Auth::user()->user_type == 3){
            $lector = Lector::where('id_user',Auth::user()->id)->first();
            $CS = CalendarSetup::where('lector_id',$lector->id)->where('start','>=',Carbon::today())->get();
            
            foreach($CS as $setup){
                if($setup->type == 1){
                    $color = 'green';
                    $title = 'Wolny termin';
                }
                if($setup->type == 0){
                    $color = '#c75470';
                    $title = 'Lektor niedostępny';
                }
                if($setup->type == 1){
                    $tabSetupF[] = [
                        'id' => $setup->id,
                        'title' => $title,
                        'start' => $setup->start,
                        'end'  =>$setup->end,
                        'editable'=> false,
                        'display'=>'background',
                        'type' => $setup->type,
                        'color' => $color
                    ];
                }
                else{
                    $tabSetupZ[] = [
                        'id' => $setup->id,
                        'title' => $title,
                        'start' => $setup->start,
                        'end'  =>$setup->end,
                        'editable'=> false,
                        'display'=>'background',
                        'type' => $setup->type,
                        'color' => $color
                    ];
                }
             
            }
        }

        return view('myCalendar',[
            'to_use'=>$lessons,
            'free'=>$tabSetupF,
            'used'=>$tabSetupZ,

        ]);
    }
    public function home()
    {
     
        if(Auth::user()  && Auth::user()->active == 0){
            Auth::logout();
            Session::flush();
            return redirect('/login');
        }
        else{
             $langs = Language::where('active',1)->get();
            $types = LessonType::where('active',1)->get();
            $lectors = Lector::where('id','!=',18)->where('active',1)->get();
            return view('home',[
                'languages' => $langs,
                'types' => $types,
                'lectors' => $lectors,
            ]);
        }
       
    }
    public function Testhome()
    {
     
        if(Auth::user()  && Auth::user()->active == 0){
            Auth::logout();
            Session::flush();
            return redirect('/login');
        }
        else{
             $langs = Language::where('active',1)->get();
            $types = LessonType::where('active',1)->get();
            $lectors = Lector::where('id','!=',18)->where('active',1)->get();
            $grupy = Lesson::where('active',1)->whereIn('type_id', [2, 3])->orderBy('start','DESC')->take(4)->get();
            return view('test/home',[
                'languages' => $langs,
                'types' => $types,
                'lectors' => $lectors,
                'grupy' => $grupy,
            ]);
        }
       
    }
    public function count(Request $request)
    {
        $language_id = $request->language;
        $duration_id = $request->duration;
        $cert = $request->cert;
        $ile = 1;
        $rodzaj_id = $request->rodzaj;
        
        if(isset($request->ile)){
            $ile = $request->ile;
        }

        $type = Language::where('id',$language_id)->first()->price_type;
        $price = Price::where('type_id',$rodzaj_id)
                        ->where('price_type_id',$type)
                        ->where('duration_id',$duration_id)
                        ->where('certification',$cert)
                        ->first()
                        ->price;
        
        return $price*$ile;
    }
    public function Packetprice(Request $request){
        $lector_type_id = $request->lector_type_id;
        $duration_id = $request->duration;
        $cert = $request->cert;
        $rodzaj_id = $request->rodzaj;
        $amount = $request->amount;

        $price = Packet::where('type_id',$rodzaj_id)
                        ->where('amount',$amount)
                        ->where('duration_id',$duration_id)
                        ->where('lector_type_id',$lector_type_id)
                        ->where('certyficate',$cert)
                        ->first()
                        ->price;
                        

        return $price;
    }
    public function checkBank(Request $request){
        $type = $request->type;
        $priceType = $request->priceType;
        $id = $request->user;
        $cert = $request->cert;
        $data = $request->data;
        // $lessons = LessonsBank::where('user_id',$id)
        //                         ->where('overdue_date','>=',Carbon::today())
        //                         ->whereNull('use_date')
        //                         ->where('type_id',$type)
        //                         ->where('priceType',$priceType)
        //                         ->where('certificat',$cert)
        //                         ->count();
        $lessons = LessonsBank::where('user_id',$id)
                                ->where('overdue_date','>=',$data)
                                ->whereNull('use_date')
                                ->where('type_id',$type)
                                ->where('priceType',$priceType)
                                ->where('certificat',$cert)
                                ->count();
        return $lessons;
    }
    public function Paymentprice(Request $request)
    {
        $lector_type_id = $request->lector_type_id;
        $duration_id = $request->duration;
        $cert = $request->cert;
        $rodzaj_id = $request->rodzaj;
        
        $price = LectorPrices::where('lector_type_id', $lector_type_id)
                                ->where('type_id',$rodzaj_id)
                                ->where('duration_id',$duration_id)
                                ->where('certification',$cert)
                                ->first()
                                ->price;
        return $price;
    }
    public function validTermins(Request $request)
    {
        $lector = $request->lector;
        $date = $request->date;
        $hour = $request->hour;
        $ile = $request->ile;
        $dlugosc = LessonDuration::where('id',$request->dlugosc)->first()->duration;
        $start =  date('Y-m-d H:i', strtotime($date.' '.$hour));
        $end = date('Y-m-d H:i', strtotime($start. ' + '.$dlugosc.' minutes'));
        $end2 = date('Y-m-d H:i', strtotime($start. ' + '.($dlugosc-1).' minutes'));
      

        $isInFree = CalendarSetup::where('start', '<=',$start)
                                    ->where('end', '>=',$end)
                                    ->where('type',1)
                                    ->where('lector_id',$lector)
                                    ->get();

        $isEndInTaken = CalendarSetup::where('start', '<=',$end)
        ->where('end', '>=',$end)
        ->whereIn('type',[0,4])
        ->where('lector_id',$lector)
        ->get();

        $isEndInLessons= CalendarEvent::where('start', '<=',$end2)
        ->where('end', '>=',$end2)
        ->where('type',3)
        ->where('lector_id',$lector)
        ->get();
        if(count($isInFree)== 0 || (count($isEndInTaken)>0 || count($isEndInLessons)>0)){
            return 0 ; 
            //  return 'free: '.count($isInFree).' /endintaken: '.count($isEndInTaken).' /endinlessons: '.count($isEndInLessons);
        }else{
            return 'free: '.count($isInFree).' /endintaken: '.count($isEndInTaken).' /endinlessons: '.count($isEndInLessons);
        }
        
    }
    public function search(Request $request)
    {
        if(!is_null($request->lang)  && !is_null($request->type) && $request->type[0] != '0' && $request->lang[0] != '0'){
            $lessons = Lesson::whereIn('language_id', $request->lang)
                                ->whereIn('type_id', $request->type)
                                ->where('start', '>', Carbon::today())
                                ->where('status','<>',0)
                                ->where('active',1)
                                ->get();
            
            $languageT = LanguageLevel::whereIn('language_id',$request->lang)->pluck('lector_id')->toArray();
            $lectors = Lector::whereIn('id',$languageT)->where('active',1)->where('id','!=',18)->get();
        }else if(!is_null($request->lang)  && (is_null($request->type)||$request->type[0] == '0') && $request->lang[0] != '0'){
            $lessons = Lesson::whereIn('language_id', $request->lang)
                            ->where('start', '>', Carbon::today())   
                            ->where('status','<>',0)    
                            ->where('active',1)               
                            ->get();
            $languageT = LanguageLevel::whereIn('language_id',$request->lang)->pluck('lector_id')->toArray();
            $lectors = Lector::whereIn('id',$languageT)->where('active',1)->where('id','!=',18)->get();
        }
        else if((is_null($request->lang)|| $request->lang[0] == '0')  && !is_null($request->type) && $request->type[0] != '0'){
            $lessons = Lesson::whereIn('type_id', $request->type)
                            ->where('start', '>', Carbon::today())
                            ->where('status','<>',0)
                            ->where('active',1)
                            ->get();
             $lectors = Lector::where('id','!=',18)->where('active',1)->get();
        }
        else{
            $lessons = Lesson::where('start', '>', Carbon::today())->where('status','<>',0)->where('active',1)->get();
            $lectors = Lector::where('id','!=',18)->where('active',1)->get();
        }
        $langs = Language::where('active',1)->get();
        $types = LessonType::where('active',1)->get();
        $durations = LessonDuration::get();
        return view('test/filteredLessons',[
            'lessons' => $lessons,
            'lectors' => $lectors,
            'languages' => $langs,
            'types' => $types,
            'durations' => $durations,
        ]);
    }
    public function search2(Request $request)
    {
            $lessons = Lesson::where('type_id', intval($request->type))
                            ->where('start', '>', Carbon::today())
                            ->where('status','<>',0)
                            ->where('active',1)
                            ->get();
       
        $langs = Language::where('active',1)->get();
        $types = LessonType::where('active',1)->get();
        $durations = LessonDuration::get();
        $lectors = Lector::where('id',0);

        return view('test/filteredLessons',[
            'lessons' => $lessons,
            'lectors' => $lectors,
            'languages' => $langs,
            'types' => $types,
            'durations' => $durations,
        ]);
    }

    public function searchPricelist(Request $request)
    {
        $language = $request->lang;
        $type = $request->type;
        $lessons = Lesson::where('language_id',  $language)
                            ->where('type_id', $type)
                            ->where('type_id','!=', 1)
                            ->where('type_id','!=', 4)
                            ->where('start', '>', Carbon::today())
                            ->where('active',1)
                            ->get();
        $languageT = LanguageLevel::where('language_id',$request->lang)->pluck('lector_id')->toArray();
        $lectors = Lector::whereIn('id',$languageT)->where('id','!=',18)->where('active',1)->get();
        $langs = Language::where('active',1)->get();
        $types = LessonType::where('active',1)->get();
        $durations = LessonDuration::get();

        // dd($lessons);
        return view('test/filteredLessons',[
            'lessons' => $lessons,
            'lectors' => $lectors,
            'languages' => $langs,
            'types' => $types,
            'durations' => $durations,
        ]);
    }

}
