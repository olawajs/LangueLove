<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Code;
use App\Models\Newsletter;
use App\Models\Payment;
use App\Models\User;
use App\Models\Language;
use App\Models\PriceType;
use App\Models\LessonDuration;
use App\Models\LessonType;
use App\Models\LanguageLevel;
use App\Models\Price;
use App\Models\DiscountPacket;
use App\Models\CalendarEvent;
use App\Models\CalendarSetup;
use App\Models\LessonsBank;
use App\Models\EventUsers;
use App\Models\Lector;
use Auth;
use Carbon\Carbon;

class AdministratorController extends Controller
{
    public function Database(Request $request){
        $codes = Code::all();
        $newsletters = Newsletter::all();
        $users = User::all();
        $payments = Payment::orderBy('created_at')->get();
        return view('admin/dataBase',[
            'codes'=> $codes,
            'newsletters'=> $newsletters,
            'payments'=> $payments,
            'users'=> $users,
        ]);
    }
    public function showLector(Request $request){
        $lector = Lector::where('id',$request->id)->first();
        // $calendarLessons = CalendarEvent::where('lector_id',$request->id)->orderBy('start')->get();
        $duratons = LessonDuration::all();
        $languageTypes = LanguageLevel::where('lector_id',$request->id)->get();
        $languageT = LanguageLevel::where('lector_id',$request->id)->pluck('language_id')->toArray();
        $languages = Language::whereIn('id',$languageT)->get();
        // $calendarEvents = CalendarSetup::where('lector_id',$request->id)->get(); // czy potrzebne teraz? tylko widok lektora? i indywidualne zajęcia?
      
        if(Auth::check()){
            $lessonsIndEu = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',0)->where('priceType',1)->count();
            $lessonsIndEuC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',1)->where('priceType',1)->count();

            $lessonsParEu = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',0)->where('priceType',1)->count();
            $lessonsParEuC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',1)->where('priceType',1)->count();

            $lessonsIndAz = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',0)->where('priceType',2)->count();
            $lessonsIndAzC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',1)->where('priceType',2)->count();

            $lessonsParAz = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',0)->where('priceType',2)->count();
            $lessonsParAzC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',1)->where('priceType',2)->count();

            // typ;typJezyka;certyfikat
            // 1 - ind; 4-para
            $wykupioneLekcje['1']['1']['0']= $lessonsIndEu;
            $wykupioneLekcje['1']['1']['1']= $lessonsIndEuC;
            $wykupioneLekcje['1']['2']['0']= $lessonsIndAz;
            $wykupioneLekcje['1']['2']['1']= $lessonsIndAzC;
            $wykupioneLekcje['4']['1']['0']= $lessonsParEu;
            $wykupioneLekcje['4']['1']['1']= $lessonsParEuC;
            $wykupioneLekcje['4']['2']['0']= $lessonsParAz;
            $wykupioneLekcje['4']['2']['1']= $lessonsParAzC;
        }else{
            $wykupioneLekcje['1']['1']['0']= 0;
            $wykupioneLekcje['1']['1']['1']= 0;
            $wykupioneLekcje['1']['2']['0']= 0;
            $wykupioneLekcje['1']['2']['1']= 0;
            $wykupioneLekcje['4']['1']['0']= 0;
            $wykupioneLekcje['4']['1']['1']= 0;
            $wykupioneLekcje['4']['2']['0']= 0;
            $wykupioneLekcje['4']['2']['1']= 0;
        }
             return view('test/lector',[
                'durations' => $duratons,
                'levels' => $languageTypes,
                'lector' => $lector,
                'languages' => $languages,
                'lessonAmount' => $wykupioneLekcje
            ]);
    }
}
