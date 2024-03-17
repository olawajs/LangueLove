@extends('layouts.app')
<style>


</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet"> 

<link href="{{ asset('css/owlCarousel/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/owlCarousel/owl.theme.default.min.css') }}" rel="stylesheet">
@section('content')
<div class="container row"><!-- desktop -->

  <div class="col-12 FileHead">
      <div class="smallFileText">FAQ</div>
      <div class="bigFileText">Najczęściej zadawane pytania</div>
  </div>

  <div class="col-2"></div>
  <div class="accordion col-8">
    <div class="menuRadio">
      <div class="custom-radio">
        <input type="radio" id="radioButton1" name="radioGroup" onclick="showContent('section1')" checked>
        <label for="radioButton1">Zajęcia i lektorzy</label>
      </div>
      <div class="custom-radio">
        <input type="radio" id="radioButton2" name="radioGroup" onclick="showContent('section2')">
        <label for="radioButton2">Ceny, płatności, faktury</label>
      </div>
      <div class="custom-radio">
        <input type="radio" id="radioButton3" name="radioGroup" onclick="showContent('section3')">
        <label for="radioButton3">Przełożenie i odwołanie zajęć</label>
      </div>
      <div class="custom-radio">
        <input type="radio" id="radioButton4" name="radioGroup" onclick="showContent('section4')">
        <label for="radioButton4">Kwestie techniczne</label>
      </div>
    </div>

    <div id="section1" class="content">
        <div class="accordion-item">
          <div class="accordion-header">Jak mogę zapisać się na zajęcia?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Na zajęcia możesz zapisać się zakładając konto na naszej stronie (możesz
              też wybrać logowanie przez Gmail), następnie wyszukaj zajęcia w naszej
              wyszukiwarce na stronie głównej i zaznacz w kalendarzu odpowiadający
              Ci dzień i godzinę. Nie zapomnij o wyborze pomiędzy pojedynczymi
              zajęciami, pakietem a zajęciami cyklicznymi.
              Jeśli masz problem z dokonaniem zapisu przez naszą stronę internetową,
              możesz się z nami skontaktować pod numerem telefonu <b>+48 516632063</b>
              lub wysłać nam wiadomość na adres e-mail: <b>kontakt@languelove.pl</b></p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Kiedy mogę zapisać się na zajęcia?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Na zajęcia indywidualne i w parach możesz zapisać się w dowolnej chwili i
              najpóźniej na 12 godzin przed ich rozpoczęciem. Twój zapis zostanie
              następnie zaakceptowany przez lektora. Jeśli chodzi o zajęcia grupowe -
              zapisy są możliwe dopóki są dostępne miejsca w grupie. 
              Informacje o dostępności miejsc znajdują się w opisie kursu.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Ile osób jest w grupie?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Prowadzimy <b>tylko</b> małe grupy. Liczą one od 4 do 6 osób. Warunkiem
              utworzenia grupy jest zebranie minimalnej liczby Kursantów. Jeśli
              grupa się nie utworzy, będzie możliwość wybrania pomiędzy zwrotem
              pieniędzy, a wykorzystaniem środków na inny kurs lub zajęcia
              indywidualne.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Kiedy otrzymam informacje o starcie kursu?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>E-mail o starcie kursu grupowego dotrze do Ciebie nie później niż 3 dni
              przed jego planowaną datą rozpoczęcia. Pamiętaj, że może trafić do
              folderu OFERTY lub SPAM. Prosimy więc o dokładne sprawdzenie tych
              folderów. Jeśli jednak nie otrzymałaś/eś od nas maila, skontaktuj się z
              nami pod adresem: <b>kontakt@languelove.pl</b>. Natomiast o dacie
              rozpoczęcia zajęć indywidualnych decydujesz ty.
              Skorzystaj z kalendarza i wybierz godzinę, która Ci najbardziej odpowiada.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Jakie są metody nauczania w naszej szkole?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Metody nauczania są dobierane indywidualnie do każdego Kursanta i
              zależą od poziomu języka,, poruszanych zagadnień oraz osobistych
              preferencji i predyspozycji Kursanta.</p>
            <p>Najczęściej na naszych zajęciach będziesz miał/a do czynienia z
              połączeniem metody naturalnej, komunikatywnej oraz zanurzeniem w
              języku. Lektorzy (jeśli poziom na to pozwala) komunikują się z tobą w
              języku docelowym i angażują w rozmowę. Nie zabraknie również
              elementów kulturowych dotyczących kraju/krajów, w których używa się
              języka, którego się uczysz oraz materiałów multimedialnych, które
              zwiększają ekspozycję na język obcy i przyspieszają naukę.</p>
            <p>Na pierwszych zajęciach indywidualnych i w parach, lektor przeprowadzi
              szczegółowy wywiad językowy, który pozwoli na przygotowanie
              efektywnego planu nauki. Nawet w przypadku zajęć grupowych metody
              nauczania są modyfikowane pod grupę, tak by każdy Kursant wyciągnął z
              nich jak najwięcej. Jest to możliwe dzięki temu, że prowadzimy zajęcia w
              bardzo małych grupach. Zajęcia są prowadzone przez doświadczonych i
              wykwalifikowanych nauczycieli.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Czy Wasza szkoła przygotuje mnie do matury/certyfikatu językowego?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Tak. W naszej szkole oferujemy również lekcje przygotowujące do różnego rodzaju egzaminów.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Ile trwają zajęcia?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Możesz wybrać czas trwania zajęć indywidualnych i w parze: 55 lub 85 minut. 
            Informacje o długości zajęć grupowych znajdują się w opisie konkretnego kursu grupowego.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Czy zajęcia mogą odbywać się stacjonarnie?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Nie, prowadzimy tylko zajęcia online. Dzięki temu oszczędzasz czas, a
              nauka jest przyjemniejsza dzięki wykorzystaniu nowych technologii. 
              Dzięki zajęciom online masz również możliwość kontaktu z native speakerami z różnych krajów.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Czy oferujecie zajęcia z native speakerem?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Tak, w naszej ofercie znajdziesz zarówno zajęcia z lektorami
              polskojęzycznymi jak i native speakerami.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Jak funkcjonują pakiety?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>W naszej szkole możesz zakupić pakiet 5, 10 lub 30 lekcji indywidualnych,
              bądź w parach. Na realizację pakietu odpowiednio przysługuje 5, 10 i 30
              tygodni od daty pierwszych zajęć, przy czym pierwsza lekcja z pakietu
              musi odbyć się do 30 dni od daty zakupu.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Czy mogę zmienić lektora jeśli wykupiłam/em pakiet?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Zakupiony pakiet będzie przypisany do konkretnego lektora.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">W jakich godzinach prowadzone są zajęcia?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Zajęcia prowadzimy od poniedziałku do piątku od 7:00 do 22:00.
              Niektórzy lektorzy są dostępni również w soboty.</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">Jak mogę sprawdzić dostępność lektora?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Po wybraniu języka i lektora przez naszą wyszukiwarkę pojawi się
              kalendarz, w którym możesz sprawdzić jego dostępność i w szybki sposób
              ustalić termin zajęć. Jeśli napotkasz tutaj problem, pamiętaj, że możesz
              się z nami skontaktować pod numerem telefonu <b>+48 516632063</b> lub
              wysłać nam wiadomość na adres e-mail: <b>kontakt@languelove.pl.</b></p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">Chciał(a)bym uczestniczyć w zajęciach grupowych, ale nie wiem jaki jest mój poziom.<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Zachęcamy do umówienia się na darmową konsultację poprzez link: https://languelove.pl/consultation 
              <br>Dostaniesz mailowo odpowiedź zwrotną z propozycją terminów konsultacji.</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">Chcę uczestniczyć w zajęciach w parze, czy muszę się zgłosić z drugą osobą?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Tak, aby uczestniczyć w zajęciach w parach, należy zgłosić się z drugą
              osobą. W naszej szkole języków obcych online oferujemy lekcje
              indywidualne, w parach i grupowe, a zajęcia w parach są doskonałym
              rozwiązaniem dla osób, które chcą uczyć się języka obcego w
              towarzystwie osoby, z którą mają bliską relację.</p>
            <p>W przypadku zajęć w parach, płatność wykonuje jedna osoba z pary.
              Osoba ta jest odpowiedzialna za uregulowanie opłaty za zajęcia oraz za
              ustalanie terminu zajęć.</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">Jakie są korzyści z nauki języków obcych online?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Nauka języków obcych online pozwala na elastyczność czasową i
              miejscową, a także nauczanie w małych grupach lub indywidualnie.
              Ponadto, uczestnictwo w zajęciach online pozwala na komunikację z
              osobami z całego świata, co przyczynia się do poszerzenia horyzontów i
              poznania nowych kultur.</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">Czy prowadzicie kursy z języków specjalistycznych?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Tak. Informacje na temat tego, który lektor może Cię nauczyć danego
                języka specjalistycznego znajdziesz przy opisie każdego lektora.</p>
                <p> Możesz również umówić się na darmową konsultację, by porozmawiać 
                  o szczegółach zajęć: https://languelove.pl/consultation
                </p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">Czy na koniec kursu otrzymam certyfikat?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Tak, po każdym kursie grupowym otrzymasz certyfikat. 
              Jeśli chcesz otrzymać certyfikat ukończenia kursu indywidualnego
               możesz napisać do nas maila na adres <b>kontakt@languelove.pl</b></p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">Jakie kwalifikacje mają lektorzy?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Nasi lektorzy to filolodzy oraz native speakerzy, którzy posiadają nie tylko
              bogate doświadczenie w nauczaniu języków obcych, ale także
              odpowiednie kwalifikacje. Dodatkowo, nasi lektorzy biorą udział w
              regularnych szkoleniach i kursach, aby być na bieżąco z najnowszymi
              metodami nauczania i trendami w dziedzinie nauczania języków obcych.
              Dzięki takim kwalifikacjom i doświadczeniu, nasi lektorzy są w stanie
              dostosować swoje podejście do indywidualnych potrzeb i poziomu
              zaawansowania każdego ucznia, co zapewnia skuteczne i efektywne
              nauczanie języków obcych online.</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">Czy mogę skorzystać z bezpłatnej konsultacji?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Tak, oczywiście! Jeśli nie wiesz, jaki jest Twój poziom, możesz skorzystać z
                bezpłatnej konsultacji. W naszej szkole języków obcych online oferujemy
                bezpłatną konsultację dla wszystkich naszych przyszłych uczniów.
                Na konsultację możesz umówić się tutaj: https://languelove.pl/consultation </p>
                <p>W trakcie konsultacji będziesz miał/a okazję porozmawiać z jednym z
                naszych lektorów i omówić swoje cele, potrzeby i oczekiwania dotyczące
                nauki języka obcego. Lektor odpowie na wszystkie Twoje pytania i
                pomoże Ci wybrać odpowiedni program nauczania.</p>
            <p>Konsultacja jest również idealną okazją, aby poznać naszą metodę
              nauczania, platformę Skype i lektora, zanim zdecydujesz się zakupić nasz
              kurs.Zapraszamy do skorzystania z bezpłatnej konsultacji 
              i rozpoczęcia swojej przygody z nauką języka obcego w naszej szkole!</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">Czy mogę zakupić u Was spersonalizowany voucher na pakiet lekcji?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Tak, w naszej szkole języków obcych online umożliwiamy zakup
              spersonalizowanego vouchera na pakiet lekcji. W zależności od Twoich
              potrzeb i oczekiwań, możemy przygotować dla Ciebie indywidualną
              ofertę, która uwzględnia czas trwania kursu, ilość lekcji oraz wybrany
              język obcy.</p>
            <p>Aby zamówić spersonalizowany voucher, należy skontaktować się z nami
              wysyłając nam wiadomość na adres e-mail: <b>kontakt@languelove.pl</b> i
              przedstawić nam swoje potrzeby dotyczące nauki języka obcego.
              Przygotujemy dla Ciebie indywidualną ofertę na pakiet lekcji, która
              zostanie uwzględniona na voucherze. Spersonalizowany voucher na
              pakiet lekcji jest doskonałym prezentem dla osoby, która chce rozpocząć
              naukę języka obcego lub doskonalić swoje umiejętności językowe. Dzięki
              niemu, osoba obdarowana będzie mogła rozpocząć naukę języka obcego
              w dogodnym dla siebie czasie i dostosować plan nauki do swojego stylu
              życia.</p>
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">Jak mogę wykorzystać voucher?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>.Załóż konto na naszej stronie, następnie wybierz lektora,
               kliknij w termin w kalendarzu i wybierz zajęcia na które opiewa Twój pakiet.
                Zobaczysz miejsce do wpisania kodu.
               Na voucherze znajdziesz Twój indywidualny kod, wpisz go a następnie zajęcia zostaną dodane do Twojego konta Kursanta.
               </p>
          </div>
        </div>
    </div>

  </div>
  <div class="col-2"></div>
