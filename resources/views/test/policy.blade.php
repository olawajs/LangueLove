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

</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet"> 

<link href="{{ asset('css/owlCarousel/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/owlCarousel/owl.theme.default.min.css') }}" rel="stylesheet">
@section('content')
<div class="container row"><!-- desktop -->
  <div class="col-12 FileHead">
      <div class="smallFileText">NASZE ZASADY</div>
      <div class="bigFileText">Polityka Prywatności</div>
  </div>
  <div class="col-2"></div>
  <div class="accordion col-8">
      <div class="accordion-item">
        <div class="accordion-header">1. Informacje ogólne<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>
            1. Niniejsza polityka dotyczy strony internetowej znajdująca się pod domeną: www.languelove.pl
          </p>
          <p>
            2. Administratorem danych osobowych jest: LangueLove Wiktoria Skrzypczak
            i Weronika Cieślak s.c. z siedzibą w Krakowie 31 – 455, przy ul. Łaszkiewicza 4/39.
          </p>
          <p>
            3. Adres kontaktowy Administratora danych: kontakt@languelove.pl
          </p>
          <p>
            4. Administrator zarządza danymi osobowymi w odniesieniu do danych podanych
            dobrowolnie w procesie rejestracji i zawierania umów.
          </p>
          <p>
            5. Strona internetowa wykorzystuje dane osobowe w celu:
            <p>a. Zaprezentowania profilu użytkownika innym użytkownikom</p>
            <p>b. Obsługi zapytań przez formularz kontaktowy</p>
            <p>c. Realizacji zamówionych usług edukacyjnych</p>
            <p>d. Prezentacji oferty lub informacji</p>
          </p>
          <p>
            6. Strona internetowa pozyskuje dane użytkowników i ich zachowania poprzez
            dobrowolne wprowadzenie danych w formularzach oraz poprzez obsługę plików cookie
          </p>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">2. Podstawa przetwarzania danych osobowych<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>
            1. Dane osobowe są przetwarzane zgodnie z przepisami Rozporządzenia Parlamentu
              Europejskiego i Rady (UE) 2016/679 z dnia 27 kwietnia 2016 r. w sprawie ochrony
              osób fizycznych w związku z przetwarzaniem danych osobowych i w sprawie
              swobodnego przepływu takich danych.
          </p>
          <p>
            2. Administrator przetwarza dane osobowe wyłącznie po uprzednim uzyskaniu zgody Użytkownika.
          </p>
          <p>
            3. Wyrażenie zgody na przetwarzanie danych osobowych jest całkowicie dobrowolne.
          </p>
        </div>
      </div>
      <div class="accordion-item">
          <div class="accordion-header">3. Prawa Użytkownika<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
              1. Użytkownik ma prawo żądania od Administratora dostępu do danych osobowych, ich
              sprostowania, usunięcia, ograniczenia przetwarzania oraz przenoszenia danych.
            </p>
            <p>
              2. Dane osobowe Użytkownika, nie będą przetwarzane przez Administratora dłużej,
              niż jest to konieczne do wykonania związanych z nimi czynności określonych osobnymi
              przepisami (np. o prowadzeniu rachunkowości). W odniesieniu do danych
              marketingowych dane nie będą przetwarzane dłużej niż przez 3 lata.
            </p>
            <p>
              3. Na działania Administratora przysługuje skarga do Prezesa Urzędu Ochrony Danych
              Osobowych, ul. Stawki 2, 00-193 Warszawa.
            </p>
            <p>
              4. Podanie danych osobowych jest dobrowolne, lecz niezbędne do korzystania ze strony internetowej.
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-header">4. Powierzenie przetwarzania danych innym podmiotom<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
              1. Administrator ma prawo przekazywać dane osobowe Użytkownika innym odbiorcom,
              jeśli będzie to niezbędne do wykonania zawartej umowy lub do zrealizowania
              obowiązków ciążących na Administratorze.
            </p>
            <p>
              2. Poza celami wskazanymi w Polityce Prywatności dane osobowe Użytkowników nie
              będą w żaden sposób udostępniane osobom trzecim ani przekazywane innym
              podmiotom, w celu przesyłania materiałów marketingowych tych osób trzecich.
            </p>
            <p>
              3. Dane osobowe nie są przekazywane do krajów trzecich w rozumieniu przepisów
              o ochronie danych osobowych (poza teren Unii Europejskiej).
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-header">5. Informacje w formularzach<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
            1. Strona internetowa zbiera informacje podane dobrowolnie przez Użytkownika, w tym
            dane osobowe, o ile zostaną one podane.
            </p>
            <p>
            2. Strona internetowa może zapisać informacje o parametrach połączenia internetowego.
            </p>
            <p>
              3. Strona internetowa, w niektórych wypadkach, może zapisać informację ułatwiającą
              powiązanie danych w formularzu z adresem e-mail użytkownika wypełniającego
              formularz.
            </p>
            <p>
              4. Dane podane w formularzu są przetwarzane w celu wynikającym z funkcji konkretnego
              formularza, Każdorazowo kontekst i opis formularza w czytelny sposób informuje,
              do czego on służy.
            </p>
          </div>
          </div>
          <div class="accordion-item">
            <div class="accordion-header">6. Informacja o narzędziach używanych na stronie<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
            <div class="accordion-content">
              <p>
              1. Google Analytics jest narzędziem służącym do analizowania usług i działań
              internetowych, takich jak m.in.: czas spędzony na stronie, ruch internetowy pomiędzy
              stronami, dane demograficzne i dane o zainteresowaniach. W tym celu pliki cookies są
              wykorzystywane przez firmę Google LLC. Na zbieranie danych wyraża się zgodę
              w ustawieniach plików cookies. Szczegółowe informacje dostępne na:
              https://analytics.google.com/analytics/web/provision/?hl=pl#/provision
              </p>
              <p>
              2. Google Tag Manager jest narzędziem służącym do kontrolowania kampanii reklamowej
              i sposobu korzystania ze strony internetowej. W tym celu pliki cookies są
              wykorzystywane przez firmę Google LLC. Na zbieranie danych wyraża się zgodę
              w ustawieniach plików cookies. Szczegółowe informacje dostępne na:
              https://marketingplatform.google.com/about/tag-manager/
              </p>
              <p>
              3. Google Ads jest narzędziem służącym do prowadzenia kampanii reklamowej. W tym
              celu pliki cookies są wykorzystywane przez firmę Google LLC. Na zbieranie danych
              wyraża się zgodę w ustawieniach plików cookies. Szczegółowe informacje dostępne na:
              https://ads.google.com/intl/pl_PL/home/?pli=1
              </p>
              <p>
              4. cux.io jest narzędziem służącym do analizowania zachowań użytkowników poprzez
              śledzenie wszystkich zdarzeń na stronie, m.in. za pomocą heatmapy. W tym celu pliki
              cookies są wykorzystywane przez cux.io. Na zbieranie danych wyraża się zgodę
              w ustawieniach plików cookies. Szczegółowe informacje dostępne na: https://cux.io/
              </p>
              <p>
              5. Facebook Piksel Meta jest narzędziem marketingowym firmy Facebook i służy
              do personalizowania reklam na platformie Facebook. W tym celu pliki cookies są
              wykorzystywane przez firmę Facebook. Na zbieranie danych wyraża się zgodę
              w ustawieniach plików cookies. Szczegółowe informacje dostępne na:
              https://www.facebook.com/business/help/742478679120153?id=1205376682832142
              </p>
            </div>
          </div>
         <div class="accordion-item">
          <div class="accordion-header">7. Informacja o plikach cookies<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
            6. Strona internetowa korzysta z plików cookies.
            </p>
            <p>
            7. Pliki cookies (tzw. „ciasteczka”) stanowią dane informatyczne, w szczególności pliki
            tekstowe, które przechowywane są w urządzeniu końcowym Użytkownika
            i przeznaczone są do korzystania ze stron internetowych. Cookies zazwyczaj zawierają
            nazwę strony internetowej, z której pochodzą, czas przechowywania ich na urządzeniu
            końcowym oraz unikalny numer.
            </p>
            <p>
            8. Podmiotem zamieszczającym na urządzeniu końcowym Użytkownika pliki cookies
            oraz uzyskującym do nich dostęp jest operator strony internetowej.
            </p>
            <p>
            9. Pliki cookies wykorzystywane są w celu utrzymania sesji użytkownika
            (po zalogowaniu), dzięki której użytkownik nie musi na każdej podstronie ponownie
            wpisywać loginu i hasła;
            </p>
            <p>
            10. Oprogramowanie do przeglądania stron internetowych (przeglądarka internetowa)
            zazwyczaj domyślnie dopuszcza przechowywanie plików cookies w urządzeniu
            końcowym Użytkownika. Użytkownicy mogą dokonać zmiany ustawień w tym
            zakresie. Przeglądarka internetowa umożliwia usunięcie plików cookies. Możliwe jest
            także automatyczne blokowanie plików cookies
            </p>
            <p>
            11. Ograniczenia stosowania plików cookies mogą wpłynąć na niektóre funkcjonalności
            dostępne na stronie internetowej.
            </p>
          </div>
        </div>
      <!-- Dodaj więcej takich elementów, jeśli potrzebujesz -->
        <!-- <div class="accordion-item">
          <div class="accordion-header">Pytanie 2 <span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>Odpowiedź na pytanie 2.</p>
          </div>
        </div> -->
  </div>
  <div class="col-2"></div>
</div>
  

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
</script>