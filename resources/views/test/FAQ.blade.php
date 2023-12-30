@extends('layouts.app')
<style>

.LinksContainer > a{
  color: var(--langue-love-purple);
font-family: Montserrat;
font-size: 16px;
font-style: normal;
font-weight: 600;
line-height: 24px; /* 150% */
}
.LinksContainer{
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 16px;
  padding-bottom: 36px;
}
.FileHead{
  display: inline-flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  margin: 60px 0 !important;
}
.smallFileText{
  color: var(--langue-love-purple);
  font-family: Montserrat;
  font-size: 12px;
  font-style: normal;
  font-weight: 500;
  line-height: 20px;
}
.bigFileText{
  color: var(--langue-love-black);
  font-family: Montserrat;
  font-size: 40px;
  font-style: normal;
  font-weight: 700;
  line-height: 48px;
}
@media only screen and (max-width: 800px) {
  .col-2{
    display: none;
  }
  .accordion{
    width: 100% !important;
    padding: 0 16px;
  }
  .FileHead{
    align-items: flex-start;
  }
}

.content {
  padding: 16px;
}

.hidden {
  display: none;
}

.custom-radio {
  display: inline-block;
  position: relative;
  cursor: pointer;
  font-family: Arial, sans-serif;
}

.custom-radio input {
  display: none; /* Ukrycie domyślnego inputa radio */
}

.custom-radio label {
  color: var(--langue-love-pink);
  font-family: Montserrat;
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: 22px;
  padding: 10px 0;
}

