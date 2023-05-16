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

    <div class="content">
    
            <div class="row justify-content-center lessonDIV">
                <h2>{{$lesson->title}}</h2>
                <span class="SType">  {{ App\Models\LessonDuration::find($lesson->duration_id)->duration }} min / {{ App\Models\LessonType::find($lesson->type_id)->name }} / Język {{ App\Models\Language::find($lesson->language_id)->name}} <i class="flag flag-{{ App\Models\Language::find($lesson->language_id)->short}}"></i>  </span>
                <div class="lectorDesc">
                    <div class="searchFoto"><img src="/images/lectors/{{$lector->photo}}" style='width:190px; height: 190px; object-fit: cover;'></div>
                    <div>
                        <div><b>{{$lector->name}} {{$lector->surname}}</b></div>
                        <div>{{$lector->description}}</div>
                       
                    </div> 
                    <div>
                        <h5><b>Terminy zajęć: </b></h5>
                        @foreach ($calendarLessons as $date)
                            <div class="SdateDiv">{{ \Carbon\Carbon::parse($date->start)->locale('pl')->dayName}} {{ \Carbon\Carbon::parse($date->start)->format('d.m')}} godz. {{ \Carbon\Carbon::parse($date->start)->format('H:i')}}</div>
                        @endforeach
                    </div>
                </div>
                
                <div class="LessonText">

                    <div>
                        <div><b>Dostępnych miejsc: </b>{{$lesson->amount_of_students}}</div>
                    </div>
                    <div>
                        <b>Cena: </b><span class="SPrice"><b>{{$lesson->price*$lesson->amount_of_lessons}} zł</b> /  {{$lesson->amount_of_lessons}} lekcji</span>
                    </div>
                    

                    @if($lesson->description != '')
                    <hr>
                    <div>
                        <h6><b>Opis:</b></h6>
                        <span>{{$lesson->description}}</span>
                    </div>
                    @endif
                    @if($lesson->draft != '')
                    <hr>
                    <div>
                        <h6><b>Plan zajęć:</b></h6>
                        <span>{{$lesson->draft}}</span>
                    </div>
                    @endif
                   
                    <!-- <div><b>Opis</b>{{$lesson->description}}</div> -->
                   
                </div>
                    <a class="btn btn-secondary SButton" href="{{ route('showLesson',$lesson->id) }}">Zarezerwuj i zapłać</a>
            </div>
    
    </div>
    
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 

<script>
    $(document).ready(function () {
        
        $('.langInp').click(function() {
            check(event,1);
        });
        $('.typeInp').click(function() {
            check(event,2);
        });

        function check(e,type) {
            let id ='';
            let class1 = '';
            let text = '';
            if(type == 1){
                id='lang0';
                class1 = 'langInp';
                text = 'langText';
            }
            if(type == 2){
                id='type0';
                class1 = 'typeInp';
                text = 'typeText';
            }
            let textSpan = document.getElementById(text);
            if(e.target.value == '0'){
                var anchors = document.getElementsByClassName(class1);
                for(var i = 0; i < anchors.length; i++) {
                    var anchor = anchors[i];
                    anchor.checked = false;
                }
                e.target.checked = true;
                textSpan.innerText = 'Dowolny';
            }
            else{
                document.getElementById(id).checked = false;
                if(textSpan.innerText == 'Dowolny'){
                    textSpan.innerText =  e.target.parentElement.innerText;
                }else{
                    if(!textSpan.innerText.includes("i więcej")){
                        textSpan.innerText += ' i więcej';
                    }
                    
                }
                   
            }

        }
    })
   
</script>