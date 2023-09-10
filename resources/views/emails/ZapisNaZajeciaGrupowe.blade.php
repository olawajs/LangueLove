@component('mail::message')
# Zapis na zajęcia grupowe

Cześć! 😊<br>
Potwierdzamy zapis na zajęcia grupowe "{{$mailData['nazwa']}}". <br>
Zajęcia rozpoczną się {{$mailData['start']}} i będą się odbywały co tydzień w {{$mailData['dzien']}} o godzinie {{$mailData['godzina']}} 🕧.<br>
Kilka dni przed rozpoczęciem zajęć wyślemy Ci link do dołączenia na zajęcia i ewentualne materiały na pierwsze spotkanie📚.<br>
Fakturę za opłacony kurs otrzymasz od nas za kilka dni w osobnym mailu. <br>
Jeśli w międzyczasie pojawią się pytania, napisz do nas na kontakt@languelove.pl 📨<br>
Życzymy owocnej nauki! 😊 <br>
Zespół LangueLove

<!-- {{$mailData['nazwa']}} -->

@endcomponent
