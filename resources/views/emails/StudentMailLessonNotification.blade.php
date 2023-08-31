@component('mail::message')
# Przypominamy o zajęciach!

Cześć!
    Jutro o godzinie <b>{{$mailData['godzina']}}</b> odbędą się Twoje zajęcia z <b>języka {{$mailData['jezyk']}}ego.</b>
    <br>
    Lektorka {{$mailData['lektor']}} już na Ciebie czeka!
    <br>
    Żeby dołączyć do zajęć kliknij poniższy link: {{$mailData['skype']}} <br>
    W przypadku pytań lub problemów technicznych możesz się z nami skontaktować na: kontakt@languelove.pl

Życzymy owocnej nauki! <br>
{{ config('app.name') }}
@endcomponent
