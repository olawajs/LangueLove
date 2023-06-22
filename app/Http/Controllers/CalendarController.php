<?php

namespace App\Http\Controllers;

use App\Models\CalendarSetup;
use App\Models\CalendarEvent;
use App\Models\Lesson;
use App\Models\Language;
use App\Models\EventUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function myCalendar(){
        $events = EventUsers::where('user_id',Auth::user()->id)->pluck('calendar_id')->toArray();
        $calendar = CalendarEvent::whereIn('id',$events)->get();
        foreach($calendar as $setup){
                $color = 'var(--bs-secondary)';
               
                $lesson = Lesson::where('id',$setup->lesson_id)->first()->language_id; 
                $language = Language::where('id',$lesson)->first()->name; 
                $title = 'Zajęcia z język '.$language;
            $tabSetup[] = [
                'title' => $title,
                'start' => $setup->start,
                'end'  =>$setup->end,
                'editable'=> false,
                'type' => $setup->type,
                'color' => $color
            ];
        }
        return $tabSetup;
    }
    public function AddSetup(Request $request)
    {
        $startDate = $request->date_from;
        $endDate = $request->date_to;
        while ($startDate <= $endDate){
            $dayofweek = date('w', strtotime($startDate));
            if($dayofweek != 0){
                if(isset($request['from_'. $dayofweek]) && isset($request['to_'. $dayofweek]) && $request['from_'. $dayofweek] != '00:00' && $request['to_'. $dayofweek] != '00:00'){
                    $start = $startDate.' '.$request['from_'. $dayofweek];
                    $end = $startDate.' '.$request['to_'. $dayofweek];
                    $type = $request->option;
                    $data=[
                        'start'=>$start,
                        'end'=>$end,
                        'lector_id'=>$request['id_lector'],
                        'type'=>$type, //wolny
                    ];
                    $CS = CalendarSetup::create($data);

                }
             
            }
            $startDate = date('Y-m-d', strtotime($startDate. ' + 1 days'));
        }          
        
        return redirect()->route('getLector', ['id' => $request['id_lector']]);
    }
    public function GetSetup(Request $request){
        $CS = CalendarSetup::where('lector_id',$request->id)->get();
        $tabSetup = [];
        foreach($CS as $setup){
            if($setup->type == 1){
                $color = 'green';
                $title = 'Wolny termin';
            }
            if($setup->type == 0){
                $color = '#c75470';
                $title = 'Lektor niedostępny';
            }
            $tabSetup[] = [
                'title' => $title,
                'start' => $setup->start,
                'end'  =>$setup->end,
                'editable'=> false,
                'display'=>'background',
                'type' => $setup->type,
                'color' => $color
            ];
        }
        return $tabSetup;
    }
    public function GetCalendar(Request $request){
        $CS = CalendarSetup::where('lector_id',$request->id)->get();
        $CE = CalendarEvent::where('lector_id',$request->id)->get();
        $tabSetup = [];
        foreach($CS as $setup){
            if($setup->type == 1){
                $color = 'green';
                $title = 'Wolny termin';
            }
            if($setup->type == 0){
                $color = '#c75470';
                $title = 'Lektor niedostępny';
            }
            $tabSetup[] = [
                'title' => $title,
                'start' => $setup->start,
                'end'  =>$setup->end,
                'editable'=> false,
                'display'=>'background',
                'type' => $setup->type,
                'color' => $color
            ];
        }
        foreach($CE as $event){
                $color = '#3c0079';
                $title = 'Termin zarezerwowany';
            $tabSetup[] = [
                'title' => $title,
                'start' => $event->start,
                'end'  =>$event->end,
                'editable'=> false,
                // 'display'=>'background',
                'type' => $setup->type,
                'color' => $color
            ];
        }
    
        $now= Carbon::now()->subHours(480);
        $now2= Carbon::now()->addHours(12);
        $tabSetup[] = [
            'title' => 'Termin niedostępny',
            'start' => $now,
            'end'  =>$now2,
            'editable'=> false,
            'display'=>'background',
            'color' => '#c75470'
        ];
       
        return $tabSetup;
    }
    public function acceptLessons(){
        $events =  DB::table('event_users')
        ->join('calendar_events', 'event_users.calendar_id', '=', 'calendar_events.id')
        ->join('lessons', 'lessons.id', '=', 'calendar_events.lesson_id')
        ->join('lectors', 'lectors.id', '=', 'calendar_events.lector_id')
        ->select(
            'event_users.*',
            'calendar_events.lector_id', 
            'lessons.title',
            'event_users.lector_accept',
            'event_users.student_accept',
            'lectors.name',
            'lectors.surname'
            )
        ->where('lessons.type_id','!=',2)
        ->where('lessons.type_id','!=',3)
        ->where('event_users.user_id',Auth::user()->id)
        ->orWhere('calendar_events.lector_id',Auth::user()->id)
        ->where('event_users.student_accept',0)
        ->orWhere('event_users.lector_accept',0)
        ->get();
        dd($events);
    }

}
