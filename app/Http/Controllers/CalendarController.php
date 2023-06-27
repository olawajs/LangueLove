<?php

namespace App\Http\Controllers;

use App\Models\CalendarSetup;
use App\Models\CalendarEvent;
use App\Models\Lesson;
use App\Models\Lector;
use App\Models\Language;
use App\Models\EventUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function myCalendar(){
        $id_lektor = Lector::where('id_user',Auth::user()->id)->first();
        if($id_lektor){
            $id = $id_lektor->id;
        }else{
            $id = 0;
        }
        $now = Carbon::now()->format('Y-m-d');
        $calendar =  DB::table('event_users')
        ->join('calendar_events', 'event_users.calendar_id', '=', 'calendar_events.id')
        ->join('lessons', 'lessons.id', '=', 'calendar_events.lesson_id')
        ->join('lectors', 'lectors.id', '=', 'calendar_events.lector_id')
        ->join('languages', 'languages.id', '=', 'lessons.language_id')
        ->join('lesson_types', 'lesson_types.id', '=', 'lessons.type_id')
        ->join('users', 'users.id', '=', 'event_users.user_id')
        ->select(
            'event_users.*',
            'calendar_events.start',
            'lessons.type_id',
            'calendar_events.end',
            'calendar_events.lector_id', 
            'lessons.title',
            'lessons.language_id',
            'event_users.lector_accept',
            'event_users.student_accept',
            'lectors.name as LectorName',
            'lectors.surname',
            'lectors.photo',
            'lectors.email',
            'lectors.skype',
            'languages.name',
            'lesson_types.name as typeName',
            'users.email as Uemail'
            )
        ->where('calendar_events.start','>',$now)
        ->where(function ($query) use ($id) {
            $query->where('event_users.user_id',Auth::user()->id)
                  ->orWhere('calendar_events.lector_id',$id);
        })
        ->get();
        // dd($calendar);
        foreach($calendar as $setup){
            $editable = false;
            if(Auth::user()->id == $setup->user_id &&  $setup->lector_accept == 0 && $setup->type_id != 2 && $setup->type_id != 3){
                $color = 'gray';
                $opis = '<span style="color: red">Termin niepotwierdzony</span>';
            }
            else if(Auth::user()->id != $setup->user_id &&  $setup->lector_accept == 0 ){
                $color = 'var(--bs-primary)';
                $opis = '<span style="color: orange">Do zaakceptowania</span>';
                $editable = true;
            }
            else{
                $color = 'var(--bs-secondary)';
                $opis = '<span style="color: green">Termin potwierdzony</span>';
            }
                
               
            if(Auth::user()->id == $setup->user_id && $setup->type_id != 2 && $setup->type_id != 3){
                $title = 'Zajęcia z języka '.$setup->name.'ego';
                
            }else{
                $title = $setup->title;
            }
            if(Auth::user()->id == $setup->user_id){
                $email = $setup->email;
            }else{
               $email = $setup->Uemail;
            }
            $tabSetup[] = [
                'id'=>$setup->id,
                'title' => $title,
                'start' => $setup->start,
                'end'  =>$setup->end,
                'editable'=> $editable,
                'type' => $setup->type_id,
                'color' => $color,
                'opis' => $opis,
                'lektor' => $setup->LectorName,
                'skype' => $setup->skype,
                'typeL' => $setup->typeName,
                'typeJ' => $setup->name,
                'email' => $email,
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
        return redirect()->back();
        // return redirect()->route('getLector', ['id' => $request['id_lector']]);
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
    public function accept(Request $request){
        $CE = EventUsers::where('id',$request->id)->first();
        if($CE->user_id == Auth::user()->id){
            $CE->student_accept = 1;
        }
        else{
            $CE->lector_accept = 1;
        }
        if($CE->save()){
            return 1;
        }
        else{
            return 0;
        }
        
    }
    public function acceptLessons(){
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $id_lektor = Lector::where('id_user',Auth::user()->id)->first();
        if($id_lektor){
            $id = $id_lektor->id;
        }else{
            $id = 0;
        }
        $events =  DB::table('event_users')
        ->join('calendar_events', 'event_users.calendar_id', '=', 'calendar_events.id')
        ->join('lessons', 'lessons.id', '=', 'calendar_events.lesson_id')
        ->join('lectors', 'lectors.id', '=', 'calendar_events.lector_id')
        ->select(
            'event_users.*',
            'calendar_events.start',
            'calendar_events.end',
            'calendar_events.lector_id', 
            'lessons.title',
            'event_users.lector_accept',
            'event_users.student_accept',
            'lectors.name',
            'lectors.surname',
            'lectors.photo'
            )
        ->where('lessons.type_id','!=',2)
        ->where('lessons.type_id','!=',3)
        ->where('calendar_events.start','>',Carbon::now())
        ->whereRaw('event_users.lector_accept + event_users.student_accept < 2')
        ->where(function ($query) use ($id) {
            $query->where('event_users.user_id',Auth::user()->id)
                  ->orWhere('calendar_events.lector_id',$id);
        })
        ->get();
        return view('myLessons',['lessons' => $events]);
        
    }

}
