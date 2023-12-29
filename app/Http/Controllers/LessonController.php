<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonType;
use App\Models\LessonDuration;
use App\Models\Lector;
use App\Models\Language;
use App\Models\Lesson;
use App\Models\CalendarEvent;
use App\Models\CalendarSetup;
use App\Models\LanguageLevel;
use App\Models\LessonsBank;
use Auth;
use Carbon\Carbon;

class LessonController extends Controller
{
    public function index()
    {
        $lessonTypes = LessonType::all();
        $lessonDurations = LessonDuration::all();
        $lectors = Lector::all();
        $language = Language::all();

        return view('admin/addLesson',[
            'types' => $lessonTypes,
            'duration' => $lessonDurations,
            'lectors' => $lectors,
            'language' => $language
        ]);
    }
    public function showLesson(Request $request){
        $lesson = Lesson::where('id',$request->id)->first();
        $lector = Lector::where('id',$lesson->lector_id)->first();
        $calendarLessons = CalendarEvent::where('lesson_id',$lesson->id)->orderBy('start')->get();
        $duratons = LessonDuration::all();
        $languageTypes = LanguageLevel::where('lector_id',$lesson->lector_id)->get();
        $languageT = LanguageLevel::where('lector_id',$lesson->lector_id)->pluck('language_id')->toArray();
        $languages = Language::whereIn('id',$languageT)->get();
        $calendarEvents = CalendarSetup::where('lector_id',$lesson->lector_id)->get(); // czy potrzebne teraz? tylko widok lektora? i indywidualne zajęcia?
       
        if($lesson->type_id != 2){

            if(Auth::check()){
                $lessonsIndEu = LessonsBank::where('user_id',Auth::user()->id)->whereNull('use_date')->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',0)->where('priceType',1)->count();
                $lessonsIndEuC = LessonsBank::where('user_id',Auth::user()->id)->whereNull('use_date')->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',1)->where('priceType',1)->count();

                $lessonsParEu = LessonsBank::where('user_id',Auth::user()->id)->whereNull('use_date')->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',0)->where('priceType',1)->count();
                $lessonsParEuC = LessonsBank::where('user_id',Auth::user()->id)->whereNull('use_date')->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',1)->where('priceType',1)->count();

                $lessonsIndAz = LessonsBank::where('user_id',Auth::user()->id)->whereNull('use_date')->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',0)->where('priceType',2)->count();
                $lessonsIndAzC = LessonsBank::where('user_id',Auth::user()->id)->whereNull('use_date')->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',1)->where('priceType',2)->count();

                $lessonsParAz = LessonsBank::where('user_id',Auth::user()->id)->whereNull('use_date')->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',0)->where('priceType',2)->count();
                $lessonsParAzC = LessonsBank::where('user_id',Auth::user()->id)->whereNull('use_date')->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',1)->where('priceType',2)->count();

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
            return view('lessonInd',[
                'lesson' => $lesson,
                'durations' => $duratons,
                'levels' => $languageTypes,
                'lector' => $lector,
                'languages' => $languages,
                'calendarLessons' => $calendarLessons,
                'calendarEvents' => $calendarEvents
                ]);
        }else{
             return view('lesson',[
            'lesson' => $lesson,
            'durations' => $duratons,
            'lector' => $lector,
            'calendarLessons' => $calendarLessons
            ]);
        }
        
       
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
            $lessonsIndEu = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',0)->where('priceType',1)->whereNull('use_date')->count();
            $lessonsIndEuC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',1)->where('priceType',1)->whereNull('use_date')->count();

            $lessonsParEu = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',0)->where('priceType',1)->whereNull('use_date')->count();
            $lessonsParEuC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',1)->where('priceType',1)->whereNull('use_date')->count();

            $lessonsIndAz = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',0)->where('priceType',2)->whereNull('use_date')->count();
            $lessonsIndAzC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',1)->where('certificat',1)->where('priceType',2)->whereNull('use_date')->count();

            $lessonsParAz = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',0)->where('priceType',2)->whereNull('use_date')->count();
            $lessonsParAzC = LessonsBank::where('user_id',Auth::user()->id)->where('overdue_date','>=',Carbon::today())->where('type_id',4)->where('certificat',1)->where('priceType',2)->whereNull('use_date')->count();

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
             return view('lector',[
                'durations' => $duratons,
                'levels' => $languageTypes,
                'lector' => $lector,
                'languages' => $languages,
                'lessonAmount' => $wykupioneLekcje
            ]);
    }
    public function addLesson(Request $request)
    {
        if($request->file('photo') != ''){
            $imageName = time().'.'.$request->title.'_'.$request->file('photo')->getClientOriginalName();    
        }else{
            $imageName ='';
        }

        $validated = $request->validate([
            'type_id' => 'required|integer', 
            'duration_id' => 'required|integer', 
            'amount_of_lessons' => 'required|integer', 
            'amount_of_students' => 'required|integer', 
            'price' => 'required',
            'start' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'draft' => 'nullable',
            'skype' => 'nullable',
            'lector_id' => 'required|integer',
            'language_id' => 'required|integer',
            'active' => 'required'
        ]); 
        $validated['photo'] = $imageName;
        
        $startDate = $request->start;
        $lessonAmount = $request->amount_of_lessons;
        $duration = LessonDuration::where('id',$request->duration_id)->first();
        $duration = $duration->duration + 15;
        
       
        $lesson = Lesson::create($validated);
        for($i = 1; $i<=$lessonAmount ; $i++){
            $start =  date('Y-m-d H:i', strtotime($startDate.' '.$request['time']));
            $end = date('Y-m-d H:i', strtotime($start. ' + '.$duration.' minutes'));
            $data=[
                'start'=>$start,
                'end'=>$end,
                'lector_id'=>$request->lector_id,
                'type'=>3, //wolny
                'lesson_id'=>$lesson->id
            ];
            $CS = CalendarEvent::create($data);
            $startDate = date('Y-m-d', strtotime($startDate. ' + 1 week'));
        }
        if($lesson && $imageName!='' ){
              $image = $request->file('photo')->move('images/lessons/', $imageName);
        }
        return redirect()->route('addLesson');
    }
}
