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
            <div>
                <h1>Ucz się języków i <span class="underline-blue">odkrywaj świat</span></h1>
            </div>
            <div>
                <h3>Gdzie chcesz i kiedy chcesz! Zacznij już dzisiaj!</h3>
            </div>
            <div class="col-md-8"> 
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
        
            <!-- <div class="card">
                <div class="card-body">
                    
                </div>
            </div> -->
        
    </div>
    <div class="content">
        <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100" style="background-color: var(--bs-primary);color: white; border: none;">
                        <div class="card-body">
                            <h2 class="card-title">Nowoczesność</h2>
                            <p class="card-text">
                                <br>
                                Na indywidualnych i grupowych kursach językowych wykorzystujemy wszystkie dostępne
                                zasoby internetu, takie jak <b>prezentacje multimedialne, filmy, artykuły, gry, pracę w grupach
                                i inne.</b> 
                                <br><br>Orientacja na nowoczesne rozwiązania to najważniejsza cecha naszej szkoły
                                języków obcych online.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100" style="background-color: var(--bs-secondary); color: white;border: none;" >
                        <div class="card-body">
                            <h2 class="card-title">Elastyczność</h2>
                            <p class="card-text">
                                <br>
                                <b>Ucz się, gdzie chcesz, kiedy chcesz i ile chcesz. </b>
                                <br><br>
                                To Ty decydujesz o liczbie, częstotliwości i formie zajęć. Nasz <b>kalendarz</b> pomoże Ci w planowaniu nauki i szybkim umawianiu się na
                                zajęcia. Dzięki niemu możesz zobaczyć <b>dostępność lektora</b> i wybrać najbardziej
                                <b>odpowiadający Ci termin</b>.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100" style="background-color: var(--bs-sandy);border: none; overflow: hidden">
                        <div class="card-body" style="z-index: 2">
                            <h2 class="card-title">Efekty i postępy</h2>
                            <p class="card-text">
                            <br>
                                Każdy grupowy, a także indywidualny kurs językowy przewiduje <b>lekcje powtórzeniowe</b>,
                                dzięki którym będziesz mógł/mogła lepiej przyswoić materiał.
                                <br><br>
                                Dodatkowo, wykorzystując metodę <b>gamifikacji</b>, będziesz w stanie monitorować swoje postępy i cieszyć się każdym
                                kolejnym krokiem w stronę <b>płynności językowej</b>.
                            </p>
                        </div> 
                        <div class="circle-magenta" style="bottom: -79px; right: -37px;"></div>
                    </div>
                </div>
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