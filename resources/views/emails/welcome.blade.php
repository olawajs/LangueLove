@component('mail::message')
<img src="http://languelove.pl/{{public_path('images/logo/logo1 2x.png')}}"/>

# Witamy w LangueLove!

Cześć!
Dziękujemy za rejestrację w naszej szkole!
Nie możemy się doczekać naszych lekcji 😍

Już teraz zapisz się na swoją pierwszą lekcję!

@component('mail::button', ['url' => 'https://languelove.pl/'])
    Zapisz się
@endcomponent

Czekamy na Ciebie,<br>
{{ config('app.name') }}
@endcomponent
