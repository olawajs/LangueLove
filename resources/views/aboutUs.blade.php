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
}
.WhiteBack{
    background-color: white;
    border-radius: 15px;
    padding: 50px !important;
}
@media (max-width:600px) { 
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
    
}
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center classic">
        <div class="TwoSide">
            <img src="{{ asset('images/logo/logo1 2x.png') }}" height="150" alt="">
        </div>
        <div class="TwoSide">
            <h2>Poznajmy się!</h2>
                <p>
                    LangueLove to szkoła języków obcych online. 
                    Nazwa naszej szkoły została zainspirowana francuskim słowem “langue”, czyli język (wymawianego jako «lɑ̃ɡ»)
                     i jego połączeniem z “love” (ang. miłość).
                      Wierzymy, że połączy nas miłość i pasja do języków, która okaże się być “long love”.
                </p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="TwoSide">
            <h2>Dlaczego warto nas wybrać?</h2>
                <p>
                    Prowadzimy kursy językowe indywidualne i grupowe oraz webinaria tematyczne. W naszej szkole
                    językowej online znajdą Państwo kursy 10 języków obcych. Mocno wierzymy, że nauka języka
                    jest inwestycją w przyszłość i drogą do odkrywania świata, a także poszerzania horyzontów.
                    Nasze indywidualne i grupowe kursy językowe opierają się na autorskich programach nauki,
                    dzięki czemu mają Państwo pewność, że inwestycja przynosi efekty i jest spersonalizowana.
                </p>
        </div>
        <div class="TwoSide">
            <img src="{{asset('images/foto1.jpg')}}" width="60%"  alt="">
        </div>
    </div>

    <div class="row justify-content-center classic">
        <div class="TwoSide">
            <img src="{{ asset('images/aboutUs/aboutUs1.jpg') }}"  width="100%" alt="">
        </div>
        <div class="TwoSide WhiteBack">
            <h2>Jak wyglądają zajęcia?</h2>
                <p>
                    Zajęcia trwają <b>60 minut</b> lub <b>90 minut</b>. Prowadzimy je za pośrednictwem komunikatora Skype.
                    Nie musisz kupować podręczników, wszystkie materiały otrzymasz online od swojego lektora. Do każdych zajęć otrzymasz także notatki na dysku.
                   <br>
                   <br>
                    <b>Regularność zdecydowanie wspiera naukę języka obcego!</b>
                    <br>
                    Pierwsze zajęcia rozpoczynamy krótką rozmową: jakie są Twoje oczekiwania odnośnie zajęć, co chcesz osiągnąć, w jaki sposób najskuteczniej się uczysz, z czym masz największy problem?
                    To pozwoli lektorowi dobrać odpowiednie materiały i zadania.
                    <br><b>Rozpocznij z nami przygodę i osiągnij swój cel! </b>
                    <br>
                </p>
                <button class="btn btn-secondary">ZAPISUJĘ SIĘ!</button>
        </div> 
        <div class="TwoSide">
            <img src="{{ asset('images/aboutUs/aoutUs2.jpg') }}"  width="100%" alt="">
        </div>
        <div class="TwoSide WhiteBack">
            <h2>Dlaczego my?</h2>
                <p>
                    Na zajęciach nauczymy Cię nie tylko języka, ale również opowiemy o <b>historii i tradycji</b> danego kraju, co pozwoli Ci na lepsze zrozumienie danej kultury i przełoży się na Twoje postępy w nauce. 
                    Nasze kursy są oparte na praktycznych ćwiczeniach, wykonywanych w przyjaznej atmosferze, przez co poczujesz się swobodnie w mówieniu już od pierwszych zajęć.
                    <br>Stawiamy na nowoczesność i rozwój. 
                    Poza podręcznikiem <b>wykorzystujemy wszystkie dostępne zasoby internetu</b>, takie jak prezentacje multimedialne, filmy, artykuły, gry, podcasty, social media, pracę w grupach i inne. 
                    Wprowadzamy nowoczesne metody oparte na badaniach neurolingwistycznych i językoznawczych, takie jak gamifikacja. 
                </p>
        </div> 
    </div>
    <div class="row justify-content-center">
        <div class="TwoSide">
            <h2>Zespół</h2>
                <p>
                Jesteśmy zespołem młodych, energicznych filologów oraz native speakerów,
                 którzy zdobywali doświadczenie zarówno w Polsce, jak i za granicą. 
                 <b>Dopasowujemy przebieg zajęć do Twoich potrzeb i celów.</b>
                <br>Znasz wszelkie zasady gramatyczne, ale boisz/wstydzisz się rozmawiać?
                Chcesz uzyskać certyfikat językowy? 
                A może nauka języka to pierwszy krok do pozyskania nowej, lepszej pracy?
                Wspólnymi działaniami ze wszystkim sobie poradzimy! Wiemy, że <b>do efektywnej nauki potrzebne jest wzajemne zaufanie i wsparcie</b>.
                Możesz liczyć na nas na każdym kroku swojej przygody z nauką języka. Strach, stres i blokady znikają zazwyczaj po pierwszych zajęciach.
                Nie wiesz który kurs wybrać? Odezwij się do nas! Chętnie pomożemy i już podczas tej luźnej rozmowy zobaczysz, że nadajemy na tych samych falach!
                <br>
                </p>
                <button class="btn btn-primary">NAPISZ DO NAS</button>
        </div>
        <div class="TwoSide">
            <img src="{{asset('images/aboutUs/team.gif')}}" width="80%"  alt="">
        </div>
    </div>
    <div class="row justify-content-center classic">
        <h2>Założycielki</h2>
                <p style="margin-left: 25px">
                Cześć! Z tej strony <b>Wiktoria i Weronika</b> . Jesteśmy dwiema italianistkami z Krakowa. 
                Nasza długoletnia przyjaźń i wspólna miłość do języków zaprowadziła nas do założenia LangueLove! 
                Wspólnie przeszłyśmy przez wszystkie etapy zdobycia dyplomu filologa na Uniwersytecie Jagiellońskim i
                zwiedziłyśmy razem wiele zakątków Europy. 
                </p>
    </div>
    <div class="row justify-content-center classic">
        
        <div class="TwoSide WhiteBack">
            <h2>Weronika</h2>
                <p>
                Swoją pierwszą styczność z obcą kulturą i językiem miałam w dzieciństwie, 
                gdy wyjechałam na kilka lat do Włoch. Już wtedy zrozumiałam, jak kluczowa jest znajomość języka i 
                jak wiele może nam dać, od przyjaźni po możliwość podróżowania. Później pojawiła się pasja do angielskiego - 
                języka, którym posługuje się dzisiaj prawie każda osoba na świecie, języka, który przełamuje bariery i otwiera 
                nas na drugiego człowieka. Zaciekawienie językami zaprowadziło mnie na studia filologiczne, a potem przekładoznawcze.
                 Natomiast świadomość roli języka obcego w życiu sprawiła, że od kilku lat uczę innych, 
                 zarówno na lekcjach indywidualnych, jak i grupowych. 
                Wciąż sama też jestem uczennicą, obecnie odkrywam zawiłości i piękno języka tureckiego.
                 Dzięki temu nigdy nie zapominam o perspektywie kursanta i jego potrzebach.
                </p>
        </div>
        <div class="TwoSide">
            <img src="{{ asset('images/wera2.jpg') }}" width="55%" alt="">
        </div>
        <div class="TwoSide WhiteBack">
            <h2>Wiktoria</h2>
                <p>
                Moje imię we wszystkich językach romańskich oznacza <b>zwycięstwo</b>. Uczę (prze)zwyciężać trudności związane z nauką języka obcego. Moja przygoda z nauką języków zaczęła się gdy miałam 14 lat, kiedy zupełnie przez przypadek trafiłam na wymianę uczniowską do włoskiej rodziny niedaleko Neapolu. Tam przeżyłam swój pierwszy szok kulturowy i zrozumiałam, jak ważnym aspektem w nauce języków jest zrozumienie społeczeństwa i kultury danego kraju. Swoje magisterium, jak i licencjat ukończyłam na Uniwersytecie Jagiellońskim. Od kilku lat prowadzę zajęcia z włoskiego, portugalskiego i polskiego jako obcego. Oprócz tego interesuję się językoznawstwem i psychologią, a w szczególności psycholingwistyką, czyli tym jak my wpływamy na język i jak język wpływa na nasze postrzeganie świata. 
                Sama uczę się chińskiego, co pozwala mi na lepsze zrozumienie ucznia i dostosowanie się do jego potrzeb. 

                </p>
        </div>
        <div class="TwoSide">
            <img src="{{ asset('images/wiki1.jpg') }}" width="60%" alt="">
        </div>
    </div>



        <!-- <div class="AboutUsContainer">
           <div class="secondaryDIV" style="z-index: 2; overflow: hidden">
           <div class="circleContainer">
                    <span class="circle-sand" style="bottom: -79px; right: -37px;"></span>
                </div>
            <h2>KURSY</h2>
            <p>Prowadzimy kursy językowe indywidualne i grupowe oraz webinaria tematyczne. W naszej szkole
                językowej online znajdą Państwo kursy 10 języków obcych. Mocno wierzymy, że nauka języka
                jest inwestycją w przyszłość i drogą do odkrywania świata, a także poszerzania horyzontów.
                Nasze indywidualne i grupowe kursy językowe opierają się na autorskich programach nauki,
                dzięki czemu mają Państwo pewność, że inwestycja przynosi efekty i jest spersonalizowana.</p>
               
            </div> 
            <div class="fotoDiv"> <img src="{{asset('images/foto1.jpg')}}" style="width: 100%;"> </div>
        </div>
        <div class="AboutUsContainer">
            <div class="fotoDiv"> <img src="{{asset('images/team.gif')}}" style="width: 100%;"></div>
            <div class="primaryDIV">
                <h2>ZESPÓŁ</h2>
                <p>Zespół szkoły języków obcych online LangueLove to energiczne, młode osoby, a tym samym
                    pasjonaci ich odkrywania. Nasi lektorzy to filolodzy i native speakerzy, którzy zdobywali swoje
                    doświadczenie nie tylko w Polsce, ale również za granicą. Jesteśmy w pełni świadomi, że do
                    efektywnej nauki niezbędne jest wzajemne zaufanie i wsparcie lektora, dlatego też stawiamy na
                    budowanie relacji, w których nie ma miejsca na strach i blokadę, a wyłącznie otwartość,
                    wzajemnie zrozumienie, pokonywanie ograniczeń oraz eliminację wszystkich innych czynników,
                    które przeszkadzają w postępach w nauce. Tak właśnie prowadzimy nasze indywidualne i
                    grupowe kursy językowe.</p>
            </div>
        </div>
        <div class="AboutUsContainer">
            <div class="secondaryDIV">
                <h2>ZAJĘCIA</h2>
                <p>Na zajęciach nauczymy Cię nie tylko języka, ale również opowiemy o historii i tradycji danego
                    kraju, co pozwoli Ci na lepsze zrozumienie danej kultury. Gwarantujemy, że przełoży się to na
                    Twoje postępy w nauce. Nasze kursy językowe online to m.in. praktyczne ćwiczenia,
                    przeprowadzane w przyjaznej atmosferze tak, abyś czuł/a się swobodnie w mówieniu już na
                    pierwszych zajęciach. Jesteśmy odpowiedzią na pytanie, jak przezwyciężać trudności związanie
                    z nauką języka obcego.</p>
            </div>
            <div class="fotoDiv"> tu bedzie graficzka</div>
        </div>
        <div class="AboutUsContainer">
            <div class="fotoDiv"> tu bedzie graficzka</div>
            <div class="primaryDIV">
                <h2>DLACZEGO MY?</h2>
                <p>W trakcie kursów językowych prowadzonych online stawiamy na nowoczesność i rozwój.
                        Wykorzystujemy wszystkie dostępne zasoby internetu: prezentacje multimedialne, filmy, artykuły,
                        gry, pracę w grupach i wiele innych. Wprowadzamy nowoczesne metody dotychczas nie
                        oferowane na rynku, oparte na badaniach neurolingwistycznych i językoznawczych, takie jak

                        gamifikacja. To tylko jeden z powodów, dla których powinieneś/aś wybrać właśnie naszą szkołę
                        języków obcych online.</p>
            </div>
        </div>
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
        <div class="AboutUsContainer">
            <div class="secondaryDIV" style="width: 100%">
                <h2>ZAŁOŻYCIELKI</h2>
                <p>Nazywamy się Wiktoria i Weronika. Jesteśmy dwiema italianistkami z Krakowa. Nasza
                        długoletnia przyjaźń i wspólna miłość do języków zaowocowała założeniem LangueLove oraz
                        stworzeniem indywidualnych kursów językowych (i nie tylko). Wspólnie przeszłyśmy przez
                        wszystkie etapy zdobycia dyplomu z filologii na Uniwersytecie Jagiellońskim. Zwiedziłyśmy razem
                        również wiele zakątków Europy.</p>
            </div>
        </div>
        <div class="AboutUsContainer">
            <div class="primaryDIV">
            <h2>Weronika</h2>
                <p>
                        Świadomość znaczenia
                        języka obcego w moim życiu sprawiła, że od kilku lat uczę innych zarówno na indywidualnych
                        kursach językowych, jak i w grupach. Pozwoliło mi to stworzyć i poprowadzić aż dwie edycje
                        Studenckich Konwersacji Językowych z języka włoskiego na Uniwersytecie Jagiellońskim. Język
                        włoski i angielski miałam okazję szlifować także jako tłumaczka oraz w środowisku
                        korporacyjnym/biznesowym, a podróże zagraniczne są wpisane w moją codzienność. Pozwala mi
                        to pracować z moimi Kursantami na autentycznych tekstach i sytuacjach, które przydadzą im się
                        w prawdziwym życiu i pracy. Wciąż jestem uczennicą – stale się szkolę, obecnie odkrywam
                        zawiłości i piękno języka tureckiego, dzięki czemu nigdy nie zapominam o perspektywie kursanta
                        i jego potrzebach.
                        
                        
            </div>
            <div class="fotoDiv">
                <img src="{{asset('images/wera1.jpg')}}">
            </div>
        </div>
        <div class="AboutUsContainer">
            <div class="fotoDiv">
                <img src="{{asset('images/wera2.jpg')}}">
            </div>
            <div class="primaryDIV">
                <p>
                        Świadomość znaczenia języka obcego w moim życiu sprawiła, że od kilku lat uczę innych zarówno na indywidualnych
                        kursach językowych, jak i w grupach. Pozwoliło mi to stworzyć i poprowadzić aż dwie edycje
                        Studenckich Konwersacji Językowych z języka włoskiego na Uniwersytecie Jagiellońskim. Język
                        włoski i angielski miałam okazję szlifować także jako tłumaczka oraz w środowisku
                        korporacyjnym/biznesowym, a podróże zagraniczne są wpisane w moją codzienność. Pozwala mi
                        to pracować z moimi Kursantami na autentycznych tekstach i sytuacjach, które przydadzą im się
                        w prawdziwym życiu i pracy. Wciąż jestem uczennicą – stale się szkolę, obecnie odkrywam
                        zawiłości i piękno języka tureckiego, dzięki czemu nigdy nie zapominam o perspektywie kursanta
                        i jego potrzebach.
                        
                        
            </div>
        </div>
        <div class="AboutUsContainer">
            <div class="secondaryDIV">
                <h2>Wiktoria</h2>
                <p>     Na studiach wybrałam specjalizację tłumaczeniową, aby przekonać się... jak bardzo nie chcę tego
                        robić w życiu. Nauczanie to moja pasja. Wciąż rozwijam się jako lektorka. Od kilku lat prowadzę
                        zajęcia prywatne i grupowe z włoskiego, portugalskiego i polskiego jako obcego. Oprócz tego,
                        interesuję się językoznawstwem i psychologią, a w szczególności psycholingwistyką, czyli tym,
                        jak wpływamy na język i jak język wpływa na nasze postrzeganie świata. Staram się
                        wykorzystywać specjalistyczną wiedzę na moich lekcjach, dzięki czemu są one spersonalizowane
                        i dobrane do potrzeb Kursanta. Sama obecnie uczę się chińskiego, co pozwala mi na lepsze
                        zrozumienie ucznia i dostosowanie się do jego potrzeb.</p></p>
            </div>
            <div class="fotoDiv">  <img src="{{asset('images/wiki2.jpg')}}"></div>
        </div>
        <div class="AboutUsContainer">
             <div class="fotoDiv">  <img src="{{asset('images/wiki1.jpg')}}"></div>
            <div class="secondaryDIV">
               
                <p> Na studiach wybrałam specjalizację tłumaczeniową, aby przekonać się... jak bardzo nie chcę tego
                        robić w życiu. Nauczanie to moja pasja. Wciąż rozwijam się jako lektorka. Od kilku lat prowadzę
                        zajęcia prywatne i grupowe z włoskiego, portugalskiego i polskiego jako obcego. Oprócz tego,
                        interesuję się językoznawstwem i psychologią, a w szczególności psycholingwistyką, czyli tym,
                        jak wpływamy na język i jak język wpływa na nasze postrzeganie świata. Staram się
                        wykorzystywać specjalistyczną wiedzę na moich lekcjach, dzięki czemu są one spersonalizowane
                        i dobrane do potrzeb Kursanta. Sama obecnie uczę się chińskiego, co pozwala mi na lepsze
                        zrozumienie ucznia i dostosowanie się do jego potrzeb.</p></p>
            </div>
        </div> -->
    </div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>

</script>