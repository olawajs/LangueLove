@extends('layouts.app')
@section('content')
<style>
    .content{
        margin-top: 15px;
    }
    input[type='checkbox'] {
        accent-color:var(--bs-secondary);
    }
    .checkRow{
        padding: 5px;
        margin: auto;
    }
</style>
<div class="container">
    <div class="row justify-content-center classicDIV">
    <div class="col-md-8 animation">
            <div class="AnimationContent">
                <div class="m-3">
                    <h1>Ucz się języków i <span class="underline-blue">odkrywaj świat</span></h1>
                </div>
                <div class="m-3 mb-4">
                    <h3>Gdzie chcesz i kiedy chcesz! Zacznij już dzisiaj!</h3>
                </div>
                <div class="col-md-8 m-3"> 
                    <form method="POST" action="{{ route('search') }}">
                        @csrf
                        <div class="col-md-4 input-group mb-3 InputSearch">
                            <button class="btn col-md-4" type="button" id="language" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="iconsButton">
                                    <span class="material-symbols-outlined">language</span>
                                    <div class="ButtonTexts">
                                        <span>Język</span><br>
                                        <span id="langText">Dowolny</span> 
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="language">
                                <div class="row checkRow">
                                    <div class="col-sm-5 col-md-6">
                                        <input type="checkbox" class="inputs langInp" id="lang0" name="lang[]" value="0" checked> Dowolny
                                    </div>
                                    @foreach ($languages as $language)
                                        <div class="col-sm-5 col-md-6">
                                            <input type="checkbox" class="inputs langInp" name="lang[]" value="{{$language->id}}"> {{$language->name}}
                                        </div>
                                    @endforeach
                                </div>                        
                            </ul>
                            <button class="btn col-md-4" type="button" id="course" data-bs-toggle="dropdown"  aria-expanded="false">
                                <div class="iconsButton">
                                    <span class="material-symbols-outlined">school</span>
                                    <div class="ButtonTexts">
                                        <span>Rodzaj kursu</span><br>
                                        <span id="typeText">Dowolny</span> 
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="course" style="width: 300px;">
                                <div class="row checkRow">
                                    <div class="col-sm-5 col-md-6">
                                        <input type="checkbox" class="inputs typeInp" id="type0" name="type[]" value="0" checked> Dowolny
                                    </div>
                                    @foreach ($types as $type)
                                        <div class="col-sm-5 col-md-6">
                                            <input type="checkbox" class="inputs typeInp" name="type[]" value="{{$type->id}}"> {{$type->name}}
                                        </div>
                                    @endforeach
                                </div>      
                            </ul>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit" style="width: 100%">Szukaj zajęć</button>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div> 
        
            <!-- <div class="card">
                <div class="card-body">
                    
                </div>
            </div> -->
        
    </div>
    <div class="content">
        @foreach ($lessons as $lesson)
            <div class="row justify-content-center searchedDIV">
                <div class="searchFoto"><img src="/images/lessons/{{$lesson->photo}}" onerror="this.onerror=null;this.src='/images/lectors/{{ App\Models\Lector::find($lesson->lector_id)->photo}}';" style='width:190px; height: 190px; object-fit: cover;'></div>
                <div class="searchFText">
                    <div>
                        <div class="STitle" style="gap: 15px;"><b>{{$lesson->title}}</b> <span class="LangSpan">Język {{ App\Models\Language::find($lesson->language_id)->name}} <i class="flag flag-{{ App\Models\Language::find($lesson->language_id)->short}}"></i></span></div>
                        <div class="SType">{{ App\Models\LessonDuration::find($lesson->duration_id)->duration }} min / {{ App\Models\LessonType::find($lesson->type_id)->name }}</div>
                    </div>
                    <div>
                        <div><b>Lektor: </b>{{ App\Models\Lector::find($lesson->lector_id)->name}}<br></div>
                        <div><b>Maksymalna liczba osób: </b>{{$lesson->amount_of_students}}</div>
                        <div><b>Dostępnych miejsc: </b>{{$lesson->amount_of_students-App\Models\EventUsers::whereIn('calendar_id',App\Models\CalendarEvent::where('lesson_id',$lesson->id)->pluck('id')->toArray())->distinct('user_id')->pluck('user_id')->count()}}</div>
                    </div>
                    <div>
                        <div class="SPrice"><b>{{$lesson->price*$lesson->amount_of_lessons}} zł</b> /  {{$lesson->amount_of_lessons}} lekcji</div>
                    </div>
                   
                    <!-- <div><b>Opis</b>{{$lesson->description}}</div> -->
                   
                </div>
                <div class="searchButtons">
                    <div>
                        <b>Czas trwania: </b> od: {{ \Carbon\Carbon::parse(App\Models\CalendarEvent::where('lesson_id',$lesson->id)->orderBy('start', 'asc')->first()->start)->format('d.m')}}
                        do: {{ \Carbon\Carbon::parse(App\Models\CalendarEvent::where('lesson_id',$lesson->id)->orderBy('start', 'desc')->first()->start)->format('d.m')}}
                    </div>
                    <div>
                        @foreach (App\Models\CalendarEvent::where('lesson_id',$lesson->id)->orderBy('start', 'desc')->take(1)->get() as $date)
                            <div class="SdateDiv">{{ \Carbon\Carbon::parse($date->start)->locale('pl')->dayName}} {{ \Carbon\Carbon::parse($date->start)->format('H:i')}}</div>
                        @endforeach
                    </div>
                    <a class="btn btn-secondary SButton" href="{{ route('showLesson',$lesson->id) }}">Zobacz kurs</a>
                </div>
            </div>
        @endforeach
        @foreach ($lectors as $l)
            <div class="row justify-content-center searchedDIV">
                <div class="searchFoto"><img src="/images/lectors/{{$l->photo}}" style='width:190px; height: 190px; object-fit: cover;'></div>
                <div class="searchFText">
                    <div>
                        <div class="STitle" style="gap: 15px;"><b>{{$l->name}}</b> </div>
                        <div class="SType">
                            @foreach (App\Models\LanguageLevel::where('lector_id',$l->id)->distinct('level')->pluck('level') as $d)
                                <span class="SPrice">
                                @foreach (App\Models\LanguageLevel::where('lector_id',$l->id)->where('level',$d)->get() as $f)
                                    <i class="flag flag-{{ App\Models\Language::find($f->language_id)->short}}"></i>
                                @endforeach
                                  {{ $d}}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="DescFilter">
                        <div>{!! $l->description !!}</div>

                    </div>
                    <div>
                     
                    </div>

                </div>
                <div class="searchButtons" style="justify-content: center;">
                    <a class="btn btn-secondary SButton" href="{{ route('showLector',$l->id) }}">Zobacz kalendarz</a>
                </div>
            </div>
        @endforeach
    </div>
    
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 

<script>
    let  ScreenType = 'D';
    $(document).ready(function () {
        $('.langInp').click(function() {
            check(event,1,ScreenType);
        });
        $('.typeInp').click(function() {
            check(event,2,ScreenType);
        });

    })
    
        go();
    window.addEventListener('resize', go());
    function go(){
        if(document.documentElement.clientWidth > 800){
            ScreenType = 'D';
        }
        else{
            ScreenType = 'M';
        }
    }
 
</script>