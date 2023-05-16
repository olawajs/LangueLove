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
      
             return view('lector',[
                'durations' => $duratons,
                'levels' => $languageTypes,
                'lector' => $lector,
                'languages' => $languages
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
            'lector_id' => 'required|integer',
            'language_id' => 'required|integer'
        ]); 
        $validated['photo'] = $imageName;
        
        $startDate = $request->start;
        $lessonAmount = $request->amount_of_lessons;
        $duration = LessonDuration::where('id',$request->duration_id)->first();
        $duration = $duration->duration;
        
       
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
