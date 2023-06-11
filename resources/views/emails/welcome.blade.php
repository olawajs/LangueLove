@component('mail::message')


# Witamy w LangueLove!

Cześć!<br>
Witamy Cię na naszej stronie, rozgość się 😊<br>
Już teraz potwierdź swoje konto klikając <a href="https://languelove.pl/activate/{{$mailData['email']}}">tutaj!</a>
<br>
Poznaj naszych fantastycznych lektorów i dostępne <a href="https://languelove.pl/priceList/search/1/1">kursy</a> tutaj!
W ofercie znajdziesz zajęcia indywidualne, w parach lub grupowe. Do wyboru jest aż 10 różnych języków!<br>

@component('mail::button', ['url' => 'https://languelove.pl/'])
    Zapisz się
@endcomponent

Nasza <a href="https://languelove.pl/priceList/search/1/1">wyszukiwarka</a> pomoże Ci znaleźć najlepsze zajęcia dla Ciebie,
a kalendarz umożliwi umawianie się na zajęcia w dogodnym dla Ciebie terminie.<br>


Jeżeli masz ochotę dowiedzieć się więcej o naszej historii i metodach nauczania to zapraszamy do lektury!
@component('mail::button', ['url' => 'https://languelove.pl/about'])
    Przeczytaj o nas!
@endcomponent

Natomiast ciekawostkami językowymi, sposobami na naukę i promocjami dzielimy się na naszych social mediach.
Obserwuj nas na <a href="https://www.instagram.com/languelove">Instagramie</a> i <a href="https://www.facebook.com/LangueLove.szkola">Facebooku</a> i odkrywaj świat, ucząc się języków.


Życzymy owocnej nauki!<br>
Zespół {{ config('app.name') }}




@endcomponent