</div>
  
  <!-- Dodaj więcej takich elementów, jeśli potrzebujesz -->
        <!-- <div class="accordion-item">
          <div class="accordion-header">Pytanie 2 <span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Odpowiedź na pytanie 2.</p>
          </div>
        </div> -->
<!-- wersja mobile
<div class="container mobile">

</div> -->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{{ asset('js/owlCarousel/owl.carousel.min.js') }}" defer></script>

<script>
     
     document.addEventListener('DOMContentLoaded', function () {
  const accordionItems = document.querySelectorAll('.accordion-item');

  accordionItems.forEach(function (item) {
    const header = item.querySelector('.accordion-header');
    const content = item.querySelector('.accordion-content');
    const icon = header.querySelector('.icon');

    header.addEventListener('click', function () {
      // Toggle the display property of the content div
      content.style.display = (content.style.display === 'none' || content.style.display === '') ? 'block' : 'none';
    
      // Change the icon based on the content visibility
      icon.innerHTML = (content.style.display === 'none' || content.style.display === '') ? `<img src="{{asset('images/svg/plus.svg')}}">` : `<img src="{{asset('images/svg/minus.svg')}}">`;
    });
  });
});
  function showContent(sectionId) {
      // Ukryj wszystkie sekcje
      var sections = document.querySelectorAll('.content');
      sections.forEach(function(section) {
        section.classList.add('hidden');
      });

      // Pokaż wybraną sekcję
      var selectedSection = document.getElementById(sectionId);
      selectedSection.classList.remove('hidden');
    }
</script>