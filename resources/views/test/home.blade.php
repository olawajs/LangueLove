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
        accent-color:var(--bs-primary);
    }
    .checkRow{
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
    .inputDiv:hover{
        background-color:  var(--langue-love-light-purple);
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
.AboutBox{
    border: 1px solid var(--langue-love-light-grey);
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
nav{
    background-color: #E7E5EC;
}
#back-to-top-btn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 48px;
    height: 48px;
    transform: rotate(90deg);
    padding: 10px;
    justify-content: center;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
    cursor: pointer;
    z-index: 50;
    border-radius: 8px;
    border: 1px solid var(--langue-love-light-grey, #D7D7D7);
    background: var(--langue-love-white, #FFF);
}
</style>
<div id="back-to-top-btn"><img src="{{asset('images/svg/AArrowL.svg')}}" width="10px"  alt=""></div>
<div class="container Desktop">
    <div class="row justify-content-center GrayBack">
        <div class="col-md-8 animation">
            <div class="AnimationContent">
                <div class="SearchBox">
                    <div>
                        <h1 class="BoldText">Ucz się języków i <span class="underlinePink">odkrywaj świat!</span></h1>
                    </div>
                    <div>
                        <h3 style="font-size: 16px;">Gdzie chcesz i kiedy chcesz! Zacznij już dziś!</h3>
                    </div>
                </div>
                <div class="col-md-8 m-3"> 
                    <form method="POST" action="{{ route('search') }}">
                        @csrf
                        <div style="display: flex;  align-items: flex-start;  gap: 32px;">
                            <div class="SearchContainer">
                                <div class="SearchButton">
                                    <button class="btn" type="button" id="language" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;  text-align: left;">
                                                <span class="SearchCat">Język</span><br>
                                                <div style="display: flex;  justify-content: space-between;"><span class="SearchChosen" id="langTextD">Dowolny</span><img src="{{asset('images/svg/arrowDown.svg')}}"></div>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="language" style="width: min-content">
                                        <div class="row checkRow">
                                            <div class="inputDiv">
                                                <input type="checkbox" class="inputs langInp" id="lang0D" name="lang[]" value="0" checked> Dowolny
                                            </div>
                                            @foreach ($languages as $language)
                                                <div class="inputDiv">
                                                    <input type="checkbox" class="inputs langInp" name="lang[]" value="{{$language->id}}"> {{$language->name}}
                                                </div>
                                            @endforeach
                                        </div>                        
                                    </ul>
                                </div>
                                <div style="border-left: 1px solid #CDCDCD;  width: 1px;  height: 38px;"></div>
                                <div class="SearchButton">
                                    <button class="btn" type="button" id="course" data-bs-toggle="dropdown"  aria-expanded="false"  style="width: 100%;  text-align: left;">
                                                <span class="SearchCat">Rodzaj kursu</span><br>
                                                <div style="display: flex;  justify-content: space-between;"><span class="SearchChosen" id="typeTextD">Dowolny </span><img src="{{asset('images/svg/arrowDown.svg')}}"></div>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="course" style="width: min-content">
                                        <div class="row checkRow">
                                            <div class="inputDiv">
                                                <input type="checkbox" class="inputs typeInp" id="type0D" name="type[]" value="0" checked> Dowolny
                                            </div>
                                            @foreach ($types as $type)
                                                <div class="inputDiv">
                                                    <input type="checkbox" class="inputs typeInp" name="type[]" value="{{$type->id}}"> {{$type->name}}
                                                </div>
                                            @endforeach
                                        </div>      
                                    </ul>
                                </div>
                            </div>
                             <div class="" style="position: relative">
                                <button class="btn btn-black" type="submit" style="width: 100%;white-space: nowrap;">Szukaj zajęć</button>
                                <img style="position: absolute;  top: 13px;  width: 200px;  left: 26px;" src="{{asset('images/svg/arrowZigZag.svg')}}">
                            </div>
                        </div>
                        
                        
                    </form>
                   
                </div>
            </div>
        </div> 
    </div>
    <div class="content">
       
        <!-- Webinary/ Grupowe -->
        <div class="row justify-content-center AboutDiv" id="metody">
            <div>
                <h3 class="smallHeadText">NIE PRZEGAP</h3>
                <h2 class="bigHeadText" style="text-align: center;">Zajęcia grupowe</h2>
            </div>
            <div class="AboutBoxes" style="justify-content: space-between;">
            @foreach($grupy as $f)
                <a class="card-link" href="{{ route('showLesson',$f->id) }}">
                    <div class="card col-3" style="width: 276px; height: 354px; border-radius: 16px; border: 1px solid var(--langue-love-light-grey);">
                        <!-- <img class="card-img-top" src="/images/lessons/{{$f->photo}}" alt="Card image cap"> -->
                        <img class="card-img-top" src="https://languelove.pl/images/lessons/{{$f->photo}}" style="width: 100%; height: 194px;object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text-title">{{$f->title}}</p>
                            <div class="card-desc">
                            <div class="d-flex" style="gap: 12px"><img src="{{asset('images/flags/'.App\Models\Language::find($f->language_id)->short.'.svg')}}" style="width: 20px !important">język {{ App\Models\Language::find($f->language_id)->name}}</div>
                                @foreach (App\Models\CalendarEvent::where('lesson_id',$f->id)->orderBy('start', 'desc')->take(1)->get() as $date)
                                    <div class="d-flex" style="gap: 12px"><img src="{{asset('images/svg/smallClock.svg')}}" style="width: 20px !important">{{ \Carbon\Carbon::parse($date->start)->locale('pl')->format('d')}} {{ \Carbon\Carbon::parse($date->start)->locale('pl')->shortMonthName}}. {{ \Carbon\Carbon::parse($date->start)->locale('pl')->format('Y, H:i')}}</div>
                                @endforeach 
                            </div>
                            
                        </div>
                    </div>
                </a>
            @endforeach
               
            </div>
        </div>
        <!-- Oferta -->
        <div class="row justify-content-center ColRev BeigeBack AboutDiv" id="oSzkole">
            <div class="col-5" style="position: relative;display: flex;  justify-content: start;" >
                <img src="{{asset('images/fotos/home1.png')}}" class="" alt="">
                <img src="{{asset('images/svg/sparkle.svg')}}" style="position: absolute;  left: 480px;  top: -96px;"  alt="">
            </div>
             <div class="col-1"></div>
            <div class="col-6 TextDisplay">
                <div class="homeHeads">
                    <h3 class="PinkText">OFERTA</h3>
                    <h2 class="middleText" style="text-align: left !important;">Ucz się języków <br> <span class="underlinePink">i odkrywaj świat na nowo</span></h2>
                </div>
                <p>
                    W jaki sposób uczysz się najefektywniej? 
                    Prowadzimy zarówno <b>zajęcia indywidualne, w parach, jak i kursy w małych grupach</b> (max. 6 osób).
                    Dzięki temu lektor poświęci Ci wystarczającą ilość czasu, abyś faktycznie wyniósł wiele z każdej lekcji. 
                </p>
                <p>
                    Formę zajęć dostosowujemy do Twojego celu. 
                    Korzystamy także z autentycznych tekstów (z prasy, wiadomości, literatury, blogów, social mediów, podcastów). 
                    Będziesz mieć na bieżąco kontakt nie tylko z wiedzą teoretyczną, ale także z codziennym językiem i często stosowanym słownictwem.
                </p>
                <a href="/priceList/search/1/1" class="LL-button LL-button-primary" style="width: fit-content;">Zapisz się na kurs</a>
            </div>
        </div>
<!-- Kafelki -->
<div class="row justify-content-center ColRev AboutDiv" id="metody">
            <div class="homeHeads">
                <h3 class="smallHeadText VioletText">NASZE PODEJŚCIE</h3>
                <h2 class="bigHeadText" style="text-align: center;">Dlaczego wybrać LangueLove</h2>
            </div>
            
        <div class="col-12 AboutBoxes">
            <div class="AboutBox">
                <img src="{{asset('images/aboutUs/bulb.svg')}}" class="" alt="">
                <h2 class="middleText" style="text-align: left">Dopasowanie</h2>
                <p>
                    Stosujemy różnorodne metody nauki, dostosowane do Twojego celu. 
                    Jesteśmy młodym zespołem, który rozumie obecne potrzeby na rynku. 
                    Wiemy, że nie każdy musi znać różnicę między zdaniami prostymi, 
                    a złożonymi, <b>by się swobodnie komunikować w języku obcym.</b>
                    Chcesz coś zmienić? Czegoś Ci brakuje? Powiedz nam o tym.
                </p>
            </div>
            <div class="AboutBox">
                <img src="{{asset('images/aboutUs/calendar.svg')}}" class="" alt="">
                <h2 class="middleText" style="text-align: left">Dostępność</h2>
                <p>
                    Ucz się, gdzie chcesz, kiedy chcesz i ile chcesz. 
                    To Ty decydujesz o liczbie i częstotliwości zajęć. 
                    Nasz <b>kalendarz</b> pomoże Ci w szybkim umawianiu się na zajęcia: sprawdź dostępność lektora i wybierz najbardziej odpowiadający Ci termin. <br>
                    Jesteś w podróży i chcesz wykorzystać ten czas? Podepnij słuchawki do telefonu i działamy!
                </p>
            </div>
            <div class="AboutBox">
                <img src="{{asset('images/aboutUs/rocket.svg')}}" class="" alt="">
                <h2 class="middleText" style="text-align: left; white-space: nowrap;">Realny efekt</h2>
                <p>
                    Każdy kurs przewiduje <b>lekcje powtórzeniowe</b>, dzięki którym możesz lepiej przyswoić materiał.
                    Bez regularności nie ma efektów, a omówienie raz zagadnienia nie sprawi, że się go nauczysz.
                    Wykorzystując elementy metody <b>gamifikacji</b>, będziesz w stanie monitorować swoje sukcesy i cieszyć się ze swoich postępów!
                
                </p>
            </div>
        </div>
    </div>
    <!-- co wybrać -->
    <div class="row justify-content-center ColRev AboutDiv PurpleBack">
        <div class="col-6 TextDisplay">
            <div class="homeHeads">
                <h3 class="VioletText">KONTAKT</h3>
                <h2 class="middleText" style="text-align: left !important;">Nie wiesz, który kurs <span class="underlinePink">wybrać</span>?</h2>
            </div>
            <p>
            Jesteśmy stale do Twojej dyspozycji. Możesz się z nami skontaktować poprzez social media, 
            e-mailowo lub telefonicznie. Porozmawiamy o Twoich oczekiwaniach, 
            umiejętnościach językowych i wskażemy, który kurs będzie dla Ciebie najlepszy.
            </p>
            <a href="{{ route('contact') }}" class="LL-button LL-button-primary2" style="width: fit-content;">Skontaktuj się z nami</a>
        </div>
        <div class="col-1"></div>
        <div class="col-5" style="position: relative;display: flex;  justify-content: end;" >
                <img src="{{asset('images/fotos/home2.png')}}" class="" alt="">
        </div>
    </div>
<!-- Zespół -->

    <div class="row justify-content-center"  style="position: relative; padding: 100px 0;  margin-top: 100px;">
        <img src="{{asset('images/svg/korona3.svg')}}" style="position: absolute;  left: 120px;  width: 170px; top: -58px; "  alt="">
        <div class="row justify-content-center">
            <div class="homeHeads">
                <h3 class="VioletText" style="color: #6D6D6D;text-align: center !important;">NASI PROWADZĄCY</h3>
                <h2 style="text-align: center !important;">Poznaj naszych lektorów</h2>
                <div id="arrows" style="margin-top: -55px;"></div>
            </div>
            
            <div class="owl-carousel" id="carousel1">
                @foreach (App\Models\Lector::where('active',1)->where('id','!=',18)->get() as $lector)
                <a class="card-link" href="{{ route('showLector',$lector->id) }}">
                    <div class="card lectorCardNew" style="height: 438px;">
                        <div><img src='/images/lectors/{{$lector->photo}}' style="width: 220px !important"></div>
                        <div><h4 class="text-center" style="font-size: 32px"><b>{{$lector->name}}</b></h4></div>   
                        <div class="carouselFlags">
                            @foreach (App\Models\LanguageLevel::where('lector_id',$lector->id)->distinct('language_id')->pluck('language_id') as $d)
                                    <div class="d-flex" style="gap: 12px"><img src="{{asset('images/flags/'.App\Models\Language::find($d)->short.'.svg')}}" style="width: 20px !important">Język {{ App\Models\Language::find($d)->name}}</div>
                            @endforeach
                        </div>
                    </div>
                </a>

                @endforeach
            </div>
        </div>
    </div>

    <!-- opinie -->
    <div class="row justify-content-center ColRev AboutDiv PurpleBack2" style="position: relative">
        <img src="{{asset('images/svg/flower.svg')}}" style="position: absolute;  right: 40px;  width: 168px;  top: -50px;"  alt="">
        <div class="col-4">
            <div class="homeHeads">
                <h3 class="VioletText">OPINIE</h3>
                <h2>Sprawdź co mówią o nas studenci</h2>
            </div>
            <div style="gap: 32px;  display: flex;  flex-flow: column; align-items: end; margin-top: 140px; position: relative">
                <div><img src="{{asset('images/svg/beigeDot.svg')}}" class="" alt=""></div>
                 <div class="opiniaDiv">
                    <div>
                        <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                    </div>
                    <div>
                        <p>
                            Już od kilku miesięcy uczę się włoskiego z Wiktorią. 
                            Jestem bardzo zadowolona ze sposobu prowadzenia lekcji. 
                            Zajęcia nie są monotonne, Wiktoria często robi lekcje tematyczne, 
                            a materiały są estetycznie przygotowahne i przede wszystkim dużo
                            mówimy po włosku! Oczywiście to wszystko odbywa się w bardzo miłej
                            i przyjaznej atmosferze, bez żadnego stresu. 
                            Dla mnie efekty są zadowalające, bo z każdym kolejnym wyjazdem 
                            do Włoch co raz częściej używam tego języka zamiast angielskiego. 
                        </p>
                    </div>
                    <div style="font-weight: 600;">Natalia</div>
                </div>
                <div><img src="{{asset('images/svg/violetPizza1.svg')}}" class="" alt=""></div>
            </div>
            <img src="{{asset('images/svg/paperplane.svg')}}" style="position: absolute;  left: 0;  width: 400px;"  alt="">
           
        </div>
        <div class="col-4" style="gap: 32px;  display: flex;  flex-flow: column;align-items: end;">
            <div class="opiniaDiv">
                <div>
                    <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                </div>
                <div>
                    <p>
                        Bardzo polecam, Weronika jest świetną nauczycielką. 
                        Lekcje nie są nudne, a wręcz przeciwnie, fajne podejście i luźna atmosfera.
                    </p>
                </div>
                <div style="font-weight: 600;">Konrad</div>
            </div>
            <div class="opiniaDiv">
                <div>
                    <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                </div>
                <div>
                    <p>
                    Jestem totalnie zadowolona. 😄
                     Szkoła była moim wybawieniem. Po pierwsze właścicielki - wyrozumiałe i zawsze skore do pomocy. 
                     Tryska od nich energia i aż chce się uczyć, dlatego moja motywacja nie maleje. 
                     Po drugie szkoła uczy aż 0 języków, co rzadko się zdarza. Mogę się tutaj uczyć kilku języków.
                     Obecnie uczę się angielskiego, czuję, że te zajęcia to prawdziwy challenge. 
                     Totalnie dopasowane do moich potrzeb. Sporo się uczę i z zajęć na zajęcia podnoszę swó poziom. 
                     A taki właśnie był mój cel! Po trzecie social media, które są skarbnicą wiedzy, 
                     inspiracji i humoru na temat nauki języków. Polecam LangueLove wszystkim! 💜
                    </p>
                </div>
                <div style="font-weight: 600;">Wiktoria</div>
            </div>
            <div class="opiniaDiv">
                <div>
                    <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                </div>
                <div>
                    <p>
                    Moja przyjaciółka znalazła Wiktorię na Instagramie i od tego zaczęła się wspólna przygoda - 
                    chciałyśmy odświeżyć podstawy i kontynuować naukę. Odbywa się to w przesympatycznej atmosferze,
                     a w tym samym czasie niesamowicie profesjonalnie - każda lekcja jest w pełni przygotowana i przemyślana. 
                     Dziękuję za wszystko i czekam na więcej! Grazie!
                    </p>
                </div>
                <div style="font-weight: 600;">Ola</div>
            </div>
            <div><img src="{{asset('images/svg/redPizza1.svg')}}" class="" alt=""></div>
        </div>
        <div class="col-4" style="gap: 32px;  display: flex;  flex-flow: column; padding-top: 60px;">
            <div><img src="{{asset('images/svg/redPizza2.svg')}}" class="" alt=""></div>
            <div class="opiniaDiv">
                <div>
                    <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                </div>
                <div>
                    <p>
                    I started learning Polish with LangueLove and so far so good! Highly recommended.
                    </p>
                </div>
                <div style="font-weight: 600;">Furkan</div>
            </div>
            <div class="opiniaDiv">
                <div>
                    <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                </div>
                <div>
                    <p>
                    The best school and teacher ever had. All Perfect. 
                    Lessons are always interested and fully personalised. 
                    Amazing atmosphere throughout the time of lessons and (what’s most important) the real language skills improvement. 
                    I do recommend to everybody!
                    </p>
                </div>
                <div style="font-weight: 600;">Alicja</div>
            </div>
            <div class="opiniaDiv">
                <div>
                    <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                </div>
                <div>
                    <p>
                    I strongly reccomend the school as it distinguish itself by adapting classes to personal interests, 
                    a lot of time dedicated for conversations, unconventional excercises. Last but not least, stuff is really friendly and supportive 
                    </p>
                </div>
                <div style="font-weight: 600;">Rafał</div>
            </div>
            <div class="opiniaDiv">
                <div>
                    <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                </div>
                <div>
                    <p>
                    Bardzo polecam tę szkołę językową. Uczę się języka włoskiego. Zajęcia mam z lektorką Adą - lekcje z nią to sama przyjemność. 
                    Jest bardzo kompetentna i potrafi bardzo dobrze wytłumaczyć gramatykę. 
                    Jeśli ktoś już próbował różnych sposobów nauki języka włoskiego, to tutaj się nie zawiedzie. Serdecznie polecam :)
                    </p>
                </div>
                <div style="font-weight: 600;">Sylwia</div>
            </div>
        </div>
    </div>

  
</div>
    
</div>
<!-- Mobile -->
<div class="container mobile">
    <div class="row justify-content-center GrayBack">
        <div class="col-md-8 animation" style="margin-top: 30px;">
            <div class="AnimationContent">
                <div class="SearchBox">
                    <div>
                        <h1 class="BoldText">Ucz się języków i <span class="underlinePink">odkrywaj świat!</span></h1>
                    </div>
                    <div>
                        <h3 style="font-size: 16px;">Gdzie chcesz i kiedy chcesz! Zacznij już dziś!</h3>
                    </div>
                </div>
                <div class="col-md-8"> 
                    <form method="POST" action="{{ route('search') }}">
                        @csrf
                        <div style="display: flex;  align-items: flex-start;  gap: 12px;flex-flow: column;">
                            <div class="SearchContainer">
                                <div class="SearchButton">
                                    <button class="btn" type="button" id="language" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;  text-align: left;">
                                                <span class="SearchCat">Język</span><br>
                                                <div style="display: flex;  justify-content: space-between;"><span class="SearchChosen" id="langTextM">Dowolny</span><img src="{{asset('images/svg/arrowDown.svg')}}"></div>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="language" style="width: min-content">
                                        <div class="row checkRow">
                                            <div class="inputDiv">
                                                <input type="checkbox" class="inputs langInp" id="lang0M" name="lang[]" value="0" checked> Dowolny
                                            </div>
                                            @foreach ($languages as $language)
                                                <div class="inputDiv">
                                                    <input type="checkbox" class="inputs langInp" name="lang[]" value="{{$language->id}}"> {{$language->name}}
                                                </div>
                                            @endforeach
                                        </div>                        
                                    </ul>
                                </div>
                            </div>
                            <div class="SearchContainer">
                                <div class="SearchButton">
                                    <button class="btn" type="button" id="course" data-bs-toggle="dropdown"  aria-expanded="false"  style="width: 100%;  text-align: left;">
                                                <span class="SearchCat">Rodzaj kursu</span><br>
                                                <div style="display: flex;  justify-content: space-between;"><span class="SearchChosen" id="typeTextM">Dowolny </span><img src="{{asset('images/svg/arrowDown.svg')}}"></div>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="course" style="width: min-content">
                                        <div class="row checkRow">
                                            <div class="inputDiv">
                                                <input type="checkbox" class="inputs typeInp" id="type0M" name="type[]" value="0" checked> Dowolny
                                            </div>
                                            @foreach ($types as $type)
                                                <div class="inputDiv">
                                                    <input type="checkbox" class="inputs typeInp" name="type[]" value="{{$type->id}}"> {{$type->name}}
                                                </div>
                                            @endforeach
                                        </div>      
                                    </ul>
                                </div>
                            </div>
                             <div class="" style="position: relative;width: 100%;">
                                <button class="btn btn-black" type="submit" style="width: 100%;white-space: nowrap;">Szukaj zajęć</button>
                                <!-- <img style="position: absolute;  top: 13px;  width: 100%;  left: 26px;" src="{{asset('images/svg/arrowZigZag.svg')}}"> -->
                            </div>
                        </div>
                        
                        
                    </form>
                   
                </div>
            </div>
        </div> 
    </div>
    <div class="content">
       
        <!-- Webinary/ Grupowe -->

        <div class="row justify-content-center"  style="position: relative;">
            <!-- <img src="{{asset('images/svg/korona3.svg')}}" style="position: absolute;  left: 120px;  width: 170px; top: -58px; "  alt=""> -->
            <div class="row justify-content-center">
                <div class="homeHeads">
                    <h3 class="smallHeadText">NIE PRZEGAP</h3>
                    <h2 class="middleText" style="text-align: left !important;">Zajęcia grupowe</h2>
                </div>
                
                <div class="owl-carousel" id="carousel3">
                    @foreach($grupy as $f)
                        <a class="card-link" href="{{ route('showLesson',$f->id) }}">
                            <div class="card col-3" style="width: 276px; height: 354px; border-radius: 16px; border: 1px solid var(--langue-love-light-grey);">
                                <!-- <img class="card-img-top" src="/images/lessons/{{$f->photo}}" alt="Card image cap"> -->
                                <img class="card-img-top" src="https://languelove.pl/images/lessons/{{$f->photo}}" style="width: 100%; height: 194px;object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text-title">{{$f->title}}</p>
                                    <div class="card-desc">
                                    <div class="d-flex" style="gap: 12px"><img src="{{asset('images/flags/'.App\Models\Language::find($f->language_id)->short.'.svg')}}" style="width: 20px !important">język {{ App\Models\Language::find($f->language_id)->name}}</div>
                                        @foreach (App\Models\CalendarEvent::where('lesson_id',$f->id)->orderBy('start', 'desc')->take(1)->get() as $date)
                                            <div class="d-flex" style="gap: 12px"><img src="{{asset('images/svg/smallClock.svg')}}" style="width: 20px !important">{{ \Carbon\Carbon::parse($date->start)->locale('pl')->format('d')}} {{ \Carbon\Carbon::parse($date->start)->locale('pl')->shortMonthName}}. {{ \Carbon\Carbon::parse($date->start)->locale('pl')->format('Y, H:i')}}</div>
                                        @endforeach 
                                    </div>
                                    
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Oferta -->
        <div class="row justify-content-center ColRev beigeBackMobile2 AboutDiv" id="oSzkole">
            <div class="homeHeads">
                <h3 class="PinkText">OFERTA</h3>
                <h2 class="middleText" style="text-align: left !important;">Ucz się języków <br> <span class="underlinePink">i odkrywaj świat</span></h2>
            </div>
            <div style="position: relative;display: flex;  justify-content: start;" >
                <img src="{{asset('images/fotos/home1.png')}}" style="width: 100%" alt="">
                <img src="{{asset('images/svg/sparkle.svg')}}" style="position: absolute;  right: 16px;  top: -134px; width: 80px"  alt="">
            </div>
            <div class="TextDisplay">
                
                <p>
                    W jaki sposób uczysz się najefektywniej? 
                    Prowadzimy zarówno <b>zajęcia indywidualne, w parach, jak i kursy w małych grupach</b> (max. 6 osób).
                    Dzięki temu lektor poświęci Ci wystarczającą ilość czasu, abyś faktycznie wyniósł wiele z każdej lekcji. 
                </p>
                <p>
                    Formę zajęć dostosowujemy do Twojego celu. 
                    Korzystamy także z autentycznych tekstów (z prasy, wiadomości, literatury, blogów, social mediów, podcastów). 
                    Będziesz mieć na bieżąco kontakt nie tylko z wiedzą teoretyczną, ale także z codziennym językiem i często stosowanym słownictwem.
                </p>
                <a href="/priceList/search/1/1" class="LL-button LL-button-primary" style="width: 100%;">Zapisz się na kurs</a>
            </div>
        </div>
<!-- Kafelki -->
<div class="row justify-content-center ColRev AboutDiv" id="metody">
            <div class="homeHeads" style="position: relative">
                <img src="{{asset('images/svg/ribbon.svg')}}" style="position: absolute;  right: -3px;  top: -62px;  width: 100px;  -moz-transform: scale(-1,1);"  alt="">
                <h3 class="smallHeadText VioletText">NASZE PODEJŚCIE</h3>
                <h2 class="bigHeadText" style="text-align: center;">Dlaczego wybrać LangueLove</h2>
            </div>
            
        <div class="col-12 AboutBoxes">
            <div class="AboutBox">
                <img src="{{asset('images/aboutUs/bulb.svg')}}" class="" alt="">
                <h2 class="middleText" style="text-align: left">Dopasowanie</h2>
                <p>
                    Stosujemy różnorodne metody nauki, dostosowane do Twojego celu. 
                    Jesteśmy młodym zespołem, który rozumie obecne potrzeby na rynku. 
                    Wiemy, że nie każdy musi znać różnicę między zdaniami prostymi, 
                    a złożonymi, <b>by się swobodnie komunikować w języku obcym.</b>
                    Chcesz coś zmienić? Czegoś Ci brakuje? Powiedz nam o tym.
                </p>
            </div>
            <div class="AboutBox">
                <img src="{{asset('images/aboutUs/calendar.svg')}}" class="" alt="">
                <h2 class="middleText" style="text-align: left">Dostępność</h2>
                <p>
                    Ucz się, gdzie chcesz, kiedy chcesz i ile chcesz. 
                    To Ty decydujesz o liczbie i częstotliwości zajęć. 
                    Nasz <b>kalendarz</b> pomoże Ci w szybkim umawianiu się na zajęcia: sprawdź dostępność lektora i wybierz najbardziej odpowiadający Ci termin. <br>
                    Jesteś w podróży i chcesz wykorzystać ten czas? Podepnij słuchawki do telefonu i działamy!
                </p>
            </div>
            <div class="AboutBox">
                <img src="{{asset('images/aboutUs/rocket.svg')}}" class="" alt="">
                <h2 class="middleText" style="text-align: left; white-space: nowrap;">Realny efekt</h2>
                <p>
                    Każdy kurs przewiduje <b>lekcje powtórzeniowe</b>, dzięki którym możesz lepiej przyswoić materiał.
                    Bez regularności nie ma efektów, a omówienie raz zagadnienia nie sprawi, że się go nauczysz.
                    Wykorzystując elementy metody <b>gamifikacji</b>, będziesz w stanie monitorować swoje sukcesy i cieszyć się ze swoich postępów!
                
                </p>
            </div>
        </div>
    </div>
    <!-- co wybrać -->
    <div class="row justify-content-center ColRev AboutDiv purpleBackMobile">
        <div class="homeHeads">
                <h3 class="VioletText">KONTAKT</h3>
                <h2 class="middleText" style="text-align: left !important;">Nie wiesz, który kurs <span class="underlinePink">wybrać</span>?</span></h2>
            </div>
            <div style="position: relative;display: flex;  justify-content: start;" >
                <img src="{{asset('images/fotos/home2.png')}}" style="width: 100%" alt="">
            </div>
            <div class="TextDisplay">
                <p>
                Jesteśmy stale do Twojej dyspozycji. Możesz się z nami skontaktować poprzez social media, 
                    e-mailowo lub telefonicznie. Porozmawiamy o Twoich oczekiwaniach, 
                    umiejętnościach językowych i wskażemy, który kurs będzie dla Ciebie najlepszy.
                </p>
                <a href="{{ route('contact') }}" class="LL-button LL-button-primary2" style="width: 100%;">Skontaktuj się z nami</a>
            </div>

    </div>
<!-- Zespół -->

    <div class="row justify-content-center"  style="position: relative;  margin-top: 72px;">
        <img src="{{asset('images/svg/korona3.svg')}}" style="position: absolute;  right: 20px;  width: 107px; top: -100px; "  alt="">
        <div class="row justify-content-center">
            <div class="homeHeads" style="margin-bottom: 54px">
                <h3 class="VioletText" style="color: #6D6D6D;font-size: 12px;font-weight: 500;">NASI PROWADZĄCY</h3>
                <h2>Poznaj naszych lektorów</h2>
                <div id="arrows" style="margin-top: -55px;"></div>
            </div>
            
            <div class="owl-carousel" id="carousel2">
                @foreach (App\Models\Lector::where('active',1)->where('id','!=',18)->get() as $lector)
                <a class="card-link" href="{{ route('showLector',$lector->id) }}">
                    <div class="card lectorCardNew" style="height: 438px;">
                        <div><img src='/images/lectors/{{$lector->photo}}' style="width: 220px !important"></div>
                        <div><h4 class="text-center" style="font-size: 32px"><b>{{$lector->name}}</b></h4></div>   
                        <div class="carouselFlags">
                            @foreach (App\Models\LanguageLevel::where('lector_id',$lector->id)->distinct('language_id')->pluck('language_id') as $d)
                                    <div class="d-flex" style="gap: 12px"><img src="{{asset('images/flags/'.App\Models\Language::find($d)->short.'.svg')}}" style="width: 20px !important">Język {{ App\Models\Language::find($d)->name}}</div>
                            @endforeach
                        </div>
                    </div>
                </a>

                @endforeach
            </div>
        </div>
    </div>

    <!-- opinie -->
    <div class="row justify-content-center ColRev AboutDiv PurpleBack2" style="position: relative">
            <div class="homeHeads">
                <h3 class="VioletText">OPINIE</h3>
                <h2>Sprawdź co mówią o nas studenci</h2>
            </div>
            <div class="owl-carousel" id="carousel5">
                <div class="opiniaDiv">
                    <div>
                        <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                    </div>
                    <div>
                        <p>
                            Już od kilku miesięcy uczę się włoskiego z Wiktorią. 
                            Jestem bardzo zadowolona ze sposobu prowadzenia lekcji. 
                            Zajęcia nie są monotonne, Wiktoria często robi lekcje tematyczne, 
                            a materiały są estetycznie przygotowahne i przede wszystkim dużo
                            mówimy po włosku! Oczywiście to wszystko odbywa się w bardzo miłej
                            i przyjaznej atmosferze, bez żadnego stresu. 
                            Dla mnie efekty są zadowalające, bo z każdym kolejnym wyjazdem 
                            do Włoch co raz częściej używam tego języka zamiast angielskiego. 
                        </p>
                    </div>
                    <div style="font-weight: 600;">Natalia</div>
                </div>
                <div class="opiniaDiv">
                    <div>
                        <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                    </div>
                    <div>
                        <p>
                            Bardzo polecam, Weronika jest świetną nauczycielką. 
                            Lekcje nie są nudne, a wręcz przeciwnie, fajne podejście i luźna atmosfera.
                        </p>
                    </div>
                    <div style="font-weight: 600;">Konrad</div>
                </div>
                <div class="opiniaDiv">
                    <div>
                        <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                    </div>
                    <div>
                        <p>
                        Jestem totalnie zadowolona. 😄
                        Szkoła była moim wybawieniem. Po pierwsze właścicielki - wyrozumiałe i zawsze skore do pomocy. 
                        Tryska od nich energia i aż chce się uczyć, dlatego moja motywacja nie maleje. 
                        Po drugie szkoła uczy aż 0 języków, co rzadko się zdarza. Mogę się tutaj uczyć kilku języków.
                        Obecnie uczę się angielskiego, czuję, że te zajęcia to prawdziwy challenge. 
                        Totalnie dopasowane do moich potrzeb. Sporo się uczę i z zajęć na zajęcia podnoszę swó poziom. 
                        A taki właśnie był mój cel! Po trzecie social media, które są skarbnicą wiedzy, 
                        inspiracji i humoru na temat nauki języków. Polecam LangueLove wszystkim! 💜
                        </p>
                    </div>
                    <div style="font-weight: 600;">Wiktoria</div>
                </div>
                <div class="opiniaDiv">
                    <div>
                        <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                    </div>
                    <div>
                        <p>
                        Moja przyjaciółka znalazła Wiktorię na Instagramie i od tego zaczęła się wspólna przygoda - 
                        chciałyśmy odświeżyć podstawy i kontynuować naukę. Odbywa się to w przesympatycznej atmosferze,
                        a w tym samym czasie niesamowicie profesjonalnie - każda lekcja jest w pełni przygotowana i przemyślana. 
                        Dziękuję za wszystko i czekam na więcej! Grazie!
                        </p>
                    </div>
                    <div style="font-weight: 600;">Ola</div>
                </div>
                <div class="opiniaDiv">
                    <div>
                        <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                    </div>
                    <div>
                        <p>
                        I started learning Polish with LangueLove and so far so good! Highly recommended.
                        </p>
                    </div>
                    <div style="font-weight: 600;">Furkan</div>
                </div>
                <div class="opiniaDiv">
                    <div>
                        <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                    </div>
                    <div>
                        <p>
                        The best school and teacher ever had. All Perfect. 
                        Lessons are always interested and fully personalised. 
                        Amazing atmosphere throughout the time of lessons and (what’s most important) the real language skills improvement. 
                        I do recommend to everybody!
                        </p>
                    </div>
                    <div style="font-weight: 600;">Alicja</div>
                </div>
                <div class="opiniaDiv">
                    <div>
                        <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                    </div>
                    <div>
                        <p>
                        I strongly reccomend the school as it distinguish itself by adapting classes to personal interests, 
                        a lot of time dedicated for conversations, unconventional excercises. Last but not least, stuff is really friendly and supportive 
                        </p>
                    </div>
                    <div style="font-weight: 600;">Rafał</div>
                </div>
                <div class="opiniaDiv">
                    <div>
                        <img src="{{asset('images/svg/akapit.svg')}}" class="" alt="">
                    </div>
                    <div>
                        <p>
                        Bardzo polecam tę szkołę językową. Uczę się języka włoskiego. Zajęcia mam z lektorką Adą - lekcje z nią to sama przyjemność. 
                        Jest bardzo kompetentna i potrafi bardzo dobrze wytłumaczyć gramatykę. 
                        Jeśli ktoś już próbował różnych sposobów nauki języka włoskiego, to tutaj się nie zawiedzie. Serdecznie polecam :)
                        </p>
                    </div>
                    <div style="font-weight: 600;">Sylwia</div>
                </div>
                <!--  -->
            </div>
            <img src="{{asset('images/svg/paperplane.svg')}}" style="position: absolute;  left: -133px;  width: 400px; bottom: 120px"  alt="">
            </div>
        </div>

       
    </div>

  
</div>
    
</div>


@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
<script src="{{ asset('js/owlCarousel/owl.carousel.min.js') }}" defer></script>

<script>
    let ScreenType = 'D';
document.addEventListener('DOMContentLoaded', function () {
            var backToTopButton = document.getElementById('back-to-top-btn');

            // Show or hide the button based on scroll position
            window.addEventListener('scroll', function () {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    backToTopButton.style.display = 'flex';
                } else {
                    backToTopButton.style.display = 'none';
                }
            });

            // Scroll to the top when the button is clicked
            backToTopButton.addEventListener('click', function () {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            });
        });
    $(document).ready(function () {
        
                $(document).ready(function(){
            $("#carousel1").owlCarousel({
                loop:true,
                margin:10,
                center:true,
                nav:true,
                navText:[`<div class="carouselArrow"> <img src="{{asset('images/svg/AArrowL.svg')}}" width="10px"  alt=""></div>`,`<div class="carouselArrow"> <img src="{{asset('images/svg/AArrowR.svg')}}" width="10px"  alt=""></div>`],
                navContainer: document.getElementById('arrows'),
                autoplay: true,
                autoplayTimeout: 5000,
                responsive:{
                    0:{
                        items:1
                    },
                    800:{
                        items:2
                    },
                    1200:{
                        items:3
                    },
                    1600:{
                        items:4
                    },
                    2000:{
                        items:5
                    }
                }
            });
            $("#carousel2").owlCarousel({
                loop:true,
                margin:10,
                center:true,
                // nav:true,
                // navText:[`<div class="carouselArrow"> <img src="{{asset('images/svg/AArrowL.svg')}}" width="10px"  alt=""></div>`,`<div class="carouselArrow"> <img src="{{asset('images/svg/AArrowR.svg')}}" width="10px"  alt=""></div>`],
                // navContainer: document.getElementById('arrows'),
                autoplay: true,
                autoplayTimeout: 5000,
                responsive:{
                    0:{
                        items:1
                    },
                    1100:{
                        items:2
                    },
                    1600:{
                        items:2
                    },
                    1800:{
                        items:3
                    }
                }
            });
            $("#carousel3").owlCarousel({
                loop:true,
                margin:10,
                center:true,
                // nav:true,
                // navText:[`<div class="carouselArrow"> <img src="{{asset('images/svg/AArrowL.svg')}}" width="10px"  alt=""></div>`,`<div class="carouselArrow"> <img src="{{asset('images/svg/AArrowR.svg')}}" width="10px"  alt=""></div>`],
                // navContainer: document.getElementById('arrows'),
                autoplay: true,
                autoplayTimeout: 5000,
                responsive:{
                    0:{
                        items:1
                    },
                    1100:{
                        items:1
                    },
                    1600:{
                        items:2
                    },
                    1800:{
                        items:3
                    }
                }
            });
            $("#carousel5").owlCarousel({
                loop:true,
                margin:10,
                center:true,
                // nav:true,
                // navText:[`<div class="carouselArrow"> <img src="{{asset('images/svg/AArrowL.svg')}}" width="10px"  alt=""></div>`,`<div class="carouselArrow"> <img src="{{asset('images/svg/AArrowR.svg')}}" width="10px"  alt=""></div>`],
                // navContainer: document.getElementById('arrows'),
                autoplay: true,
                autoplayTimeout: 5000,
                responsive:{
                    0:{
                        items:1
                    },
                    1100:{
                        items:1
                    },
                    1600:{
                        items:2
                    },
                    1800:{
                        items:3
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
                id='lang0'+ScreenType;
                class1 = 'langInp';
                text = 'langText'+ScreenType;
            }
            if(type == 2){
                id='type0'+ScreenType;
                class1 = 'typeInp';
                text = 'typeText'+ScreenType;
            }
            console.log(id);
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