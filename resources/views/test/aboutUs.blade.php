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
a:active {
        font-weight: bold;     }
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
<div class="container desktop">
    <div class="row  classicCont" style="margin-bottom: 60px;">
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
            <img src="{{asset('images/aboutUs/serduszka.svg')}}" class="Onas_serduszko"  alt="">
        </div>
    </div>
    <div class="MiniMenu">
        <a style="color: black" href="#oSzkole">O szkole</a>
        <a style="color: black" href="#metody">Metody nauczania</a>
        <a style="color: black" href="#zalozycielki">Założycielki</a>
    </div>
    <div class="row justify-content-center ColRev BeigeBack AboutDiv" id="oSzkole">
        <div class="col-2"></div>
        <div class="col-10">
            <h3 class="smallHeadText">Co nas wyróżnia</h3>
            <h2 class="bigHeadText">O szkole</h2>
        </div>
        <div  class="col-2"></div>
        <div class="col-5 TextDisplay">
                <h2 class="middleText" style="text-align: left !important;">Dlaczego warto nas wybrać?</h2>
                <p>
                    Prowadzimy kursy językowe indywidualne i grupowe oraz webinaria tematyczne. W naszej szkole
                    językowej online znajdziesz kursy z wielu języków obcych.<br></br>
                    Mocno wierzymy, że nauka języka jest inwestycją w przyszłość i drogą do odkrywania świata, 
                    a także poszerzania horyzontów.<br><br>
                    Nasze indywidualne i grupowe kursy językowe opierają się na autorskich programach nauki,
                    dzięki czemu masz pewność, że inwestycja przynosi efekty i jest spersonalizowana.
                </p>
                <a href="/priceList/search/1/1" class="LL-button LL-button-primary2" style="width: fit-content;">Zobacz naszą ofertę</a>
        </div>
        <div class="col-1"></div>
        <div class="col-4" style="position: relative;display: flex;  justify-content: end;" >
            <img src="{{asset('images/aboutUs/WW1.png')}}" class="FotosAbout" alt="">
            <img src="{{asset('images/aboutUs/zawijas.svg')}}" style="height: 184px;  position: absolute;  right: -120px;  bottom: -185px;"  alt="">
        </div>

    </div>
    <div class="row justify-content-center ColRev AboutDiv">
        <div  class="col-2"></div>
        <div class="col-4">
            <img src="{{asset('images/aboutUs/PK.png')}}" class="FotosAbout"  alt="">
        </div>
        <div class="col-1"></div>
        <div class="col-5 TextDisplay">
            <h2 class="middleText">Jak wyglądają zajęcia?</h2>
            <p>
                Zajęcia trwają <b>55 minut</b> lub <b>85 minut.</b> 
                Prowadzimy je za pośrednictwem komunikatora Skype. 
                Nie musisz kupować podręczników, wszystkie materiały otrzymasz online od swojego lektora. 
                Do każdych zajęć otrzymasz także notatki na dysku.<br><br>
                <b>Regularność zdecydowanie wspiera naukę języka obcego!</b>
                Pierwsze zajęcia rozpoczynamy krótką rozmową: jakie są Twoje oczekiwania odnośnie zajęć,
                    co chcesz osiągnąć, w jaki sposób najskuteczniej się uczysz, z czym masz największy problem? 
                    To pozwoli lektorowi dobrać odpowiednie materiały i zadania. 
            </p>
            <a href="/consultation" class="LL-button LL-button-primary" style="width: fit-content;">Napisz do nas</a>
        </div>
    </div>
    <div class="row justify-content-center ColRev AboutDiv BeigeBack2">
        <div  class="col-2">
            <img src="{{asset('images/aboutUs/korona.svg')}}" style="height: 240px;  position: relative;  left: -132px;  top: -128px;"  alt="">
        </div>
          <div class="col-5 TextDisplay">
            <h2 class="middleText">Dlaczego my?</h2>
            <p>
                Na zajęciach nauczymy Cię nie tylko języka, ale również
                opowiemy o <b>historii i tradycji</b> danego kraju. 
                Nasze kursy są oparte na praktycznych ćwiczeniach, wykonywanych w przyjaznej atmosferze,
                przez co poczujesz się swobodnie w mówieniu już od pierwszych zajęć.<br><br>
                Stawiamy na nowoczesność i rozwój. 
                Poza podręcznikiem wykorzystujemy wszystkie dostępne zasoby internetu,
                takie jak prezentacje multimedialne, filmy, artykuły, gry, podcasty, social media, 
                pracę w grupach i inne. 
                Wprowadzamy nowoczesne metody oparte na badaniach neurolingwistycznych i językoznawczych, 
                takie jak gamifikacja.
            </p>
            <a href="/priceList/search/1/1" class="LL-button LL-button-primary2" style="width: fit-content;">Zapisz się na zajęcia</a>
        </div>
        <div class="col-1"></div>
        <div class="col-4" style="display: flex;  justify-content: end;">
            <img src="{{asset('images/aboutUs/WW2.png')}}" class="FotosAbout"  alt="">
        </div>
    </div>

    <div class="row justify-content-center ColRev AboutDiv">
        <div  class="col-2">    
        </div>
        <div class="col-10" style="position: relative">
        <img src="{{asset('images/aboutUs/gwiazdka.svg')}}" style="height: 200px;  position: absolute;  right: 40px;  top: -183px;"  alt="">
        <div class="row justify-content-center">
        <div class="mb-2">
            <h2 class="text-center">Zespół</h2>
        </div>
        <div id="arrows"></div>
        <div class="owl-carousel" id="carousel1">
        @foreach (App\Models\Lector::where('active',1)->get() as $lector)
            <div class="card lectorCardNew">
                <div><img src='/images/lectors/{{$lector->photo}}' style="width: 220px !important"></div>
                <div><h4 class="text-center" style="font-size: 32px"><b>{{$lector->name}}</b></h4></div>   
                <div class="carouselFlags">
                    @foreach (App\Models\LanguageLevel::where('lector_id',$lector->id)->distinct('language_id')->pluck('language_id') as $d)
                            <div class="d-flex" style="gap: 12px"><img src="{{asset('images/flags/'.App\Models\Language::find($d)->short.'.svg')}}" style="width: 20px !important">Język {{ App\Models\Language::find($d)->name}}</div>
                    @endforeach
                </div>  
                <div class="CarouselButton">
                    <a href="{{ route('showLector',$lector->id) }}">Poznaj 
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
                            <path d="M8.83922 11.161C8.69541 11.161 8.5516 11.108 8.43806 10.9945C8.21856 10.775 8.21856 10.4117 8.43806 10.1922L12.6313 5.99899L8.43806 1.8058C8.21856 1.5863 8.21856 1.22299 8.43806 1.00349C8.65756 0.783992 9.02087 0.783992 9.24037 1.00349L13.8347 5.59784C14.0542 5.81734 14.0542 6.18064 13.8347 6.40015L9.24037 10.9945C9.12684 11.108 8.98303 11.161 8.83922 11.161Z" fill="#3C0079"/>
                            <path d="M13.3062 6.5665H0.567672C0.257345 6.5665 0 6.30915 0 5.99882C0 5.6885 0.257345 5.43115 0.567672 5.43115H13.3062C13.6166 5.43115 13.8739 5.6885 13.8739 5.99882C13.8739 6.30915 13.6166 6.5665 13.3062 6.5665Z" fill="#3C0079"/>
                        </svg>
                    </a>
                </div> 
            </div>

        @endforeach
        </div>

    </div> 
    <img src="{{asset('images/aboutUs/serduszka3.svg')}}" style="height: 171px;
  position: absolute;
  left: -96px;
  bottom: -52px;"  alt="">

        </div>
        
    </div>
    <div class="row justify-content-center ColRev AboutDiv PurpleBack" id="metody">
        <div class="col-2"></div>
        <div class="col-10">
            <h3 class="smallHeadText PinkText">Jak uczymy?</h3>
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
        <div class="col-2"></div>
        <div class="col-10">
        <a href="/consultation" class="LL-button LL-button-primary" style="width: fit-content; margin: 48px auto">Skorzystaj z darmowej konsultacji</a>
        </div>
    </div>
    <div class="row justify-content-center ColRev AboutDiv" id="zalozycielki">
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
                    <div><h2 class="middleText" style="text-align: left !important">Wiktoria</h2></div>
                    <div class="VioletText">lektorka języka włoskiego i portugalskiego | założycielka szkoły</div>
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

