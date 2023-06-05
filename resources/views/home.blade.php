@extends('layouts.app')
<!DOCTYPE html>
<!-- <link rel="stylesheet" href="owlCarousel/owl.carousel.min.css">
<link rel="stylesheet" href="owlCarousel/owl.theme.default.min.css"> -->
<link href="{{ asset('css/owlCarousel/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/owlCarousel/owl.theme.default.min.css') }}" rel="stylesheet">

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
    .smallText{
        color: #969696;
    }
    .video-mask{
    width: 320px;
    border-radius: 10px; 
    overflow: hidden; 
    }
    .lectorTab{
        border: 1px solid grey;
    }
    /*Magic card*/
.cardLector {
 width: 220px;
 height: 254px;
 background: #f5f5f5;
 overflow: visible;
 box-shadow: 0 5px 20px 2px rgba(0,0,0,0.1);
 display: flex;
 flex-direction: column;
 align-items: center;
}

.card-info {
 display: flex;
 flex-direction: column;
 align-items: center;
 gap: 2em;
 padding: 0 1rem;
 width: 100%;
 height: 190px;

}

.card-img {
 --size: 100px;
 width: var(--size);
 height: var(--size);
 border-radius: 50%;
 transform: translateY(-50%);
 position: relative;
 transition: all .3s ease-in-out;
 margin-bottom: -40px;
}

.card-img::before {
 content: "";
 border-radius: inherit;
 position: absolute;
 top: 50%;
 left: 50%;
 width: 90%;
 height: 90%;
 transform: translate(-50%, -50%);

}

/*Text*/
.text-title {
 text-transform: uppercase;
 font-size: 0.75em;
 color: #42caff;
 letter-spacing: 0.05rem;
}

.text-body {
 font-size: .8em;
 text-align: center;
 color: #6f6d78;
 font-weight: 400;
 font-style: italic;
 overflow: hidden;
 text-overflow: ellipsis;
}

.owl-stage-outer{
    padding: 50px;
}
.owl-prev,.owl-next{
    background: none;
    border: none;
}
#arrows{
    margin-left: auto;
    margin-right: 0;
    width: fit-content;
    margin-top: -32px;
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
    <!--  -->
    <div class="row justify-content-center classicDIV p-5 mt-3 mb-3">
        <div>
            <h6 class="text-center smallText">OFERTA</h6>
        </div>
        <div class="mb-2">
            <h2 class="text-center">Ucz się języków i <span class="underline-magenta">odkrywaj świat na nowo</span></h2>
        </div>
        <div class="d-flex p-2 justify-content-around flex-wrap">
            <div class="col-md-5 d-flex p-2 justify-content-around align-items-center videoDot videoContainer" >
                <div class="video-mask">
                    <video width="320" height="170" class="rounded" autoplay muted>
                        <source src="/video/homePage.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <!-- <div class="circle-magenta" id="circle" style="bottom: -79px; right: -37px;"></div> -->
                <!-- <div class="circle-magenta" style="bottom: -79px; right: -37px;"></div> -->
            </div>
            <div class="col-md-5" style="text-align: center;">
               <p>
                    W jaki sposób uczysz się najefektywniej? <br><br>
                    Prowadzimy zarówno zajęcia indywidualne, w parach, jak i kursy w małych grupach (max. 6 osób). 
                    Dzięki temu lektor poświęci Ci wystarczającą ilość <b>czasu</b>, abyś faktycznie wyniósł wiele z każdej lekcji. 
                    Formę zajęć dostosowujemy do <b>Twojego celu</b>. <br>
                    Korzystamy także z <b>autentycznych tekstów</b> (z prasy, wiadomości, literatury, blogów, social mediów, podcastów). 
                    Będziesz mieć na bieżąco kontakt nie tylko z wiedzą teoretyczną, ale także z <b>codziennym językiem</b> i często stosowanym słownictwem.
               </p>
                <button class="btn btn-primary"><a class="footLink" href="https://languelove.pl/priceList/search/1/1" >Zapisz się na kurs</a></button>
            </div>
        </div>
      
                
   
    </div>
    <!--  -->
    <div>
        <div>
            <h6 class="text-center smallText">NASI PROWADZĄCY</h6>
        </div>
        <div class="mb-2">
            <h2 class="text-center">Poznaj naszych prowadzących</h2>
        </div>
        <div id="arrows"></div>
        <div class="owl-carousel">
        @foreach ($lectors as $lector)
            <div class="card cardLector">
                <div class="card-img" style="background: url('/images/lectors/{{$lector->photo}}'); background-position: center;background-size: 105px;background-repeat: no-repeat;"></div>
                <div class="card-info">
                    <span class="text-body">
                    {!!  \Illuminate\Support\Str::limit(strip_tags($lector->description), 200,'.....')  !!}
                    </span>
                    <p class="text-title"><a href="{{ route('showLector',$lector->id) }}">Poznaj mnie &#8594;</a></p>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    


    <!--  -->
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
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
                        <div class="circle-magenta" id="circle" style="bottom: -79px; right: -37px;"></div>
                    </div>
                </div>
            </div>
    </div>
    
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
<script src="{{ asset('js/owlCarousel/owl.carousel.min.js') }}" defer></script>

<script>
    $(document).ready(function () {
     
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                loop:true,
                margin:10,
                center:true,
                nav:true,
                navText:['&#8592;','&#8594;'],
                navContainer: document.getElementById('arrows'),
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:4
                    }
                }
            });
        });

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