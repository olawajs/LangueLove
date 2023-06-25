@component('mail::message')
# Nowa lekcja!

Cześć!
W Twoim kalendarzy pojawił się nowy termin do zaakceptowania.<br>
Przejdź do terminów już teraz klikając w przycisk poniżej<br>
@component('mail::button', ['url' => 'https://languelove.pl/toAccept'])
    Przejdź do strony
@endcomponent

<br>

bądź wejdź do zakładki "Oczekujące zajęcia" na naszej stronie.

<br><br>
Pozdrawiamy, 
{{ config('app.name') }}
@endcomponent
