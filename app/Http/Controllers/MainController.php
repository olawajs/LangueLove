<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\Mail;
use App\Mail\FreeConsultation;
use App\Models\PriceType;
use App\Models\LessonDuration;
use App\Models\LessonType;
use App\Models\Price;
use App\Models\DiscountPacket;
use App\Models\CalendarEvent;
use App\Models\CalendarSetup;
use App\Models\Lesson;
use App\Models\Lector;
use App\Models\LanguageLevel;
use DB;
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
    public function home()
    {
        $langs = Language::where('active',1)->get();
        $types = LessonType::where('active',1)->get();
        return view('home',[
                'languages' => $langs,
                'types' => $types,
            ]);
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
    public function validTermins(Request $request)
    {
        $lector = $request->lector;
        $date = $request->date;
        $hour = $request->hour;
        $ile = $request->ile;
        $dlugosc = LessonDuration::where('id',$request->dlugosc)->first()->duration;
        $dlugosc+=14;
        $start =  date('Y-m-d H:i', strtotime($date.' '.$hour));
        $end = date('Y-m-d H:i', strtotime($start. ' + '.$dlugosc.' minutes'));
      

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

        $isEndInLessons= CalendarEvent::where('start', '<=',$end)
        ->where('end', '>=',$end)
        ->where('type',3)
        ->where('lector_id',$lector)
        ->get();

        if(count($isInFree)== 0 || (count($isEndInTaken)>0 || count($isEndInLessons)>0)){
            return 0 ;
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
                                ->get();
            $languageT = LanguageLevel::where('language_id',$request->lang)->pluck('lector_id')->toArray();
            $lectors = Lector::whereIn('id',$languageT)->get();
        }else if(!is_null($request->lang)  && (is_null($request->type)||$request->type[0] == '0') && $request->lang[0] != '0'){
            $lessons = Lesson::whereIn('language_id', $request->lang)
                            ->where('start', '>', Carbon::today())                        
                            ->get();
            $languageT = LanguageLevel::where('language_id',$request->lang)->pluck('lector_id')->toArray();
            $lectors = Lector::whereIn('id',$languageT)->get();
        }
        else if((is_null($request->lang)|| $request->lang[0] == '0')  && !is_null($request->type) && $request->type[0] != '0'){
            $lessons = Lesson::whereIn('type_id', $request->type)
                            ->where('start', '>', Carbon::today())
                            ->get();
             $lectors = Lector::all();
        }
        else{
            $lessons = Lesson::where('start', '>', Carbon::today())->get();
            $lectors = Lector::all();
        }
        $langs = Language::where('active',1)->get();
        $types = LessonType::where('active',1)->get();
        // $a = CalendarEvent::where('lesson_id',1)->where('start', '>=', Carbon::today())->orderBy('start', 'desc')->get();
        // dd($a);
        return view('filteredLessons',[
            'lessons' => $lessons,
            'lectors' => $lectors,
            'languages' => $langs,
            'types' => $types
        ]);
    }

}
