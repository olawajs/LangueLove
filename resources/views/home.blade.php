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
        width: 414px;
        border-radius: 10px; 
        overflow: hidden; 
        height: 220px;
        z-index: 2;
    }
    .video-mask2{
        width: 380px;
        border-radius: 10px; 
        overflow: hidden; 
        height: 300px;
        z-index: 2;
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
    padding: 50px 0px;
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
#carousel1{
    padding-right: 0px !important;
    padding-left: 0px !important;
}
.fotoContiner{
    max-width: 550px;
    position: relative;
}

</style>
<div class="container">
    <div class="row justify-content-center classicDIV">
        <div class="col-md-8 animation">
            <div class="AnimationContent">
                <div class="m-3">
                    <h1>Ucz się języków i <span class="underline-blue">odkrywaj świat!</span></h1>
                </div>
                <div class="m-3 mb-4">
                    <h3>Gdzie chcesz i kiedy chcesz! Zacznij już dziś!</h3>
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

        
    </div>
    <div class="content">
    <!--  -->
    <div class="row justify-content-center classicDIV mt-3 mb-3" style="padding: 80px 10px;">
        <div>
            <h6 class="text-center smallText">OFERTA</h6>
        </div>
        <div class="mb-2">
            <h2 class="text-center">Ucz się języków i <span class="underline-magenta">odkrywaj świat na nowo!</span></h2>
        </div>
        <div class="d-flex p-2 justify-content-around flex-wrap">
            <div class="col-md-5 d-flex p-2 justify-content-around align-items-center  videoContainer" style="position: relative;">
                <div class="video-mask">
                    <video class="rounded Vid" autoplay muted>
                        <source src="/video/homePage.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="pinkHome-bubble">
                    <svg height="200" width="200">
                        <circle class="bubble1" cx="100" cy="100" r="100" fill=" var(--bs-secondary)" />
                    </svg> 
                </div>
                <!-- <div class="circle-magenta" style="bottom: -79px; right: -37px;"></div> -->
            </div>
            <div class="col-md-5" class="vidText">
               <p>
                    W jaki sposób uczysz się najefektywniej? <br>
                    Prowadzimy zarówno <b>zajęcia indywidualne, w parach, jak i kursy w małych grupach</b> (max. 6 osób). 
                    Dzięki temu lektor poświęci Ci wystarczającą ilość <b>czasu</b>, abyś faktycznie wyniósł wiele z każdej lekcji. 
                    Formę zajęć dostosowujemy do <b>Twojego celu</b>.
                    Korzystamy także z <b>autentycznych tekstów</b> (z prasy, wiadomości, literatury, blogów, social mediów, podcastów). 
                    Będziesz mieć na bieżąco kontakt nie tylko z wiedzą teoretyczną, ale także z <b>codziennym językiem</b> i często stosowanym słownictwem.
               </p>
               
                <button class="btn btn-primary w100"><a class="footLink" href="{{ route('searchPricelist', ['lang' => 1,'type' => 1]) }}" >Zapisz się na kurs</a></button>
            </div>
        </div>
      
                
   
    </div>
    <!--  -->
    <div class="row justify-content-center mt-3 mb-3" style="padding: 80px 10px;">
        <div>
            <h6 class="text-center smallText">NASI PODEJŚCIE</h6>
        </div>
        <div class="mb-2">
            <h2 class="text-center">Nauka nigdy nie była łatwiejsza</h2>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2" style="justify-content: space-evenly;">
            <div class="card " style="background-color: var(--bs-primary);color: white; border: none; aspect-ratio: 3/4; max-width: 350px">
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
            <div class="card" style="background-color: var(--bs-secondary); color: white;border: none;  aspect-ratio: 3/4; max-width: 350px" >
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
            <div class="card" style="background-color: var(--bs-sandy);border: none; overflow: hidden;  aspect-ratio: 3/4; max-width: 350px">
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

    <!--  -->

    <div class="row justify-content-center classicDIV pt-5 pb-5  mt-3 mb-3">
        <div>
            <h6 class="text-center smallText">NASI PROWADZĄCY</h6>
        </div>
        <div class="mb-2">
            <h2 class="text-center">Poznaj naszych prowadzących</h2>
        </div>
        <div id="arrows"></div>
        <div class="owl-carousel" id="carousel1">
        @foreach ($lectors as $lector)
        <div class="card LectorCard">
         <div class="LectorPhotoCard" style="background: url('/images/lectors/{{$lector->photo}}');
            background-position: center;
            background-size: 220px;
            background-repeat: no-repeat;"></div>
         <div style="margin: 24px 0px;"><h4 class="text-center"><b>{{$lector->name}}</b></h4></div>   
         <div style="padding-left: 18px;">
            @foreach (App\Models\LanguageLevel::where('lector_id',$lector->id)->distinct('language_id')->pluck('language_id') as $d)
                    <span><i class="flag flag-{{ App\Models\Language::find($d)->short}}"></i>Język {{ App\Models\Language::find($d)->name}}</span><br>
            @endforeach
         </div>  
         <div class="CardButton"><a href="{{ route('showLector',$lector->id) }}">Poznaj &#8594;</a></div> 
        </div>

        @endforeach
        </div>
    </div>
    


    <!--  -->
    <div class="pb-5 pt-5 mt-3 mb-3">
        <div>
            <h6 class="text-center smallText">OPINIE</h6>
        </div>
        <div class="mb-2">
            <h2 class="text-center">Sprawdź <span class="underline-blue">co mówią </span>o nas studenci</h2>
        </div>
        
        <div class="owl-carousel owl-theme" id="carousel2">
            <!-- 1 -->
            <div class="item d-flex p-2 flex-wrap" style="justify-content: center; gap: 20px;">
                <div class="dynkspUp"><img src="/images/Dynks.png"></div>
                <div class="col-md-5 TextComment">
                    <p>
                    Jestem totalnie zadowolona. 😃 Szkoła była moim wybawieniem. 
                    Po pierwsze właścicielki - wyrozumiałe i zawsze skore do pomocy. 
                    Tryska od nich energia i aż chce się uczyć, dlatego moja motywacja nie maleje. 
                    Po drugie szkoła uczy aż 10 języków, co rzadko się zdarza. 
                    Mogę się tutaj uczyć kilku języków. Obecnie uczę się angielskiego z lektorką Anią, 
                    w przyszłości planuję także powrócić do hiszpańskiego i może rozpocząć naukę kolejnego języka... kto wie. 
                    Na pewno Ania zaraziła mnie motywacją, bo chyba pierwszy raz w mojej 10-letniej nauce angielskiego, czuję,
                    że te zajęcia to prawdziwy challenge. Totalnie dopasowane do moich potrzeb. 
                    Sporo się uczę i z zajęć na zajęcia podnoszę swój poziom. A taki właśnie był mój cel! 
                    Po trzecie social media, które są skarbnicą wiedzy, inspiracji i humoru na temat nauki języków. 
                    Polecam LangueLove wszystkim! 💜
                    </p>
                    <p><i>Wiktoria</i></p>
                 </div> 
                <div class="col-md-5 d-flex p-2 justify-content-around align-items-center fotoContiner" >
                    <div class="video-mask2">
                        <img class="rounded"  src="/images/opinions/opinia2.jpg">
                    </div>
                    <div class="circle-magenta" id="circle" style="bottom: -20px; right: -2px;"></div>
                </div>
            </div>
            <!-- 2 -->
            <div class="item d-flex p-2 flex-wrap" style="justify-content: center; gap: 20px;">
                <div class="col-md-5 d-flex p-2 justify-content-around align-items-center fotoContiner" >
                    <div class="video-mask2">
                        <img class="rounded"  src="/images/opinions/opinia1.jpg">
                    </div>
                    <div class="circle-blue" id="circle" style="bottom: -20px; left: -2px;"></div>
                </div>
                
                <div class="col-md-5 TextComment">
                    <p>
                    I started learning Polish with LangueLove and so far so good! Highly recommended.
                    </p>
                    <p><i>Furkan</i></p>
                 </div> 
                <div><img src="/images/Dynks.png"></div>
            </div>
            <!-- 3 -->
            <div class="item d-flex p-2 flex-wrap" style="justify-content: center; gap: 20px;">
                <div class="dynkspUp"><img src="/images/Dynks.png"></div>
                <div class="col-md-5 TextComment">
                    <p>
                    The best school and teacher ever had. All perfect. Lessons are always interested and fully personalised.
                     Amazing atmosphere throughout the time of lessons and (what’s the most important) the real language skills improvement. 
                    I do recommend to everybody!
                    </p>
                    <p><i>Alicja</i></p>
                 </div> 
                <div class="col-md-5 d-flex p-2 justify-content-around align-items-center fotoContiner" >
                    <div class="video-mask2">
                        <img class="rounded"  src="/images/opinions/opinia3.jpg">
                    </div>
                    <div class="circle-magenta" id="circle" style="bottom: -20px; right: -2px;"></div>
                </div>
            </div>
            <!-- 4 -->
            <div class="item d-flex p-2 flex-wrap" style="justify-content: center; gap: 20px;">
                <div class="col-md-5 d-flex p-2 justify-content-around align-items-center fotoContiner" >
                    <div class="video-mask2">
                        <img class="rounded"  src="/images/opinions/opinia6.jpg">
                    </div>
                    <div class="circle-blue" id="circle" style="bottom: -20px; left: -2px;"></div>
                </div>
                
                <div class="col-md-5 TextComment">
                    <p>
                    I stongly recommend the school as it distinguish itself by adapting classes to personal interests, 
                    a lot of time dedicated for conversations, unconventional exercises. 
                    Last but not least, stuff is really friendly and supportive 😉
                    </p>
                    <p><i>Rafał</i></p>
                 </div> 
                <div><img src="/images/Dynks.png"></div>
            </div>
            <!-- 5 -->
            <div class="item d-flex p-2 flex-wrap" style="justify-content: center; gap: 20px;">
                <div class="dynkspUp"><img src="/images/Dynks.png"></div>
                <div class="col-md-5 TextComment">
                    <p>
                    Moja przyjaciółka znalazła Wiktorię na instagramie i od tego zaczęła się wspólna przygoda
                     - chciałyśmy odświeżyć podstawy i kontynuować naukę. 
                     Odbywa się to w przesympatycznej atmosferze a w tym samym czasie niesamowicie profesjonalnie - 
                     każda lekcja jest w pełni przygotowana i przemyślana.
                     Dziękuję za wszystko i czekam na więcej! Grazie!
                    </p>
                    <p><i>Ola</i></p>
                 </div> 
                <div class="col-md-5 d-flex p-2 justify-content-around align-items-center fotoContiner" >
                    <div class="video-mask2">
                        <img class="rounded"  src="/images/opinions/opinia5.jpg">
                    </div>
                    <div class="circle-magenta" id="circle" style="bottom: -20px; right: -2px;"></div>
                </div>
            </div>           
            <!-- 6 -->
            <div class="item d-flex p-2 flex-wrap" style="justify-content: center; gap: 20px;">
                <div class="col-md-5 d-flex p-2 justify-content-around align-items-center fotoContiner" >
                    <div class="video-mask2">
                        <img class="rounded"  src="/images/opinions/opinia6.jpg">
                    </div>
                    <div class="circle-blue" id="circle" style="bottom: -20px; left: -2px;"></div>
                </div>
                
                <div class="col-md-5 TextComment">
                    <p>
                    Bardzo polecam, Weronika jest świetną nauczycielką. 
                    Lekcje nie są nudne a wręcz przeciwnie, fajne podejście i luźna atmosfera.
                    </p>
                    <p><i>Konrad</i></p>
                 </div> 
                <div><img src="/images/Dynks.png"></div>
            </div>
            <!-- 7 -->
            <div class="item d-flex p-2 flex-wrap" style="justify-content: center; gap: 20px;">
                <div class="dynkspUp"><img src="/images/Dynks.png"></div>
                <div class="col-md-5 TextComment">
                    <p>
                    Już od kilku miesięcy uczę się włoskiego z Wiktorią. Jestem bardzo zadowolona ze sposobu prowadzenia lekcji. 
                    Zajęcia nie są monotonne, Wiktoria często robi lekcje tematyczne, 
                    a materiały są estetycznie przygotowane i przede wszystkim dużo mówimy po włosku! 
                    Oczywiście to wszystko odbywa się w bardzo miłej i przyjaznej atmosferze, bez żadnego stresu.
                     Dla mnie efekty są zadowalające bo z każdym kolejnym wyjazdem do Włoch coraz częściej używam tego języka zamiast angielskiego.
                    </p>
                    <p><i>Natalia</i></p>
                 </div> 
                <div class="col-md-5 d-flex p-2 justify-content-around align-items-center fotoContiner" >
                    <div class="video-mask2">
                        <img class="rounded"  src="/images/opinions/opinia7.jpg">
                    </div>
                    <div class="circle-magenta" id="circle" style="bottom: -20px; right: -2px;"></div>
                </div>
            </div>
            <!-- 8 -->
            <div class="item d-flex p-2 flex-wrap" style="justify-content: center; gap: 20px;">
                <div class="col-md-5 d-flex p-2 justify-content-around align-items-center fotoContiner" >
                    <div class="video-mask2">
                        <img class="rounded"  src="/images/opinions/opinia8.jpg">
                    </div>
                    <div class="circle-blue" id="circle" style="bottom: -20px; left: -2px;"></div>
                </div>
                <div class="col-md-5 TextComment">
                    <p>
                    Bardzo polecam tę szkołę językową. Uczę się języka włoskiego. Zajęcia mam z lektorką Adą- 
                    lekcje z nią to sama przyjemność. Jest bardzo kompetentna i potrafi bardzo dobrze wytłumaczyć gramatykę.
                     Jeśli ktoś już próbował różnych sposobów nauki języka włoskiego, to tutaj się nie zawiedzie. Serdecznie polecam :)
                    </p>
                    <p><i>Sylwia</i></p>
                 </div> 
                <div><img src="/images/Dynks.png"></div>
            </div>
        </div>
    <!--  -->
       
    </div>
    
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
<script src="{{ asset('js/owlCarousel/owl.carousel.min.js') }}" defer></script>

<script>
    $(document).ready(function () {
     
        $(document).ready(function(){
            $("#carousel1").owlCarousel({
                loop:true,
                margin:10,
                center:true,
                nav:true,
                navText:['&#8592;','&#8594;'],
                navContainer: document.getElementById('arrows'),
                autoplay: true,
                autoplayTimeout: 5000,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:3
                    },
                    1400:{
                        items:4
                    }
                }
            });
            $("#carousel2").owlCarousel({
                loop:true,
                margin:10,
                center:true,
                nav:true,
                navText:['<span style="font-size: x-large;">&#8592;</span>','<span style="font-size: x-large;">&#8594;</span>'],
                navContainer: document.getElementById('arrows2'),
                // autoplay: true,
                autoplayTimeout: 5000,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
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