<!-- wersja mobile -->
<div class="container mobile">
    <div class="row  classicCont">
        <div class="AboutUsHead" style = 'padding: 16px;'>
            <h3 class="smallHeadText" style="text-align: center !important;">O nas</h3>
            <h2 class="bigHeadText" style="text-align: center !important;">Poznajmy się!</h2>
            <div>
                <p class="TextCenterAbout">
                    LangueLove to szkoła języków obcych online. 
                    Nazwa naszej szkoły została zainspirowana francuskim słowem “langue”, czyli język (wymawianego jako «lɑ̃ɡ»)
                    i jego połączeniem z “love” (ang. miłość).
                    Wierzymy, że połączy nas <b>miłość i pasja do języków</b>, która okaże się być “long love”.
                </p>
            </div>
            <img src="{{asset('images/aboutUs/serduszka.svg')}}" style="width: 137.619px;  height: 177.399px ;position: absolute;  right: 31px;"  alt="">
        </div>
    </div>
    <div class="row justify-content-center beigeBackMobile AboutDiv" id="oSzkole">
        <div style="margin-top: 31px;margin-bottom: -20px;">
            <h3 class="smallHeadText">Co nas wyróżnia</h3>
            <h2 class="bigHeadText">O szkole</h2>
        </div>
        <div>
            <h2 class="middleText">Dlaczego warto nas wybrać?</h2>
        </div>
         <div style="position: relative">
            <img src="{{asset('images/aboutUs/WW1.png')}}" class="FotosAbout" alt="">
        </div>
        <div>
                <p>
                    Prowadzimy kursy językowe indywidualne i grupowe oraz webinaria tematyczne. W naszej szkole
                    językowej online znajdziesz kursy z wielu języków obcych.<br></br>
                    Mocno wierzymy, że nauka języka jest inwestycją w przyszłość i drogą do odkrywania świata, 
                    a także poszerzania horyzontów.<br><br>
                    Nasze indywidualne i grupowe kursy językowe opierają się na autorskich programach nauki,
                    dzięki czemu masz pewność, że inwestycja przynosi efekty i jest spersonalizowana.
                </p>
        </div>
        <div>
            <a href="/priceList/search/1/1" class="LL-button LL-button-primary2" style="width: 100%;">Zobacz naszą ofertę</a>
        </div>
    </div>
    <div class="row justify-content-center AboutDiv" style="position: relative">
        <img src="{{asset('images/aboutUs/zawijas.svg')}}" style="position: absolute;  right: 0;  top: -45px;  width: 129.179px;  height: 100px;"  alt="">
        <div><h2 class="middleText">Jak wyglądają zajęcia?</h2></div>
        <div>
            <img src="{{asset('images/aboutUs/PK.png')}}" class="FotosAbout"  alt="">
        </div>
        <div>
            <p>
                Zajęcia trwają <b>55 minut</b> lub <b>85 minut.</b> 
                Prowadzimy je za pośrednictwem komunikatora Skype. 
                Nie musisz kupować podręczników, wszystkie materiały otrzymasz online od swojego lektora. 
                Do każdych zajęć otrzymasz także notatki na dysku.<br><br>
                <b>Regularność zdecydowanie wspiera naukę języka obcego!</b>
                Pierwsze zajęcia rozpoczynamy krótką rozmową: jakie są Twoje oczekiwania odnośnie zajęć,
                    co chcesz osiągnąć, w jaki sposób najskuteczniej się uczysz, z czym masz największy problem? 
                    To pozwoli lektorowi dobrać odpowiednie materiały i zadania. 
            </p>
        </div>
        <div><a href="/consultation" class="LL-button LL-button-primary" style="width: 100%">Napisz do nas</a></div>
    </div>
    <div class="row justify-content-center AboutDiv beigeBackMobile2"  style="position: relative">
        <img src="{{asset('images/aboutUs/korona2.svg')}}" style="position: absolute;  right: -128px;  height: 120px;  top: -40px;"  alt="">
        <div>
            <h2 class="middleText">Dlaczego my?</h2>
        </div>
        <div>
            <img src="{{asset('images/aboutUs/WW2.png')}}" class="FotosAbout"  alt="">
        </div>
        <div>
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
        <div>
            <a href="/priceList/search/1/1" class="LL-button LL-button-primary2" style="width: 100%;">Zapisz się na zajęcia</a>
        </div>
    </div>

    <div class="row justify-content-center AboutDiv"  style="position: relative">

        <img src="{{asset('images/aboutUs/gwiazdka.svg')}}" style="position: absolute;  right: 40px;  width: 95.284px; top: -17px;  height: 100px;"  alt="">
        <div class="row justify-content-center">
            <div>
                <h2 style="text-align: left !important;">Zespół</h2>
            </div>
            <div id="arrows"></div>
        <div class="owl-carousel" id="carousel2">
            @foreach (App\Models\Lector::where('active',1)->where('id','!=',18)->get() as $lector)
                <div class="card lectorCardNew">
                    <div><img src='/images/lectors/{{$lector->photo}}' style="width: 220px !important"></div>
                    <div><h4 class="text-center" style="font-size: 32px"><b>{{$lector->name}}</b></h4></div>   
                    <div class="carouselFlags">
                        @foreach (App\Models\LanguageLevel::where('lector_id',$lector->id)->distinct('language_id')->pluck('language_id') as $d)
                                <div class="d-flex" style="gap: 12px"><img src="{{asset('images/flags/'.App\Models\Language::find($d)->short.'.svg')}}" style="width: 20px !important">Język {{ App\Models\Language::find($d)->name}}</div>
                        @endforeach
                    </div>  
                    <div class="CarouselButton">
                        <a href="{{ route('showLector',$lector->id) }}">Poznaj &#8594;</a>
                    </div> 
                </div>

            @endforeach
        </div>

    <!-- <img src="{{asset('images/aboutUs/serduszka3.svg')}}" style="height: 171px;  position: absolute;  left: -96px;bottom: -52px;"   alt="">-->
 </div>
        
    </div>
    <div class="row justify-content-center AboutDiv purpleBackMobile" id="metody">

        <div>
            <h3 class="smallHeadText">Jak uczymy?</h3>
            <h2 class="bigHeadText">Metody nauczania</h2>
        </div>
        <div class=" AboutBoxes">
            <div class="AboutBox">
                <!-- <div> <img src="{{asset('images/aboutUs/bulb.svg')}}" width="80px" alt="Bulb"></div> -->
                <h2 class="middleText" style="text-align: left">Praktyka<br> (czyni mistrza)</h2>
                
                <p>
                    Uczymy swobodnego i skutecznego komunikowania się w rzeczywistych sytuacjach. 
                    Stawiamy na aktywne uczestnictwo w zajęciach!
                </p>
            </div>
            <div class="AboutBox">
                <!-- <div> <img src="{{asset('images/aboutUs/calendar.svg')}}" width="80px" alt="Bulb"></div> -->
                <h2 class="middleText" style="text-align: left">Różnorodne materiały</h2>
                <p>
                    Efektywnej nauce sprzyjają różnorodne i kreatywne materiały. 
                    Nie musisz martwić się o zakup drogich książek - materiały na lekcje przygotowujemy same!
                </p>
            </div>
            <div class="AboutBox">
                <!-- <div> <img src="{{asset('images/aboutUs/rocket.svg')}}" width="80px" alt="Bulb"></div> -->
                <h2 class="middleText" style="text-align: left">Całkowite zanurzenie</h2>
                <p>
                    Prowadzimy lekcje już od początkujących poziomów w języku docelowym. 
                    Polecimy Ci filmy, podcasty czy książki, abyś miał(a) stały kontakt z językiem!
                </p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center AboutDiv" id="zalozycielki">
        <div>
            <h3 class="smallHeadText VioletText">JAK TO SIĘ ZACZĘŁO</h3>
            <h2 class="bigHeadText">Założycielki</h2>
        </div>
        <div  class="OwnerDesc">
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
        <div class="OwnerDesc">
            <div class="OwnerInfo">
                <img src="{{asset('images/aboutUs/WiktoriaKolo.png')}}" width="174px" alt="Wiktoria">
                <div>
                    <div><h2 class="middleText" style="text-align: left !important">Wiktoria</h2></div>
                    <div class="VioletText">lektorka języka włoskiego i portugalskiego | założycielka szkoły</div>
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
           
        });

</script>