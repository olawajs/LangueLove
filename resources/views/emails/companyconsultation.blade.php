@component('mail::message')
# Nowa prośba o konsultację dla firm

<b>Firma:</b> {{$mailData['name']}}
<br>
<b>Email:</b> {{$mailData['email']}}
<br>
<b>Język:</b> {{$mailData['language_id']}}
<br>
<b>Typ:</b> {{$mailData['kurs']}}
<br>
<b>Miejsce:</b> {{$mailData['miasto']}}
<br>
<b>Treść wiadomości:</b> {{$mailData['message']}}

Miłego dnia!<br>
{{ config('app.name') }}
@endcomponent
