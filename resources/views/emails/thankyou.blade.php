@component('mail::message')
# Dziękujemy za zakup!

Cześć!
Dziękujemy za zakup lekcji w naszej szkole!
Nie możemy się już doczekać! 😍

Odwiedź naszą stronę i sprawdź w kalendarzu wybrany przez siebie termin!
@component('mail::button', ['url' => 'https://languelove.pl/'])
    Przejdź do strony
@endcomponent

<br><br>
Pozdrawiamy, 
{{ config('app.name') }}
@endcomponent
