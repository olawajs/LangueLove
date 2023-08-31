@component('mail::message')
# Jutrzejsze zajęcia

Cześć!<br>
Przypominamy o Twoich jutrzejszych zajęciach!<br>
{!!$mailData['lekcje']!!}
<br>
Owocnej pracy!<br>
{{ config('app.name') }}
@endcomponent
