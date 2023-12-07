@extends('layouts.app')
<style>
  
img{
    border-radius: 15px;
}
.secondaryDIV{
    display: flex;
    flex-direction: column;
    justify-content: center;
}
h2{
    text-align: center !important;
    font-weight: bold !important;
    margin-bottom: 16px !important;
}
.TwoSide{
    max-width: 45% !important;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 30px;
    min-width: 300px;
}
.WhiteBack{
    background-color: white;
    border-radius: 15px;
    padding: 50px !important;
}
.classic{
    justify-content: center;
}

@media (max-width:800px) { 
    p{
        font-size: 15px;
    }
    .secondaryDIV{
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 100% !important;
    }
    .primaryDIV{
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 100% !important;
    }
    .classicCont{
        padding: 0 !important;
    }
    .classic{
        justify-content: unset;
    }
    .TwoSide{
        max-width: 100% !important;
        max-width: 800px;
    }
    .ColRev{
        flex-flow: column-reverse;
    }
    
}
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet"> 

<link href="{{ asset('css/owlCarousel/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/owlCarousel/owl.theme.default.min.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row  classicCont">
        <div class="AboutUsHead" style = 'padding-top:60px'>
            <h3 class="smallHeadText">O nas</h3>
            <h2 class="bigHeadText">Poznajmy się!</h2>
            <div>
                <p class="TextCenterAbout">
                    LangueLove to szkoła języków obcych online. 
                    Nazwa naszej szkoły została zainspirowana francuskim słowem “langue”, czyli język (wymawianego jako «lɑ̃ɡ»)
                    i jego połączeniem z “love” (ang. miłość).
                    Wierzymy, że połączy nas <b>miłość i pasja do języków</b>, która okaże się być “long love”.
                </p>
            </div>
        </div>
    </div>
    <div class="MiniMenu">
        <div>O szkole</div>
        <div>Metody nauczania</div>
        <div>Założycielki</div>
    </div>
    <div class="row justify-content-center ColRev BeigeBack AboutDiv">
        <div class="col-2"></div>
        <div class="col-10">
            <h3 class="smallHeadText">Co nas wyróżnia</h3>
            <h2 class="bigHeadText">O szkole</h2>
        </div>
        <div  class="col-2"></div>
        <div class="col-5">
                <h2 class="middleText">Dlaczego warto nas wybrać?</h2>
                <p>
                    Prowadzimy kursy językowe indywidualne i grupowe oraz webinaria tematyczne. W naszej szkole
                    językowej online znajdą Państwo kursy 10 języków obcych.<br></br>
                    Mocno wierzymy, że nauka języka jest inwestycją w przyszłość i drogą do odkrywania świata, 
                    a także poszerzania horyzontów.<br><br>
                    Nasze indywidualne i grupowe kursy językowe opierają się na autorskich programach nauki,
                    dzięki czemu mają Państwo pewność, że inwestycja przynosi efekty i jest spersonalizowana.
                </p>
        </div>
        <div class="col-1"></div>
        <div class="col-4">
            <img src="{{asset('images/aboutUs/WW1.png')}}" class="Fotos"  alt="">
        </div>
    </div>
    <div class="row justify-content-center ColRev AboutDiv">
        <div  class="col-2"></div>
        <div class="col-4">
            <img src="{{asset('images/aboutUs/PK.png')}}" class="Fotos"  alt="">
        </div>
        <div class="col-1"></div>
        <div class="col-5">
            <h2 class="middleText">Jak wyglądają zajęcia?</h2>
            <p>
                Zajęcia trwają <b>60 minut</b> lub <b>90 minut.</b> 
                Prowadzimy je za pośrednictwem komunikatora Skype. 
                Nie musisz kupować podręczników, wszystkie materiały otrzymasz online od swojego lektora. 
                Do każdych zajęć otrzymasz także notatki na dysku.<br><br>
                <b>Regularność zdecydowanie wspiera naukę języka obcego!</b>
                Pierwsze zajęcia rozpoczynamy krótką rozmową: jakie są Twoje oczekiwania odnośnie zajęć,
                    co chcesz osiągnąć, w jaki sposób najskuteczniej się uczysz, z czym masz największy problem? 
                    To pozwoli lektorowi dobrać odpowiednie materiały i zadania. 
            </p>
        </div>
    </div>
    <div class="row justify-content-center ColRev AboutDiv BeigeBack2">
        <div  class="col-2"></div>
          <div class="col-5">
            <h2 class="middleText">Dlaczego my?</h2>
            <p>
                Na zajęciach nauczymy Cię nie tylko języka, ale również
                opowiemy o <b>historii i tradycji</b> danego kraju. 
                Nasze kursy są oparte na praktycznych ćwiczeniach, wykonywanych w przyjaznej atmosferze,
                przez co poczujesz się swobodnie w mówieniu już od pierwszych zajęć.<br><br>
                Stawiamy na nowoczesność i rozwój. 
                Poza podręcznikiem <br>wykorzystujemy wszystkie dostępne zasoby internetu,</br>
                takie jak prezentacje multimedialne, filmy, artykuły, gry, podcasty, social media, 
                pracę w grupach i inne. 
                Wprowadzamy nowoczesne metody oparte na badaniach neurolingwistycznych i językoznawczych, 
                takie jak gamifikacja.
            </p>
        </div>
        <div class="col-1"></div>
        <div class="col-4">
            <img src="{{asset('images/aboutUs/WW2.png')}}" class="Fotos"  alt="">
        </div>
    </div>
    <div class="row justify-content-center ColRev AboutDiv">
        <div  class="col-12">Zespół</div>
        <div  class="col-2"></div>
        <div class="col-10">
        <div class="row justify-content-center pt-5 pb-5  mt-3 mb-3">
        <div>
            <h6 class="text-center smallText">NASI PROWADZĄCY</h6>
        </div>
        <div class="mb-2">
            <h2 class="text-center">Poznaj naszych prowadzących</h2>
        </div>
        <div id="arrows"></div>
        <div class="owl-carousel" id="carousel1">
        @foreach (App\Models\Lector::where('active',1)->get() as $lector)
            <div class="card lectorCardNew">
                <div class="LectorPhotoCard" 
                style="background: url('/images/lectors/{{$lector->photo}}');
                    background-position: center;
                    background-size: 220px;
                    background-repeat: no-repeat;"></div>
                <div style="margin: 24px 0px;"><h4 class="text-center"><b>{{$lector->name}}</b></h4></div>   
                <div style="padding-left: 18px;">
                    @foreach (App\Models\LanguageLevel::where('lector_id',$lector->id)->distinct('language_id')->pluck('language_id') as $d)
                            <span><i class="flag flag-{{ App\Models\Language::find($d)->short}}"></i>Język {{ App\Models\Language::find($d)->name}}</span><br>
                    @endforeach
                </div>  
                <div class="CardButton">
                    <a href="{{ route('showLector',$lector->id) }}">Poznaj &#8594;</a>
                </div> 
            </div>

        @endforeach
        </div>
    </div>
        </div>
        
    </div>
    <div class="row justify-content-center ColRev AboutDiv PurpleBack">
        <div class="col-2"></div>
        <div class="col-10">
            <h3 class="smallHeadText">Jak uczymy?</h3>
            <h2 class="bigHeadText">Metody nauczania</h2>
        </div>
        <div class="col-2"></div>
        <div class="col-10">
            <p>
                Stosujemy różnorodne metody nauki, dostosowane do Twojego celu. 
                Jesteśmy młodym zespołem, który rozumie obecne potrzeby na rynku. 
                Wiemy, że nie każdy musi znać różnicę między zdaniami prostymi, a złożonymi, 
                by się swobodnie komunikować w języku obcym. Jednocześnie kładziemy nacisk na dobór naszych lektorek, 
                które bez problemu przygotują Cię nawet do najtrudniejszego egzaminu! Dbamy o pozytywną i luźną atmosferę,
                by każdy czuł się swobodnie i lubił uczęszczać na zajęcia. Chcesz coś zmienić? 
                Czegoś Ci brakuje? Powiedz nam o tym. Z nami każdy cel jest do osiągnięcia!
            </p>
        </div>
        <div  class="col-2"></div>
        <div class="col-10 AboutBoxes">
            <div class="AboutBox">
                <h2 class="middleText" style="text-align: left">Praktyka (czyni mistrza)</h2>
                <p>
                    Uczymy swobodnego i skutecznego komunikowania się w rzeczywistych sytuacjach. 
                    Stawiamy na aktywne uczestnictwo w zajęciach!
                </p>
            </div>
            <div class="AboutBox">
                <h2 class="middleText" style="text-align: left">Różnorodne materiały</h2>
                <p>
                    Efektywnej nauce sprzyjają różnorodne i kreatywne materiały. 
                    Nie musisz martwić się o zakup drogich książek - materiały na lekcje przygotowujemy same!
                </p>
            </div>
            <div class="AboutBox">
                <h2 class="middleText" style="text-align: left">Całkowite zanurzenie</h2>
                <p>
                    Prowadzimy lekcje już od początkujących poziomów w języku docelowym. 
                    Polecimy Ci filmy, podcasty czy książki, abyś miał(a) stały kontakt z językiem!
                </p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center ColRev AboutDiv">
        <div class="col-2"></div>
        <div class="col-10" style="margin-bottom: 72px">
            <h3 class="smallHeadText">JAK TO SIĘ ZACZĘŁO</h3>
            <h2 class="bigHeadText">Założycielki</h2>
        </div>
        <div class="col-2"></div>
        <div class="col-10"  style="margin-bottom: 72px">
            <p>
            Cześć! Z tej strony <b>Wiktoria</b> i <b>Weronika</b>. Jesteśmy dwiema italianistkami z Krakowa. 
            Nasza długoletnia przyjaźń i wspólna miłość do języków zaprowadziła nas do założenia LangueLove! 
            Wspólnie przeszłyśmy przez wszystkie etapy zdobycia dyplomu filologa na Uniwersytecie Jagiellońskim i zwiedziłyśmy razem wiele zakątków Europy.
            </p>
        </div>
        <div class="col-2"></div>
        <div class="col-10 OwnerDesc">
            <div class="OwnerInfo">
                <img src="{{asset('images/aboutUs/WeronikaKolo.png')}}" width="174px" alt="Weronika">
                <div>
                    <div><h2 class="middleText" style="text-align: left !important">Weronika</h2></div>
                    <div class="PinkText">lektorka języka włoskiego i angielskiego | założycielka szkoły</div>
                </div>
            </div>
           <p>
            Swoją pierwszą styczność z obcą kulturą i językiem miałam w dzieciństwie, 
            gdy wyjechałam na kilka lat do Włoch. Już wtedy zrozumiałam, 
            jak kluczowa jest znajomość języka i jak wiele może nam dać, 
            od przyjaźni po możliwość podróżowania. <br><br>
            Później pojawiła się pasja do angielskiego - języka, 
            którym posługuje się dzisiaj prawie każda osoba na świecie, języka, 
            który przełamuje bariery i otwiera nas na drugiego człowieka.<br><br>
            Zaciekawienie językami zaprowadziło mnie na studia filologiczne, a potem przekładoznawcze. 
            Natomiast świadomość roli języka obcego w życiu sprawiła, że od kilku lat uczę innych, 
            zarówno na lekcjach indywidualnych, jak i grupowych. <br><br>
            Wciąż sama też jestem uczennicą, obecnie odkrywam zawiłości i piękno języka tureckiego. 
            Dzięki temu nigdy nie zapominam o perspektywie kursanta i jego potrzebach.
           </p>
        </div>
        <div  class="col-2"></div>
        <div class="col-10 OwnerDesc">
            <div class="OwnerInfo">
                <img src="{{asset('images/aboutUs/WiktoriaKolo.png')}}" width="174px" alt="Wiktoria">
                <div>
                    <div><h2 class="middleText" style="text-align: left !important">Weronika</h2></div>
                    <div class="VioletText">lektorka języka włoskiego i angielskiego | założycielka szkoły</div>
                </div>
            </div>
           <p>
            Moje imię we wszystkich językach romańskich oznacza <b>zwycięstwo</b>. 
            Uczę (prze)zwyciężać trudności związane z nauką języka obcego.<br><br>
            Moja przygoda z nauką języków zaczęła się gdy miałam 14 lat, 
            kiedy zupełnie przez przypadek trafiłam na wymianę uczniowską do włoskiej rodziny 
            niedaleko Neapolu. Tam przeżyłam swój pierwszy szok kulturowy i zrozumiałam, 
            jak ważnym aspektem w nauce języków jest zrozumienie społeczeństwa i kultury danego kraju.<br><br> 
            Swoje magisterium, jak i licencjat ukończyłam na Uniwersytecie Jagiellońskim. 
            Od kilku lat prowadzę zajęcia z włoskiego, portugalskiego i polskiego jako obcego.<br><br>
            Oprócz tego interesuję się językoznawstwem i psychologią, a w szczególności psycholingwistyką, 
            czyli tym jak my wpływamy na język i jak język wpływa na nasze postrzeganie świata. 
            Sama uczę się chińskiego, co pozwala mi na lepsze zrozumienie ucznia i dostosowanie się do 
            jego potrzeb.
           </p>
        </div>
    </div>
    </div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
                        items:3
                    }
                }
            });
           
        });

    })

</script>