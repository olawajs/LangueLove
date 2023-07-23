@component('mail::message')
# Nowa lekcja!

W kalendarzu pojawiła się nowa lekcja! <br>
Lektor: {{$mailData['lector']}}<br>
Uczeń: {{$mailData['user']}}<br>
Język: {{$mailData['language']}}<br>
Data zajęć: {{$mailData['date']}}<br>

@endcomponent
