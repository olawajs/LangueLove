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
      <div class="bigFileText">Regulamin LangueLove</div>
  </div>
  <div class="col-2"></div>
  <div class="accordion col-8">
      <div class="accordion-item">
        <div class="accordion-header">1. Definicje<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>Niniejszy regulamin nadaje używanym w jego treści słowom następujące definicje:</p>
            <p> 
              a) Strona internetowa – serwis internetowy znajdujący się pod domeną www.languelove.pl ,
              służący do świadczenia usług elektronicznych obejmujących zajęcia online
              oraz zapisy na zajęcia elektroniczne i stacjonarne, a także sklep internetowy.
            </p>
            <p>
              b) Formularz - formularz elektroniczny będący narzędziem Google i służący
              do samodzielnego zapisywania na wybrane zajęcia.
            </p>
            <p>
              c) Platforma – narzędzie Skype służące do zdalnej komunikacji, służące do prowadzenia
              i uczestniczenia w zajęciach.
            </p>
            <p>
              d) Narzędzia elearningowe - zbiorcza nazwa Strony internetowej, Formularza
              oraz Platformy.
            </p>
            <p>
              e) Użytkownik - osoba fizyczna, osoba prawna lub jednostka organizacyjna nieposiadająca
              osobowości prawnej, która posiada zdolność do czynności prawnych, korzystająca z
              zawartości i treści dostępnych w ramach świadczonych usług elektronicznych poprzez
              Narzędzia elearningowe. Użytkownik może być także klientem Właściciela w sytuacji gdy
              zakupi od właściciela usługę lub towar.
            </p>
            <p>
              f) Właściciel - LangueLove Wiktoria Skrzypczak i Weronika Cieślak spółka cywilna,
              prowadząca działalność gospodarczą
              w Krakowie 31 – 445, przy ul. Łaszkiewicza 4/39, posiadająca numer REGON:
              524063176 oraz numer NIP: 9452266907.
            </p>
            <p>
              g) Kursant – osoba, która uiściła samodzielnie lub na rzecz której uiszczono wymaganą opłatę
              i korzysta z usług świadczonych przez Właściciela na mocy Regulaminu oraz innych umów
              zawartych z Właścicielem.
            </p>
            <p>
              h) Klient instytucjonalny - przedsiębiorca prowadzący działalność gospodarczą
              na własny rachunek, osoba prawna oraz jednostka organizacyjna nieposiadająca
              osobowości prawnej, który wykupił u Właściciela towar lub usługę.
            </p>
            <p>
              i) Lektor - Właściciel lub osoba prowadząca zajęcia edukacyjne z Kursantami, związana
              zawartą z Właścicielem umową.
            </p>
            <p>
              j) Cennik - wykaz opłat za zajęcia świadczone przez Właściciela za pomocą Platformy oraz w
              trybie stacjonarnym obejmującym zajęcia dla Kursantów w opcji zajęć indywidulanych oraz
              w opcji zajęć grupowych.
            </p>
            <p>
              k) Regulamin – niniejszy regulamin, który zawiera ramowe warunki współpracy między
              Właścicielem a Użytkownikiem.
            </p>
            <p>
              l) Umowa o świadczenie usług edukacyjnych – umowa dookreślająca szczegółowe i
              indywidualne warunki współpracy między Właścicielem a Użytkownikiem w szczególności
              takie jak wymiar czasowy i sposób świadczenia usług edukacyjnych na rzecz danego
              Użytkownika (Kursanta).
            </p>
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-header">2. Postanowienia ogólne<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>
            1. Regulamin określa ogólne warunki dostępu i korzystania z Narzędzi elearningowych.
          </p>
          <p>
            2. W przypadku sprzeczności postanowień Regulaminu z Umową o świadczenie usług
            edukacyjnych, stosuje się postanowienia Umowy o świadczenie usług edukacyjnych.
          </p>
          <p>
            3. Właściciel zapewnia dostęp do Narzędzi elearningowych zgodnie z Regulaminem.
          </p>
          <p>
            4. Użytkownicy mogą korzystać z dostępu i usług oferowanych przez Narzędzia elearningowe pod
            warunkiem uprzedniego zapoznania się i zaakceptowania treści Regulaminu.
          </p>
          <p>
            5. Strona internetowa oraz Formularz są obsługiwane przez wszelkiego rodzaju przeglądarki
            i nternetowe. Platforma wymaga od Użytkownika aktywnego konta Skype.
          </p>
          <p>
            6. Użytkownicy mogą korzystać z Narzędzi elearningowych z poszanowaniem przepisów ustaw
            powszechnie obowiązującego prawa, w tym w szczególności ustaw: prawo
            telekomunikacyjne, o świadczeniu usług drogą elektroniczną
            oraz kodeksu cywilnego.
          </p>
          <p>
            7. Zabrania się korzystania z Narzędzi elearningowych:
            <p>
              a) w sposób naruszający obowiązujące przepisy prawa lub zasady współżycia społecznego,
            </p>
            <p>
              b) do celów związanych z wyrządzaniem szkody małoletnim lub prób ich wyrządzenia,
            </p>
            <p>
              c) w sposób naruszający Regulamin,
            </p>
            <p>
              d) wysyłania i przetwarzania jakichkolwiek form zaliczanych do niepożądanej kategorii SPAM.
            </p>
          </p>
          <p>
            8. Właściciel nie ponosi odpowiedzialności za treści znajdujące się na innych witrynach ani za
            poniesione z ich powodu szkody, do których odnośniki znalazły się na Stronie internetowej lub
            zostały udostępnione przez formularz lub platformę w celach informacyjnych.
          </p>
          <p>
            9. Narzędzia elearningowe oraz ich treści mogą być chronione prawami własności intelektualnej,
            co oznacza, że Użytkownik bez pisemnej zgody Właściciela
            nie ma prawa wykorzystywać powyższych treści.
          </p>
          <p>
            10. Właściciel dba o politykę prywatności Użytkowników – szczegółowe informacje dotyczące
            gromadzenia i przetwarzania danych osobowych znajdują się w Polityce Prywatności,
            znajdującej się na Stronie internetowej oraz w odnośniku dostępnym z poziomu formularza.
          </p>
          <p>
            11. Korzystanie z usług w ramach Narzędzi elearningowych wymaga posiadania komputera,
            tabletu, zaawansowanego telefonu komórkowego (smartfona) czy innego podobnego
            urządzenia posiadającego głośnik lub wejście słuchawkowe oraz mikrofon, przeglądarkę
            internetową z ustawieniem pozwalającym na wykorzystanie cookies, utrzymywanie
            w panelu Użytkownika wyłącznie połączeń szyfrowanych SSL i adresu poczty elektronicznej
            służącego do komunikacji.
          </p>
          <p>
            12. Osoby korzystające z Narzędzi elearningowych powinny chronić dostęp do haseł
            przed osobami nieupoważnionymi oraz stosować oprogramowanie antywirusowe
            i zapory sieciowe. Ze swojej strony Właściciel wykorzystuje zabezpieczenia techniczne
            uniemożliwiające dostęp osób nieuprawnionych do danych osób korzystających
            z Narzędzi elearningowych na poziomie zwyczajowo wymaganym w usługach podobnego
            rodzaju. Ponadto Właściciel zapewnia, że udostępnione przez niego oprogramowanie jest
            wolne od wirusów komputerowych, programów szpiegowskich
            i podobnego oprogramowania.
          </p>
          <p>
            13. Osoby korzystające z Narzędzi elearningowych zobowiązują się nie wykorzystywać Narzędzi
            elearningowych w sposób bezprawny lub do celów niezgodnych z Regulaminem.
          </p>
          <p>
            14. Wysokość należnego wynagrodzenia za lekcje jest wskazana bezpośrednio na podstronie
            każdego lektora.
          </p>
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-header">3. Postanowienia dotyczące Kursanta <span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
        <div class="accordion-content">
          <p>
            1. Kursantem może zostać tylko osoba pełnoletnia, a osoba małoletnia, która ukończyła lat 13 –
              tylko za zgodą rodziców lub opiekunów prawnych. Wymagany podpis rodzica lub opiekuna
              prawnego pod dokumentem Zgody, który stanowi Załącznik 3 do Regulaminu. Zgoda musi
              zostać wypełniona i wysłana na adres mailowy kontakt@languelove.pl przed rozpoczęciem
              zajęć.
          </p>
          <p>
            2. Właściciel zawiera umowę o świadczenie usług edukacyjnych z Kursantem obejmującą
              wybrane przez Kursanta zajęcia, których dane szczegółowe łącznie z ofertą udostępnia się
              każdorazowo na Stronie internetowej lub poprzez Formularz.
          </p>
          <p>
            3. Właściciel udostępnia Kursantowi lub potencjalnemu Kursantowi za pośrednictwem Strony
              internetowej ogólne informacje niezbędne do rozpoczęcia świadczenia usług takie jak opis
              świadczonych usług, Regulamin czy Cennik.
          </p>
          <p>
            4. Zawarcie umowy o świadczenie usług edukacyjnych następuje poprzez wykorzystanie narzędzi
              informatycznych Strony internetowej, przez kontakt mailowy
              i przez Formularz.
          </p>
          <p>
            5. Warunkiem zawarcia umowy jest akceptacja Regulaminu, założenie konta na Stronie
              internetowej lub przesłanie niezbędnych informacji przesłanych pocztą elektroniczną lub
              wypełnienie i wysłanie Formularza oraz dokonanie opłaty zgodnie z każdorazowo dostępnym
              opisem na Stronie internetowej lub informacji przesłanej pocztą elektroniczną. Dostępne
              formy płatności to płatność przelewem tradycyjnym oraz za pomocą systemu Przelewy24.
          </p>
          <p>
            6. Skutkiem zawarcia umowy i dokonania płatności jest otrzymanie dostępu do zajęć
              z Lektorem we wskazanym w umowie terminie i czasie.
          </p>
          <p>
            7. Kursant ma prawo do odstąpienia od zawartej umowy w terminie 14 dni od daty jej zawarcia,
              za zwrotem wpłaconych kwot, pomniejszonych jednak o kwoty wykorzystane na zajęcia
              zrealizowane lub zajęcia nie odwołane najpóźniej na 24 godziny
              przed terminem zajęć.
          </p>
          <p>
            8. Zajęcia inne niż grupowe mogą być odwołane lub przełożone najpóźniej 24 godziny przed
              ustalonym terminem zajęć. W pozostałych przypadkach pobierana jest opłata za gotowość
              do przeprowadzenia zajęć w wysokości wynagrodzenia za przeprowadzenie zajęć
              ze względu na koszty ponoszone przez Właściciela w celu rezerwacji terminu zajęć.
          </p>
          <p>
            9. Zajęcia w parze mogą być odwołane lub przełożone wyłącznie w przypadku gdy obydwie osoby
              odwołują zajęcia i z zachowaniem terminu określonego w punkcie 8. powyżej. W przypadku
              gdy zajęcia odwoła tylko jedna z osób z pary, zajęcia odbywają się w trybie indywidualnym dla
              drugiego Kursanta przy czy cena nie podlega zmianie (aktualizacji).
          </p>
          <p>
            10. Zajęcia można odwołać lub przełożyć za pośrednictwem Strony internetowej
              lub za pomocą poczty elektronicznej.
          </p>
          <p>
            11. Zakupione zajęcia poza pakietem powinny zostać zrealizowane nie później niż w terminie 30
              dni od opłacenia.
          </p>
          <p>
            12. Zajęcia odbywają się w trybie indywidualnym, w parze lub w trybie grupowym.
          </p>
          <p>
            13. Zajęcia grupowe liczą nie mniej niż cztery i nie więcej niż sześć Kursantów, przy czym Właściciel
              zastrzega sobie prawo do przełożenia daty rozpoczęcia lub odwołania kursu w razie braku
              zebrania minimum 4 osób na dany kurs i zwrotu pieniędzy za opłacony kurs. Kursantowi
              przysługuje wówczas także prawo do zmiany trybu kursu na zajęcia indywidualne lub w parze
              za stosowną dopłatą. Ponadto Właściciel zastrzega sobie prawo do zmiany Lektora
              prowadzącego.
          </p>
          <p>
            14. Opłacone zajęcia grupowe nie mogą być jednostronnie odwołane przez Kursanta lub
              Kusantów     
          </p>
          <p>
            15. W przypadku nieobecności Kursanta w zajęciach grupowych, Właściciel zapewnia kursantowi
              dostęp do materiałów z zajęć, w których Kursant nie uczestniczył,
              z wyłączeniem możliwości zwrotu środków za opuszczone zajęcia.
          </p>
          <p>
            16. Kursant może podjąć próbę umówienia zajęć z wyprzedzeniem co najmniej 12 godzin. Zajęcia
              uznaje się za zamówione tylko w przypadku uprzedniej akceptacji ich terminu przez Lektora,
              przy czym Lektor nie ma obowiązku akceptacji danego terminu lub zajęć z danym Kursantem.
          </p>
          <p>
            17. Kursant otrzymuje potwierdzenie akceptacji terminu zajęć przez Lektora za pośrednictwem
              wiadomości e-mail oraz poprzez funkcjonalność kalendarza dostępną po zalogowaniu się na
              Konto użytkownika. Akceptacja terminu zajęć przez Lektora jest równoznaczna z
              potwierdzeniem realizacji zajęć przez Właściciela.
          </p>
          <p>
            18. W przypadku spóźnienia Kursanta na zajęcia nie zostają one przedłużone.
          </p>
          <p>
            19. W przypadku nieobecności Lektora na zajęciach, Kursantowi przysługuje prawo do odbycia
              zajęć w innym, ustalonym wspólnie z Lektorem terminie lub do zwrotu opłaty za te zajęcia wg
              wyboru Kursanta.
          </p>
          <p>
            20. Zajęcia mogą być nagrywane w formacie audio lub wideo za uprzednią wyraźną zgodą
              wszystkich Kursantów oraz Lektora. Nagranie będzie bezpłatnie udostępniane drogą
              elektroniczną (Skype) wszystkim Kursantom z zastrzeżeniem, że może ono być
              wykorzystywane wyłącznie do własnych (wewnętrznych) celów naukowych i nie może być
              udostępniane osobom trzecim.
          </p>
          <p>
            21. Kursant wyraża zgodę na świadczenie usługi edukacyjnej w terminie określonym podczas
              zawarcia umowy o świadczenie usług edukacyjnych. Po zrealizowaniu usługi edukacyjnej
              Kursant traci prawo odstąpienia od umowy.
          </p>
          <p>
            22. Kursant ma prawo do złożenia reklamacji w formie pisemnej na adres: LangueLove Wiktoria
              Skrzypczak i Weronika Cieślak spółka cywilna, Kraków 31 – 445, ul. Łaszkiewicza 4/39 lub
              elektronicznej na adres: kontakt@languelove.pl z tytułu jakości i sposobu wykonania usługi.
              Reklamacja zostanie rozpatrzona terminie 7 dni roboczych od wpływu reklamacji, a odpowiedź
              zostanie odesłana na adres, z którego reklamacja została zgłoszona. Uznanie reklamacji za
              zasadną wiąże się ze spełnieniem żądania Kursanta, w tym w szczególności ze zwrotem opłaty
              lub zmianą modelu świadczenia usługi.
          </p>
          <p>
            23. Zajęcia grupowe wykupowane są w pakietach, które są ograniczone czasowo. Szczegóły
              dotyczące opłat znajdują się bezpośrednio na podstronie każdego Lektora na stronie
              internetowej Właściciela.
          </p>
        </div>
      </div>
       <div class="accordion-item">
          <div class="accordion-header">4. Postanowienia dotyczące Klienta instytucjonalnego<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
              1. Właściciel zawiera umowę o świadczenie usług edukacyjnych z Klientem instytucjonalnym
              obejmującą wybrane przez Klienta instytucjonalnego zajęcia, których dane szczegółowe
              łącznie z ofertą udostępnia się każdorazowo na Stronie internetowej
              lub poprzez Formularz.
            </p>
            <p>
              2. Właściciel udostępnia za pośrednictwem poczty elektronicznej informacje
              oraz dokumenty niezbędne dla zawarcia umowy o świadczenie usług edukacyjnych oraz
              pomocne w procesie zapłaty za te usługi, oferty zawierające warunki świadczenia usług, w tym
              cenę, a także informacje o zawartych umowach i ich rozliczeniu. Każdorazowo wystawiana jest
              faktura na podstawie numeru NIP podanego przez Klienta instytucjonalnego.
            </p>
            <p>
              3. Zawarcie umowy o świadczenie usług edukacyjnych następuje poprzez wykorzystanie narzędzi
              informatycznych Strony internetowej, przez kontakt mailowy lub przez Formularz.
            </p>
            <p>
              4. Warunkiem zawarcia umowy jest akceptacja Regulaminu, założenie konta na Stronie
              internetowej lub wypełnienie Formularza i dokonanie opłaty zgodnie z każdorazowo
              dostępnym opisem na Stronie internetowej lub informacji przesłanej pocztą elektroniczna po
              wysłaniu Formularza. Dostępne formy płatności to płatność przelewem tradycyjnym lub
              systemem Przelewy24.
            </p>
            <p>
              5. Skutkiem zawarcia umowy jest otrzymanie dostępu do zajęć z Lektorem
              we wskazanym w umowie terminie i czasie.
            </p>
            <p>
              6. Zajęcia mogą być odwołane lub przełożone najpóźniej 24 godzin przed ustalonym terminem
              zajęć. W pozostałych przypadkach pobierana jest opłata za gotowość
              do przeprowadzenia zajęć w wysokości wynagrodzenia za przeprowadzenie zajęć ze względu
              na koszty ponoszone przez Właściciela w celu rezerwacji terminu zajęć.
            </p>
            <p>
              7. Zajęcia można odwołać lub przełożyć za pośrednictwem Strony internetowej
              lub poczty elektronicznej.
            </p>
            <p>
              8. Zakupione zajęcia poza pakietem powinny zostać zrealizowane nie później niż w terminie 30
              dni od opłacenia.
            </p>
            <p>
              9. Zajęcia odbywają się w trybie indywidualnym, w parze lub w trybie grupowym.
            </p>
            <p>
              10. Zajęcia grupowe liczą nie mniej niż cztery i nie więcej niż sześć osób, przy czym Właściciel
              zastrzega sobie prawo do odwołania zajęć w razie braku zebrania minimum 4 osób na dane
              zajęcia i zwrotu pieniędzy za opłacony kurs.
            </p>
            <p>
              11. Klient instytucjonalny wyraża zgodę na świadczenie usługi edukacyjnej w terminie określonym
              podczas zawarcia umowy o świadczenie usług edukacyjnych.
            </p>
            <p>
              12. Klient instytucjonalny ma prawo do złożenia reklamacji w formie pisemnej na adres:
              LangueLove Wiktoria Skrzypczak i Weronika Cieślak spółka cywilna, Kraków 31 – 445, ul.
              Łaszkiewicza 4/39 lub w formie elektronicznej na adres: kontakt@languelove.pl z tytułu jakości i sposobu wykonania usługi. Reklamacja
              zostanie rozpatrzona przez w terminie 7 dni roboczych od wpływu reklamacji, a odpowiedź
              zostanie odesłana na adres, z którego reklamacja została zgłoszona. Uznanie reklamacji za
              zasadną wiąże się ze spełnieniem żądania Kursanta, w tym w szczególności ze zwrotem opłaty
              lub zmianą modelu świadczenia usługi.
            </p>
            <p>
              13. Zajęcia grupowe wykupowane są w pakietach, które są ograniczone czasowo. Szczegóły
              dotyczące opłat znajdują się bezpośrednio na podstronie każdego Lektora na stronie
              internetowej Właściciela.
            </p>
            <p>
              14. Na życzenie Klienta instytucjonalnego Właściciel przygotuje ofertę kursu mającego na celu
              spełnienie indywidualnych potrzeb danego Klienta instytucjonalnego na podstawie
              zgłoszonego przez Klienta instytucjonalnego zapotrzebowania.
            </p>
          </div>
        </div>
         <div class="accordion-item">
          <div class="accordion-header">5. Usługi dodatkowe i dostosowane do indywidualnych potrzeb <span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
              1. Właściciel oferuje zajęcia w parach pod warunkiem, że dwie osoby zgłaszają chęć do
              uczestnictwa w jednej parze. W przypadku takich zajęć płatność pobierana jest za zajęcia
              łącznie.
            </p>
            <p>
              2. W przypadku rezygnacji z zajęć w parze jednego z Kursantów, zajęcia odbywają się od tego
              momentu do zakończenia kursu w trybie zajęć indywidualnych dla jednej osoby przy czym ich
              cena nie podlega zmianie (aktualizacji).
            </p>
            <p>
              3. Właściciel udostępnia możliwość zakupu pakietów 5 lub 10 lub 30 zajęć indywidualnych lub
              realizowanych w parze. Zajęcia muszą zostać zrealizowane odpowiednio w terminie 5, 10 lub
              30 tygodni licząc od momentu zrealizowania pierwszych zajęć z pakietu, w innym przypadku
              niewykorzystane zajęcia przepadają. Pierwsze zajęcia z zakupionego pakietu powinny zostać
              zrealizowane nie później niż w terminie 30 dni od opłacenia pakietu.
            </p>
            <p>
              4. W przypadku całkowitej niedostępności Lektora Kursant ma prawo do jego zmiany lub zwrotu
              kosztów za niewykorzystane zajęcia z pakietu. 
            </p>
            <p>
              5. Webinary bezpłatne odbywają się niezależnie od ilości zapisanych lub uczestniczących w nich
              uczestników.
            </p>
            <p>
              6. Webinary płatne odbywają się tylko w przypadku zebrania minimalnej grupy czterech
              uczestników. W przypadku mniejszej liczby uczestników, webinar zostaje odwołany, a
              poniesione opłaty zostają zwrócone.
            </p>
            <p>
              7. Właściciel oferuje sprzedaż voucherów prezentowych do wykorzystania przez obdarowaną
              osobę na zajęcia indywidualne. Voucher może zostać wykupiony za dowolną kwotę, nie
              mniejszą niż wartość jednych zajęć i może zostać wykorzystany w terminie do sześciu miesięcy
              od daty zakupu, przy uwzględnieniu dostępności Lektorów.
            </p>
            <p>
              8. Zakup vouchera na zajęcia indywidualne odbywa się za pośrednictwem poczty e-mail, należy
              wysłać zapytanie na adres: kontakt@languelove.pl wskazując liczbę zajęć do wykupienia oraz
              wybrany język do nauki. W odpowiedzi zainteresowany otrzyma wycenę i szczegółowe warunki,
              a po ich potwierdzeniu, dane do płatności.
            </p>
            <p>
              9. Właściciel zastrzega sobie prawo do organizacji zajęć oraz świadczenia pozostałych usług także
              na innych warunkach niż te określone w Regulaminie za uprzednią wyraźną zgodą Kursanta lub
              Użytkownika i w sposób nie naruszający powszechnie obowiązujących przepisów prawa w tym
              w szczególności praw przysługujących konsumentom.
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-header">6. Płatności <span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
              1. Wykupione zajęcia oraz inne usługi, a także towary dostępne w sklepie internetowym są
              opłacane z góry przez Kursanta lub Klienta instytucjonalnego.
            </p>
            <p>
              2. Dostępne metody płatności to tradycyjny przelew oraz system płatności błyskawicznych Przelewy24.
            </p>
            <p>
              3. W przypadku korzystania z tradycyjnego przelewu, płatność musi zostać zaksięgowana na
              rachunku bankowym Właściciela przed rozpoczęciem zajęć, których dotyczy dana płatność.
            </p>
            <p>
              4. Kursant lub Klient instytucjonalny dokonuje wyboru metody płatności podczas zakupu pakietu
              zajęć lub innej usługi z oferty Właściciela.
            </p>
            <p>
              5. Kursant lub Klient instytucjonalny wyraża zgodę na odbiór faktur w formie elektronicznej w
              formacie PDF wysyłanych za pośrednictwem poczty e-mail.
            </p>
            <p>
              6. Dane do faktury powinny zostać wprowadzone w momencie płatności za pośrednictwem
              dedykowanego formularza dostępnego w procesie płatności.
            </p>
            <p>
              7. Właściciel nie odpowiada za problemy z płatnością związane z niewłaściwym działaniem
              systemu Przelewy24 lub innego zewnętrznego dostawcy usług płatniczych.
            </p>
          </div>
        </div>
         <div class="accordion-item">
          <div class="accordion-header">7. Rejestracja konta <span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
              8. Posiadanie konta użytkownika jest niezbędne do skorzystania z funkcjonalności takich jak:
                <p> a) umówienie, odwołanie, przełożenie zajęć lub bezpłatnej konsultacji;</p>
                <p>b) kontakt z lektorem;</p>
                <p>c) zakup pakietów zajęć;</p>
                <p>d) dostęp do osobistego kalendarza.</p>
            </p>
            <p>
              9. Użytkownik rejestruje konto na Stronie internetowej poprzez kliknięcie przycisku „rejestracja”
              oraz uzupełnienie danych: imię, nazwisko, adres e-mail, hasło.
            </p>
            <p>
              10. Użytkownik rejestrując konto, akceptuje warunki Regulaminu po uprzednim zapoznaniu się z jego treścią.
            </p>
            <p>
              11. Przeglądanie Strony internetowej nie wymaga rejestracji poza funkcjonalnościami dostępnymi
              tylko dla zarejestrowanych Użytkowników.
            </p>
            <p>
              12. Rejestracja jest przeznaczona wyłącznie dla pełnoletnich osób fizycznych, posiadających pełną
              zdolność do czynności prawnych, osób prawnych lub jednostek organizacyjnych
              nieposiadających osobowości prawnej, której ustawa przyznaje zdolność prawną, a ponadto dla
              osób niepełnoletnich, które ukończyły 13 rok życia za uprzednią wyraźną zgodą rodzica lub
              opiekuna prawnego. Przed rozpoczęciem zajęć musi zostać wypełniona i wysłana na adres
              mailowy kontakt@languelove.pl Zgoda, która stanowi załącznik nr 3 do Regulaminu.
            </p>
            <p>
              13. Rejestracja konta i korzystanie z funkcjonalności Strony internetowej są bezpłatne przez czas nieokreślony.
            </p>
            <p>
              14. Podczas rejestracji konta, Użytkownik samodzielnie ustala hasło. Wymagania dotyczące hasła
              (liczba i rodzaj znaków) przekazywane są Użytkownikowi podczas rejestracji, za pośrednictwem
              funkcjonalności Strony internetowej.
            </p>
            <p>
              15. Logowanie do konta odbywa się poprzez podanie adresu e-mail i hasła.
            </p>
            <p>
              16. Nie ma możliwości rejestracji i założenia konta przy użyciu adresu e-mail, na podstawie którego
              istnieje już inne konto.
            </p>
            <p>
              17. Użytkownik jest zobowiązany do zachowania hasła w poufności. Udostępnienie hasła osobom
                trzecim następuje na ryzyko Użytkownika, który ponosi pełną odpowiedzialność w tym
                względzie. W razie zaistnienia okoliczności wskazujących na podejrzenie, że hasło Użytkownika
                znalazło się w posiadaniu osoby nieuprawnionej, Użytkownik ma obowiązek niezwłocznego
                zawiadomienia o tym fakcie Właściciela.
            </p>
            <p>
              18. Użytkownik ma prawo, w każdym czasie, bez podania przyczyn i bez ponoszenia z tego tytułu
              jakichkolwiek opłat, do zrezygnowania i usunięcia swojego konta. W celu wyrejestrowania
              należy po zalogowaniu się wybrać przycisk „usuń konto” w zakładce „moje konto” albo wysłać
              wiadomość e-mail na adres kontakt@languelove.pl z prośbą o wyrejestrowanie. Po otrzymaniu
              takiego żądania przez Właściciela konto zostanie niezwłocznie usunięte z systemu
              informatycznego przez Właściciela, w każdym przypadku w terminie nie dłuższym niż 30 dni od
              daty otrzymania żądania od Użytkownika.
            </p>
            <p>
              19. W przypadku usunięcia konta wszystkie dane zostaną usunięte, za wyjątkiem danych
              niezbędnych do procesu reklamacji i obsługi ewentualnych roszczeń, które będą
              przechowywane do czasu upływu okresów przedawnienia roszczeń wynikających w
              szczególności ze zrealizowanych usług. Konto może zostać automatycznie usunięte w
              przypadku braku jakiejkolwiek aktywności Użytkownika przez okres 2 lat.
            </p>
            <p>
              20. Do usunięcia konta dochodzi również w przypadku złożenia przez Użytkownika oświadczenia o
              braku akceptacji zmian Regulaminu.
            </p>
            <p>
              21. W uzasadnionych sytuacjach możliwość korzystania przez Użytkownika z konta może zostać
              ograniczona lub zawieszona. Właściciel niezwłocznie poinformuje Użytkownika drogą
              elektroniczną (e-mail) o ograniczeniu lub zawieszeniu możliwości korzystania z konta i jego
              przyczynie.
            </p>
            <p>
              22. W przypadku uporczywego naruszania Regulaminu przez Użytkownika, Właściciel może usunąć
              konto Użytkownika, wówczas Użytkownik nie będzie mógł ponownie dokonać rejestracji bez
              uprzedniej zgody Właściciela.
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-header">8. Sklep internetowy <span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
              1. Właściciel prowadzi sprzedaż ebooków, webinarów, voucherów, warsztatów online i kursów
              online za pośrednictwem sklepu internetowego dostępnego pod adresem: www.languelove.pl
            </p>
            <p>
              2. Zamówienia mogą składać Użytkownicy, którzy posiadają aktywne konto jak i Użytkownicy,
              którzy bez rejestracji dokonują zakupu w tzw. trybie jednorazowym.
            </p>
            <p>
              3. Dostawa jest realizowana w terminie określonym na Stronie internetowej jednak nie później
              niż w terminie 30 dni od złożenia zamówienia.
            </p>
            <p>
              4. Zamówienie może być złożone jeżeli adres dostawy wskazany przez Użytkownika znajduje się
              na terytorium Rzeczpospolitej Polskiej.
            </p>
            <p>
              5. W celu złożenia zamówienia Użytkownik powinien:
                <p>a. wybrać towar będący przedmiotem zamówienia, a następnie kliknąć przycisk „Do
                koszyka” lub „Kup teraz”, wybrać termin i sposób dostawy i płatności przedmiotu
                zamówienia;</p>
                <p>b. wpisać dane odbiorcy zamówienia oraz adres, na który ma nastąpić dostawa towaru
                lub wybrać opcję odbioru osobistego, a także numer telefonu, pod którym Właściciel
                może skontaktować się z Użytkownikiem w sprawach związanych z zamówieniem;</p>
                <p>c. wpisać dane rozliczeniowe do faktury;</p>
                <p> d. potwierdzić zamówienie przyciskiem: „Zamawiam i płacę”;</p>
                <p>e. opłacić zamówienie za pomocą jednego z dostępnych sposobów płatności.</p>
            </p>
            <p>
              6. Prawidłowe zakończenie procesu składania zamówienia jest potwierdzone stosownym
              komunikatem wyświetlanym na Stronie internetowej.
            </p>
            <p>
              7. Potwierdzenie przyjęcia zamówienia do realizacji zostanie potwierdzone również drogą
              elektroniczną tj. poprzez e-mail wysłany na adres wskazany przez Użytkownika podczas
              rejestracji konta lub w trakcie składania zamówienia bez rejestracji konta (nie dotyczy kursów
              grupowych) i będzie zawierało informacje wymagane przez obowiązujące przepisy prawa,
              m.in.: numer zamówienia, termin dostawy, adres dostawy, wartość zamówienia.
            </p>
            <p>
              8. Ceny dostępnych towarów wyrażone są w złotych polskich i są cenami brutto, tj. zawierają
              podatki, w tym podatek od towarów i usług (VAT).
            </p>
            <p>
              9. Ceny dostępnych towarów nie zawierają kosztów dostawy. Koszty dostawy zależą od
              wybranego sposobu dostarczenia towarów do Użytkownika.
            </p>
            <p>
              10. Całkowity koszt zamówienia obejmujący cenę towarów wraz z kosztami dostawy wskazany jest
              w koszyku przed złożeniem zamówienia.
            </p>
            <p>
              11. Realizacja zamówienia następuje po otrzymaniu przez Właściciela pełnej płatności.
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-header">9. Reklamacje<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
              1. Niniejszy paragraf określa zasady składania reklamacji w trybie rękojmi konsumenckiej, która
              może być składana przez Użytkowników, którzy są konsumentami albo przedsiębiorcami z
              uprawnieniami konsumenta.
            </p>
            <p>
              2. Właściciel jest zobowiązany do dostarczenia Użytkownikom produktu bez wad fizycznych i
              prawnych. Wadą fizyczną jest niezgodność dostarczonego towaru lub usługi z umową.
            </p>
            <p>
              3. Właściciel ponosi odpowiedzialność za brak zgodności z umową istniejący w chwili dostarczenia
              towaru lub usługi i ujawniony w ciągu dwóch lat od tej chwili, chyba że termin przydatności do
              użycia, określony przez Właściciela jest dłuższy. Domniemywa się, że brak zgodności towaru lub
              usługi z umową, który ujawnił się przed upływem roku od chwili dostarczenia towaru lub usługi,
              istniał w chwili dostarczenia, o ile nie zostanie udowodnione inaczej.
            </p>
            <p>
              4. W przypadku braku zgodności towaru lub usługi z umową, konsumentowi oraz przedsiębiorcy
              z uprawnieniami konsumenta przysługują uprawnienia określone w Dziale II ustawy Kodeks
              cywilny. W szczególności konsument lub przedsiębiorca z uprawnieniami konsumenta ma
              prawo żądać wymiany lub naprawy towaru, a w określonych przez prawo przypadkach -
              obniżenia ceny towaru lub usługi lub odstąpienia od umowy.
            </p>
            <p>
              5. Użytkownik będący przedsiębiorcą ma prawo do reklamacji w oparciu o przepisy dotyczące
              rękojmi znajdujące się w Kodeksie cywilnym.
            </p>
            <p>
              6. W przypadku roszczeń z tytułu rękojmi reklamowany towar powinien zostać dostarczony na
              adres: Languelove, ul. Łaszkiewicza 4/39, 31-445 Kraków koszt dostawy pokrywa w tym
              przypadku Właściciel.
            </p>
            <p>
              7. Wszelkie reklamacje związane z towarem czy usługą Użytkownik może składać w dowolnej
              formie, w tym między innymi pisemnie na adres: Languelove, ul. Łaszkiewicza 4/39, 31-445
              Kraków
            </p>
            <p>
              8. Użytkownik może także przesłać reklamację e-mailem na adres: kontakt@languelove.pl
            </p>
            <p>
              9. Użytkownik może posłużyć się wzorem formularza reklamacyjnego znajdującym się w
                Załączniku nr 2 do Regulaminu, jednak skorzystanie ze wzoru nie jest obowiązkowe.
            </p>
            <p>
              10. W treści reklamacji Użytkownik powinien podać co najmniej: swoje imię i nazwisko, adres do
              korespondencji lub adres e-mailowy, rodzaj i datę wystąpienia przyczyn reklamacji oraz
              wszystkie okoliczności uzasadniające złożenie reklamacji. W przypadku braku w treści
              reklamacji danych umożliwiających właściwe rozpatrzenie reklamacji, Właściciel może zwrócić
              się do Użytkownika składającego reklamację o uzupełnienie danych.
            </p>
            <p>
              11. Niezależnie od uprawnień wynikających z rękojmi, Użytkownik może wykonywać uprawnienia
              wynikające z gwarancji, jeśli została ona na dany towar udzielona. Jeżeli została udzielona
              gwarancja, informacje o sposobie wykonywania uprawnień wynikających z gwarancji oraz o
              podmiocie odpowiedzialnym, znajdują się w dokumencie gwarancji. Wykonanie uprawnień z
              gwarancji nie wpływa na odpowiedzialność Właściciela z tytułu rękojmi.
            </p>
            <p>
              12. Właściciel w ciągu maksymalnie 14 dni kalendarzowych rozpatrzy reklamację Użytkownika,
              wysyłając e-mail na podany w reklamacji adres Użytkownika, a w przypadku gdy reklamacja
              była składana pisemnie, także w formie pisemnej na wskazany adres.
            </p>
            <p>
              13. W przypadku rozpatrzenia reklamacji na korzyść Użytkownika, Właściciel niezwłocznie wymieni
              towar wadliwy na wolny od wad albo wadę usunie. Nie wpływa to na możliwość złożenia przez
              Użytkownika oświadczenia o obniżeniu ceny albo odstąpieniu od umowy. W przypadku braku
              możliwości wymiany towaru, usunięcia wady towaru lub obniżenia ceny Właściciel zwróci
              Użytkownikowi należność w terminie 14 dni od dnia uznania reklamacji.
            </p>
            <p>
              14. Reklamowany towar powinien być zwrócony przez Użytkownika w stanie niezmienionym.
              Użytkownik ponosi odpowiedzialność za zmniejszenie wartości rzeczy będące wynikiem
              korzystania z niej w sposób wykraczający poza konieczny do stwierdzenia charakteru, cech i
              funkcjonowania towaru. Właściciel nie ponosi odpowiedzialności za jakość towarów, jeżeli
              jakość ta uległa pogorszeniu po dostarczeniu do Użytkownika.
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-header">10. Odstąpienie od umowy<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
              1. Niniejszy paragraf określa zasady odstąpienia od umowy przez Użytkowników, którzy są
              konsumentami albo przedsiębiorcami z uprawnieniami konsumenta.
            </p>
            <p>
              2. Zgodnie z art. 27 Ustawy o Prawach Konsumentów, Użytkownikowi będącemu konsumentem
              lub przedsiębiorcą z uprawnieniami konsumenta przysługuje prawo do odstąpienia od umowy
              zawartej na odległość bez podania przyczyny poprzez złożenie Właścicielowi oświadczenia w
              terminie 14 dni od dnia zrealizowania zamówienia, tj. objęcia w posiadanie towarów lub od dnia
              zamówienia usługi.
            </p>
            <p>
              3. Bieg terminu do odstąpienia od umowy rozpoczyna się od daty otrzymania zrealizowanego
              zamówienia w przypadku towaru, to znaczy od objęcia towarów w posiadanie przez
              Użytkownika lub wskazaną przez niego osobę, a w przypadku usług od momentu zamówienia
              usługi.
            </p>
            <p>
              4. Użytkownik, który chce skorzystać z prawa odstąpienia od umowy, powinien poinformować
              Właściciela o swojej decyzji w drodze jednoznacznego oświadczenia przed upływem terminu
              do odstąpienia od umowy.
            </p>
            <p>
              5. Oświadczenie o odstąpieniu od umowy Użytkownik może złożyć wysyłając oświadczenie na
              adres email: kontakt@languelove.pl lub wysyłając je pocztą na adres: Languelove, ul.
              Łaszkiewicza 4/39, 31-445 Kraków. Użytkownik może posłużyć się wzorem oświadczenia o
              odstąpieniu znajdującym się w Załączniku nr 2 do Regulaminu, jednak skorzystanie ze wzoru nie
              jest obowiązkowe.
            </p>
            <p>
              6. Właściciel nie odbiera kierowanych do niego przesyłek odesłanych za pobraniem.
            </p>
            <p>
              7. W razie odstąpienia od umowy konsument lub przedsiębiorca, któremu przysługują
              uprawnienia konsumenta zobowiązany jest zwrócić towar Właścicielowi niezwłocznie, na
              własny koszt, a w każdym razie nie później niż w terminie 14 dni od dnia, w którym konsument
              lub przedsiębiorca, któremu przysługują prawa konsumenta poinformował Właściciela o
              odstąpieniu od umowy. Termin jest zachowany, jeżeli konsument odeśle Towar (data nadania)
              przed upływem terminu 14 dni na adres: ul. Łaszkiewicza 4/39, 31-445 Kraków
            </p>
            <p>
              8. Konsument lub przedsiębiorca, któremu przysługują prawa konsumenta ponosi
              odpowiedzialność za zmniejszenie wartości towaru będące wynikiem korzystania z niego w
              sposób wykraczający poza konieczny do stwierdzenia charakter produktu, jego cechy lub
              funkcjonowanie.
            </p>
            <p>
              9. Właściciel niezwłocznie, ale nie później niż w ciągu 14 dni od otrzymania od konsumenta lub
              przedsiębiorcy, któremu przysługują prawa konsumenta, oświadczenia o całościowym lub
              częściowym odstąpieniu od umowy zwróci konsumentowi lub przedsiębiorcy, któremu
              przysługują prawa konsumenta dokonaną przez niego płatność za zwrócony towar.
            </p>
            <p>
              10. Stosownie do art. 38 Ustawy o Prawach Konsumenta, prawo do odstąpienia od umowy nie
              przysługuje w odniesieniu do umowy:
              <p>a) o świadczenie usług, za które konsument jest zobowiązany do zapłaty ceny, jeżeli
              przedsiębiorca wykonał w pełni usługę za wyraźną i uprzednią zgodą konsumenta, który został
              poinformowany przed rozpoczęciem świadczenia, że po spełnieniu świadczenia przez
              przedsiębiorcę utraci prawo odstąpienia od umowy, i przyjął to do wiadomości;</p>
              <p>b) w której cena lub wynagrodzenie zależy od wahań na rynku finansowym, nad którymi
              przedsiębiorca nie sprawuje kontroli, i które mogą wystąpić przed upływem terminu do
              odstąpienia od umowy;</p>
              <p>c) w której przedmiotem świadczenia jest towar nieprefabrykowany, wyprodukowany według
              specyfikacji konsumenta lub służący zaspokojeniu jego zindywidualizowanych potrzeb;</p>
              <p>d) w której przedmiotem świadczenia jest towar ulegający szybkiemu zepsuciu lub mający krótki
              termin przydatności do użycia;</p>
              <p>e) w której przedmiotem świadczenia jest towar dostarczany w zapieczętowanym opakowaniu,
              którego po otwarciu opakowania nie można zwrócić ze względu na ochronę zdrowia lub ze
              względów higienicznych, jeżeli opakowanie zostało otwarte po dostarczeniu;</p>
              <p>f) w której przedmiotem świadczenia są towary, które po dostarczeniu, ze względu na swój
              charakter, zostają nierozłącznie połączone z innymi rzeczami;</p>
              <p>g) w której przedmiotem świadczenia są napoje alkoholowe, których cena została uzgodniona
              przy zawarciu umowy sprzedaży, a których dostarczenie może nastąpić dopiero po upływie 30
              dni i których wartość zależy od wahań na rynku, nad którymi przedsiębiorca nie ma kontroli;</p>
              <p>h) w której konsument wyraźnie żądał, aby przedsiębiorca do niego przyjechał w celu dokonania
              pilnej naprawy lub konserwacji; jeżeli przedsiębiorca świadczy dodatkowo inne usługi niż te,
              których wykonania konsument żądał, lub dostarcza towary inne niż części zamienne niezbędne
              do wykonania naprawy lub konserwacji, prawo odstąpienia od umowy przysługuje
              konsumentowi w odniesieniu do dodatkowych usług lub towarów;</p>
              <p>i) w której przedmiotem świadczenia są nagrania dźwiękowe lub wizualne albo programy
              komputerowe dostarczane w zapieczętowanym opakowaniu, jeżeli opakowanie zostało
              otwarte po dostarczeniu;</p>
              <p>j) o dostarczanie dzienników, periodyków lub czasopism, z wyjątkiem umowy o prenumeratę;</p>
              <p>k) zawartej w drodze aukcji publicznej;</p>
              <p>l) o świadczenie usług w zakresie zakwaterowania, innych niż do celów mieszkalnych, przewozu
              towarów, najmu samochodów, gastronomii, usług związanych z wypoczynkiem, wydarzeniami
              rozrywkowymi, sportowymi lub kulturalnymi, jeżeli w umowie oznaczono dzień lub okres
              świadczenia usługi;</p>
              <p>m) o dostarczanie treści cyfrowych niedostarczanych na nośniku materialnym, za które
              konsument jest zobowiązany do zapłaty ceny, jeżeli przedsiębiorca rozpoczął świadczenie za
              wyraźną i uprzednią zgodą konsumenta, który został poinformowany przed rozpoczęciem
              świadczenia, że po spełnieniu świadczenia przez przedsiębiorcę utraci prawo odstąpienia od
              umowy, i przyjął to do wiadomości, a przedsiębiorca przekazał konsumentowi potwierdzenie,
              o którym mowa w art. 15 obowiązek wydania dokumentu umowy i potwierdzenia uzyskania
              zgody ust. 1 i 2 albo art. 21 potwierdzenie zawarcia umowy na odległość ust. 1;</p>
              <p>n) o świadczenie usług, za które konsument jest zobowiązany do zapłaty ceny w przypadku
              których konsument wyraźnie zażądał od przedsiębiorcy, aby przyjechał do niego w celu
              dokonania naprawy, a usługa została już w pełni wykonana za wyraźną i uprzednią zgodą
              konsumenta.</p>
              <p>o) w której przedmiotem świadczenia są̨ dzienniki, periodyki lub czasopisma, z wyjątkiem umowy
              o prenumeratę̨;</p>
              <p>p) w której cena lub wynagrodzenie zależy od wahań́ na rynku finansowym, nad którymi
              Sprzedawca nie sprawuje kontroli, i które mogą̨ wystąpić́ przed upływem terminu do
              odstąpienia od umowy.</p>
            </p>
            <p>
              11. Prawo do odstąpienia od umowy zgodnie z warunkami określonymi w punkcie 10. powyżej nie
              przysługuje pod warunkiem, że konsument lub przedsiębiorca, któremu przysługują prawa
              konsumenta został uprzednio skutecznie poinformowany o tym fakcie zanim zawarł umowę.
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-header">11. Newsletter<span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
              1. Użytkownik może dobrowolnie wyrazić zgodę na otrzymywanie informacji handlowych drogą
              elektroniczną w formie Newslettera poprzez zaznaczenie opcji „Wyrażam zgodę na
              otrzymywanie newslettera” w formularzu rejestracyjnym lub po zarejestrowaniu, w zakładce
              ”moje konto”.
            </p>
            <p>
              2. W przypadku wyrażenia zgody, o której mowa w punkcie 1 powyżej, Użytkownik otrzymuje na
              podany przez siebie adres e-mail informację z linkiem aktywacyjnym subskrypcji Newslettera.
              Użytkownik może w każdym czasie zrezygnować z Newslettera w zakładce ”moje konto” lub
              przy wykorzystaniu aktywnego linku znajdującej się w każdej wiadomości przesyłanej do niego
              w ramach usługi Newslettera lub za składając oświadczenie za pośrednictwem maila na adres:
              kontakt@languelove.pl
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-header">12. Postanowienia końcowe <span class="icon"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content">
            <p>
              1. W sprawach nieuregulowanych w Regulaminie mają zastosowanie przepisy prawa polskiego,
              w szczególności Kodeksu Cywilnego, Ustawy o Prawach Konsumentów i ustawy z dnia 18 lipca
              2002 roku o świadczeniu usług drogą elektroniczną (Dz.U.2020 r. poz. 344 z późn. zm).
            </p>
            <p>
              2. Właściciel nie wyklucza możliwości czasowego zawieszenia lub ograniczenia dostępności
              Strony internetowej lub niektórych usług elektronicznych świadczonych za pośrednictwem
              Strony internetowej na czas niezbędny do przeprowadzenia konserwacji, przeglądu, wymiany
              sprzętu lub też w związku z koniecznością modernizacji lub rozbudowy Strony internetowej.
              Właściciel dołoży wszelkich starań, aby ewentualne zawieszenie dostępności trwało możliwie
              jak najkrócej.
            </p>
            <p>
              3. Użytkownik ma prawo wykorzystywać Stronę internetową oraz dostępne w niej zasoby
              wyłącznie do celów zgodnych z ich przeznaczeniem. Strona internetowa stanowi utwór, do
              którego Właściciel posiada prawa majątkowe w postaci praw autorskich majątkowych lub
              stosownych licencji lub sublicencji. Wykorzystywanie zasobów dostępnych na Stronie
              internetowej lub w poszczególnych narzędziach udostępnianych Użytkownikom może być
              realizowane wyłącznie do celu właściwego korzystania z usługi świadczonej przez Właściciela.
            </p>
            <p>
              4. Właściciel w najszerszym dopuszczalnym przez prawo zakresie nie ponosi odpowiedzialności
              za zakłócenia, w tym przerwy w funkcjonowaniu Strony internetowej spowodowane siłą
              wyższą, niedozwolonym działaniem osób trzecich lub niekompatybilnością Strony
              internetowej z infrastrukturą techniczną Użytkownika.
            </p>
            <p>
              5. Właściciel nie ponosi odpowiedzialności za niedostarczenie wiadomości przesłanej na
              wskazany przez Użytkownika adres e-mail, co może być spowodowane blokowaniem lub
              usuwaniem e-maili przez oprogramowanie zainstalowane na komputerze używanym przez
              Użytkownika lub blokowaniem przez administratorów serwerów pocztowych lub inną awarię.
            </p>
            <p>
              6. Publiczny charakter sieci Internet i korzystanie z usług świadczonych drogą elektroniczną
              wiązać może się z zagrożeniem pozyskania i modyfikowania danych Użytkowników przez osoby
              nieuprawnione, dlatego Użytkownicy powinni stosować właściwe środki techniczne, które
              zminimalizują wskazane wyżej zagrożenia. W szczególności Użytkownicy powinni stosować
              programy antywirusowe i chroniące tożsamość korzystających z sieci Internet.
            </p>
            <p>
              7. Właściciel zastrzega prawo ograniczenia dostępu do wybranych usług oferowanych za
              pośrednictwem Strony internetowej dla Użytkowników, którzy spełnią określone warunki.
              Zastrzeżenie dotyczące możliwości skorzystania z wybranych usług będzie każdorazowo
              zamieszczane na Stronie internetowej.
            </p>
            <p>
              8. Właściciel ma prawo powierzyć wykonywanie bieżącej obsługi Strony internetowej, w tym
              hostingu, we własnym imieniu podwykonawcy, bez informowania o tym Użytkowników.
            </p>
            <p>
              9. Ewentualne spory pomiędzy Użytkownikiem lub Kursantem lub Klientem instytucjonalnym a
              Właścicielem zostaną poddane rozstrzygnięciu sądu właściwego zgodnie z ustawą z 17
              listopada 1964 r. – Kodeks postępowania cywilnego (Dz.U.2020.1575 z późn. zm.).
            </p>
            <p>
              10. Konsument może zwrócić się o rozstrzygnięcie sporu konsumenckiego drogą elektroniczną za
              pomocą unijnej platformy internetowej (online dispute resolution, platforma ODR) dostępnej
              pod adresem: http://ec.europa.eu/consumers/odr/.
            </p>
            <p>
              11. Właściciel zastrzega sobie prawo do dokonywania zmian Regulaminu z ważnych przyczyn to
              jest m.in: zmiany warunków technicznych, zmiany przepisów prawa, zmiany sposobów
              płatności czy dostaw - w zakresie, w jakim te zmiany wpływają na realizację postanowień
              niniejszego Regulaminu. O każdej zmianie Właściciel poinformuje z co najmniej 14 dniowym
              wyprzedzeniem. W przypadku jakiejkolwiek zmiany Regulaminu zarejestrowani Użytkownicy
              niebędący Konsumentami mają prawo w terminie 14 dni od dnia powiadomienia ich o zmianie
              Regulaminu zrezygnować ze świadczonych usług. Konsumenci w terminie 14 dni od dnia
              powiadomienia ich o zmianie Regulaminu, którzy nie wyrażają zgody na zmianę postanowień
              Regulaminu, mogą złożyć oświadczenie o niewyrażeniu zgody na jego zmianę za
              pośrednictwem wiadomości e-mail (na adres kontakt@languelove.pl). Złożenie takiego
              oświadczenia oznacza rozwiązanie Umowy z dniem wejścia w życie zmiany Regulaminu.
            </p>
            <p>
              12. Zmieniony Regulamin zostaje udostępniony na Stronie internetowej w zakładce „Regulamin” i
              jest dostępny w wersji elektronicznej.
            </p>
            <p>
              13. O zmianie Regulaminu Właściciel poinformuje poprzez komunikat na Stronie internetowej oraz
              przesyłając powiadomienia Użytkownikom (w tym Kursantom i Klientom instytucjonalnym) na
              adres e-mail podany przy rejestracji konta (wraz z załączonym regulaminem w formacie PDF).
            </p>
            <p>
              14. Termin wejścia w życie zmienionego Regulaminu wynosi co najmniej 14 dni od daty przesłania
              powiadomienia o zmianie Regulaminu.
            </p>
            <p>
              15. Do umów zawartych i niezrealizowanych w pełni przed dniem wejścia w życie zmienionego lub
              nowego Regulaminu stosuje się postanowienia Regulaminu obowiązującego w chwili zawarcia
              umowy.
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-header">Załączniki <span class="icon" style="display:none"><img src="{{asset('images/svg/plus.svg')}}"></span></div>
          <div class="accordion-content"></div>
          <div class="LinksContainer">
            <a target="_blank" href="https://languelove.pl/files/Reklamacja%20LangueLove.pdf">Wzór formularza reklamacyjnego</a>
            <a target="_blank" href="https://languelove.pl/files/Oswiadczenie_o_odstapienie_od_umowy_zawartej_na_odleglosc%20LangueLove.pdf">Wzór oświadczenia o odstąpieniu od umowy</a>
            <a target="_blank" href="https://languelove.pl/files/Zalacznik%20Nr3%20do%20Regulaminu.pdf">Zgoda rodzica/opiekuna prawnego</a>
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