/* Stylizacja po zaznaczeniu radio button */
.custom-radio input:checked + label {
  color: var(--langue-love-black);
  font-family: Montserrat;
  font-size: 14px;
  font-style: normal;
  font-weight: 700;
  line-height: 22px;
  border-bottom: 3px solid var(--langue-love-pink);
}
.menuRadio{
  display: flex;
  justify-content: space-between;
  gap: 10px;

}
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
          <div class="accordion-header">Jak mogę zapisać się na kurs?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Na kurs możesz zapisać się zakładając konto na naszej stronie (możesz
              też wybrać logowanie przez Gmail), następnie wyszukaj zajęcia w naszej
              wyszukiwarce na stronie głównej i zaznacz w kalendarzu odpowiadający
              Ci dzień i godzinę. Nie zapomnij o wyborze pomiędzy pojedynczymi
              zajęciami, a zajęciami cyklicznymi. Możesz też wykupić pakiet - dzięki
              temu masz pewność, że dany termin będzie zarezerwowany wyłącznie
              dla Ciebie.
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
              ostatni dzień zapisów jest ustalany dla każdego kursu indywidualnie, taką
              informację znajdziesz w opisie grupy, którą wybrałeś.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Ile osób jest w grupie?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Prowadzimy <b>tylko</b> małe grupy. Liczą one od 4 do 6 osób. Warunkiem
              utworzenia grupy jest zebranie odpowiedniej liczby Kursantów. Jeśli
              grupa się nie utworzy, będziesz mógł wybrać pomiędzy zwrotem
              pieniędzy, a wykorzystaniem środków na inny kurs lub zajęcia
              indywidualne.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Kiedy otrzymam informacje o starcie kursu?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>E-mail o starcie kursu grupowe dotrze do Ciebie nie później niż 3 dni
              przed jego planowaną datą rozpoczęcia. Pamiętaj, że może trafić do
              folderu OFERTY lub SPAM. Prosimy więc o dokładne sprawdzenie tych
              folderów. Jeśli jednak nie otrzymałaś/eś od nas maila, skontaktuj się z
              nami pod adresem: <b>kontakt@languelove.pl</b>. Natomiast o dacie
              rozpoczęcia zajęć indywidualnych lub grupowych decydujesz ty.
              Skorzystaj z kalendarza i wybierz godzinę, która Ci najbardziej odpowiada.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Jakie są metody nauczania w naszej szkole?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Metody nauczania są dobierane indywidualnie do każdego Kursanta i
              zależą od poziomu języka,, poruszanych zagadnień oraz osobistych
              preferencji i predyspozycji Kursanta.</p>
            <p>Najczęściej na naszych zajęciach będziesz miał do czynienia z
              połączeniem metody naturalnej, komunikatywnej oraz zanurzeniem w
              języku. Lektorzy (jeśli poziom na to pozwoli) komunikują się z tobą w
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
            <p>Możesz wybrać czas trwania zajęć indywidualnych i w parze: 60 lub 90 minut. Zajęcia grupowe zawsze trwają 90 minut.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Czy zajęcia mogą odbywać się stacjonarnie?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Nie, prowadzimy tylko zajęcia online. Dzięki temu oszczędzasz czas, a
              nauka jest przyjemniejsza dzięki wykorzystaniu nowych technologii. Za
              pomocą zajęć online umożliwiamy również kontakt z native speakerami z
              różnych krajów.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">Czy oferujecie zajęcia z native speakerem?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Tak, w naszej ofercie znajdziesz zarówno zajęcia z lektorami
              polskojęzycznymi jak i native speakerami. Poznaj bliżej naszych lektorów
              w sekcji “lektorzy”..</p>
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
            <p>Tak, pakiet wykupuje się na liczbę zajęć i możesz wykorzystać go również
              na różne języki. Pamiętaj jednak, że w przypadku chęci wykorzystania
              pakietu u różnych lektorów należy zaznaczyć opcję “pojedyncze zajęcia”.</p>
          </div>
        </div>

         <div class="accordion-item">
          <div class="accordion-header">W jakich godzinach prowadzone są zajęcia?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Zajęcia prowadzimy od poniedziałku do piątku od 7:00 do 22:00.
              Niektórzy lektorzy są dostępni również w soboty i niedziele.</p>
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
            <p>Zachęcamy Cię do wypełnienia formularzu kontaktowego, aby umówić
              się na darmową konsultację z lektorem, na którym sprawdzi on Twój
              poziom i porozmawia o Twoich potrzebach językowych.</p>
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
          <div class="accordion-header">Lektor nie ma wolnych terminów, a ja wykupiłam/em pakiet. Co mam zrobić?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Spokojnie, w ramach pakietu możesz umówić się na zajęcia do innego
              lektora lub wykorzystać je na naukę innego języka (z innym lektorem).</p>
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
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header">Czy na koniec kursu otrzymam certyfikat?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Jeśli chcesz otrzymać certyfikat ukończenia kursu, możesz się do nas
              zgłosić na <b>kontakt@languelove.pl</b></p>
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
                bezpłatną konsultację dla wszystkich naszych potencjalnych uczniów. W
                trakcie konsultacji będziesz miał/a okazję porozmawiać z jednym z
                naszych lektorów i omówić swoje cele, potrzeby i oczekiwania dotyczące
                nauki języka obcego. Lektor odpowie na wszystkie Twoje pytania i
                pomoże Ci wybrać odpowiedni program nauczania.</p>
            <p>Konsultacja jest również idealną okazją, aby poznać naszą metodę
              nauczania, platformę Skype i lektora, zanim zdecydujesz się zakupić nasz
              kurs. Możesz zapisać się na bezpłatną konsultację poprzez formularz
              kontaktowy na naszej stronie internetowej lub wysłać do nas e-maila.
              Skontaktujemy się z Tobą, aby umówić się na dogodny termin konsultacji
              online. Zapraszamy do skorzystania z bezpłatnej konsultacji i rozpoczęcia
              swojej przygody z nauką języka obcego w naszej szkole!</p>
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
            <p>Jeśli posiadasz voucher na kurs językowy, możesz zrealizować go poprzez
              kontakt mailowy z naszą szkołą języków obcych online. Prześlij nam na
              adres e-mailowy, który znajdziesz na voucherze, informacje dotyczące
              Twojego imienia i nazwiska oraz daty ważności vouchera.</p>
            <p>Skontaktujemy się z Tobą i przedstawimy Ci kursy dostępne w ramach
              vouchera, a także zaproponujemy dogodny termin zajęć. W przypadku
              wyboru kursu indywidualnego, będziemy potrzebować dodatkowych
              informacji na temat Twojego poziomu językowego i celów nauki, aby
              dopasować program nauczania do Twoich potrzeb. Po potwierdzeniu
              wyboru kursu i terminów zajęć, przekażemy Ci wszelkie niezbędne
              informacje dotyczące dostępu do platformy Skype oraz instrukcje
              dotyczące realizacji vouchera. Zapewniamy pełne wsparcie w realizacji
              vouchera i jesteśmy dostępne, aby odpowiedzieć na wszystkie Twoje
              pytania i pomóc Ci w rozpoczęciu kursu językowego.</p>
          </div>
        </div>
    </div>

    <div id="section2" class="content hidden">
      <div class="accordion-item">
        <div class="accordion-header">Ile kosztuje kurs?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Ceny za zajęcia w naszej szkole znajdują się w sekcji “Cennik”. Ceny te
              zależą od rodzaju zajęć oraz ilości godzin.</p>
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-header">Czy otrzymam fakturę za zajęcia?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Tak. Do każdego zakupu wystawiana jest faktura. Przy dokonywaniu
            płatności zostaniesz poproszony o wpisanie danych do faktury, którą
            następnie otrzymasz na podany adres mailowy do 3 dni roboczych. W
            przypadku pytań dotyczących faktur zachęcamy do kontaktu:
            <b>kontakt@languelove.pl</b></p>
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-header">Kiedy należy zapłacić za kurs?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Za kurs należy zapłacić przed rozpoczęciem zajęć.</p>
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-header">Czy mogę zapłacić za lekcje w innej walucie niż złotówki?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Tak. Jeśli chcesz zapłacić za kurs w innej walucie, skontaktuj się z nami
            pod numerem telefonu +48 516632063 lub wysłać nam wiadomość na
            adres e-mail: <b>kontakt@languelove.pl</b>, poinformujemy Cię jak dokonać
            opłaty w innej walucie.</p>
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-header">Jak mam zapłacić za lekcję?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Po zalogowaniu się na naszej stronie, należy wybrać lektora oraz termin
            zajęć i przejść do płatności. Nasz system przeprowadzi Cię krok po kroku
            przez ten proces. Płatności dokonuje się przez system Przelewy24.</p>
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-header">Jakie formy płatności akceptujecie?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Płatności są realizowane za pomocą systemu Przelewy24. Będziesz mógł
            wybrać pomiędzy płatnością BLIK a przelewem online z Twojego banku.</p>
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-header">Jak mogę uzyskać zniżkę na naukę?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Śledź nas na Instagramie lub Facebooku lub zapisz się poniżej do naszego
            Newslettera, aby dostawać informacje o zniżkach.</p>
        </div>
      </div>

    </div>

    <div id="section3" class="content hidden">
    
      <div class="accordion-item">
        <div class="accordion-header">Czy mogę odwołać zajęcia?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Oczywiście. Masz prawo do odwołania zajęć indywidualnych i w parach 24
            godziny przed ich rozpoczęciem. W przeciwnym razie uznajemy, że
            zajęcia się odbyły. Zajęcia można odwołać ze swojego konta po
            zalogowaniu.</p>
        </div>
      </div>
    
      <div class="accordion-item">
        <div class="accordion-header">Czy mogę zmienić termin zajęć?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Tak, zmianę terminu zajęć indywidualnych i w parach można dokonać do
              24 godzin przed ich rozpoczęciem. Termin zajęć można zmienić ze
              swojego konta po zalogowaniu.</p>
        </div>
      </div>
    
      <div class="accordion-item">
        <div class="accordion-header">Co się dzieje w przypadku nieobecności na zajęciach?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>W przypadku zajęć grupowych i w parach otrzymasz nagranie lekcji (za
              zgodą grupy) lub wiadomość e-mail od lektorki, w której opisze Ci
              wszystko, co zostało zrobione na zajęciach i wyśle materiały. W przypadku
              zajęć indywidualnych- pamiętaj o możliwości odwołania zajęć do 24
              godzin przed ich rozpoczęciem.</p>
        </div>
      </div>
    
      <div class="accordion-item">
        <div class="accordion-header">Jakie są warunki rezygnacji z zajęć?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Zgodnie z naszym regulaminem zajęć możliwe jest zrezygnowanie z zajęć
              do 14 dni od daty zakupu kursu. Szczegółowe informacje dotyczące
              warunków rezygnacji znajdują się w regulaminie naszej szkoły na naszej
              stronie internetowej.</p>
        </div>
      </div>
    
      <div class="accordion-item">
        <div class="accordion-header">Czy mogę zawiesić kurs?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Zgodnie z naszym regulaminem Kursant ma prawo do odstąpienia od
              zawartej umowy w terminie 14 dni od daty jej zawarcia, za zwrotem
              wpłaconych kwot, pomniejszonych jednak o kwoty wykorzystane na
              zajęcia zrealizowane lub zajęcia nie odwołane najpóźniej na 24 godziny
              przed terminem zajęć.</p>
        </div>
      </div>

    </div>

    <div id="section4" class="content hidden">
      
      <div class="accordion-item">
        <div class="accordion-header">Jakie są wymagania techniczne dla uczestnictwa w zajęciach?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Do uczestnictwa w zajęciach wymagany jest komputer lub tablet z
            dostępem do Internetu oraz mikrofonem i kamerą internetową.
            Wymagana jest także stabilna łączność internetowa.</p>
        </div>
      </div>
      
      <div class="accordion-item">
        <div class="accordion-header">Na jakiej platformie odbywają się zajęcia?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Wszystkie nasze zajęcia odbywają się na Skype. Można pobrać aplikację
              na swoje urządzenie lub dołączać do zajęć z przeglądarki. Link do zajęć
              zostanie dostarczony mailowo przed rozpoczęciem zajęć. W przypadku
              problemów technicznych służymy pomocą.</p>
        </div>
      </div>
      
      <div class="accordion-item">
        <div class="accordion-header">Czy mogę wziąć udział w zajęciach łącząc się z telefonu lub tabletu?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Tak. Skype umożliwia łączenie się z urządzeń mobilnych, jednak zalecamy
              używanie komputera lub laptopa, ponieważ w ten sposób uczestnik widzi
              wszystkie dostępne opcje programu.</p>
        </div>
      </div>
      
      <div class="accordion-item">
        <div class="accordion-header">Czy poradzę sobie na zajęciach online jeśli nigdy nie używałam/em Skype’a?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Każdy uczestnik może zgłosić się do nas z prośbą o pomoc w instalacji i
              połączeniu się przez Skype przynajmniej dzień przed rozpoczęciem zajęć.
              Przypominamy, że do uczestniczenia w zajęciach nie potrzeba aplikacji.
              Na zajęcia można połączyć się poprzez przeglądarkę: Nawiązuj rozmowy
              wideo bezpośrednio w przeglądarce | Skype . Polecamy również
              skorzystanie z tej prostej instrukcji: <a href="https://support.skype.com/pl/faq/FA11098/jak-rozpoczac-korzystanie-z-programu-skype">Jak rozpocząć korzystanie z programu
              Skype? | Pomoc techniczna Skype.</a></p>
        </div>
      </div>
      
      <div class="accordion-item">
        <div class="accordion-header">Jak mam zweryfikować jakość dźwięku w komputerze?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Aby zweryfikować jakość dźwięku na swoim komputerze, można wykonać kilka prostych kroków:</p>
          <p>1. Sprawdź ustawienia dźwięku w systemie operacyjnym - upewnij się,
            że głośniki lub słuchawki są ustawione jako urządzenie wyjściowe
            dźwięku, a głośność jest ustawiona na odpowiednim poziomie.</p>
          <p>2. Spróbuj odtworzyć różne rodzaje plików dźwiękowych, takie jak
            piosenki, filmy lub nagrania wokalu, aby sprawdzić, czy dźwięk jest
            czysty i wyraźny.</p>
          <p>3. Wypróbuj różne źródła dźwięku, takie jak różne strony internetowe
            lub programy, aby sprawdzić, czy jakość dźwięku jest taka sama na
            każdym źródle.</p>
          <p>4. Sprawdź, czy na komputerze nie są włączone inne programy lub
            aplikacje, które mogą wpływać na jakość dźwięku, takie jak
            programy do nagrywania dźwięku lub inne programy odtwarzające
            dźwięk.</p>
          <p>5. Jeśli po wykonaniu powyższych kroków dźwięk nadal nie jest
            wyraźny lub ma niską jakość, warto spróbować podłączyć inne
            urządzenia wyjściowe dźwięku, takie jak nowe głośniki lub
            słuchawki, aby sprawdzić, czy to urządzenie jest problemem.</p>
          <p>Jeśli wciąż masz problemy z jakością dźwięku, warto skonsultować się z
            serwisem komputerowym lub skontaktować się z producentem
            urządzenia, aby uzyskać pomoc techniczną.</p>
        </div>
      </div>
      
      <div class="accordion-item">
        <div class="accordion-header">Czy podczas lekcji powinnam/powinienem używać słuchawek?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Nie jest to konieczne, ale, zalecamy używanie słuchawek podczas lekcji
            online. Używanie słuchawek pozwoli na wyraźne i klarowne słyszenie
            nauczyciela oraz innych uczestników lekcji, a jednocześnie zminimalizuje
            hałas otoczenia, który może wpływać na jakość dźwięku. Dodatkowo,
            używanie słuchawek pozwoli na uniknięcie zakłóceń dźwiękowych z
            innych urządzeń w pobliżu, które mogą wpłynąć na jakość dźwięku
            podczas lekcji.</p>
        </div>
      </div>
      
      <div class="accordion-item">
        <div class="accordion-header">Jakie wymagania musi spełniać mój komputer oraz moje łącze internetowe?<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Jeśli martwisz się o to, czy Twój komputer spełnia wymagania sprzętowe polecamy Ci sprawdzić ten link: <a href="https://www.skype.com/pl/get-skype">https://www.skype.com/pl/get-skype</a></p>
          <p>Aby zapewnić odpowiednią jakość dźwięku podczas lekcji online, warto wziąć pod uwagę kilka czynników:</p>
          <p>1. Użyj słuchawek - używanie słuchawek pozwoli na wyraźne i
              klarowne słyszenie nauczyciela oraz innych uczestników lekcji, a
              jednocześnie zminimalizuje hałas otoczenia, który może wpływać
              na jakość dźwięku.</p>
          <p>2. Wybierz ciche miejsce - wybierz ciche miejsce do przeprowadzenia
              lekcji online, aby zminimalizować hałas otoczenia. Upewnij się, że w
              pobliżu nie ma źródeł dźwięku, takich jak urządzenia AGD, otwarte
              okna, czy głośne otoczenie.</p>
          <p>3. Sprawdź połączenie internetowe - upewnij się, że masz stabilne
            połączenie internetowe, które zapewni odpowiednią prędkość
            pobierania i wysyłania danych podczas lekcji online. Można to
            zrobić za pomocą testów prędkości internetu.</p>
          <p>4. Skonsultuj się z nauczycielem - skonsultuj się z nauczycielem, aby
              upewnić się, że korzystasz z odpowiednich narzędzi i ustawień
              podczas lekcji online. Nauczyciel może zaoferować wskazówki i
              porady dotyczące poprawy jakości dźwięku podczas lekcji online.</p>
          <p>Pamiętaj, że odpowiednia jakość dźwięku podczas lekcji online jest kluczowa dla skutecznego uczenia się języka obcego.</p>
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