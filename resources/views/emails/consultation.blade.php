@component('mail::message')
# Nowa prośba o konsultację

<b>Imię i nazwisko:</b> {{$mailData['name']}}
<br>
<b>Email:</b> {{$mailData['email']}}
<br>
<b>Język:</b> {{$mailData['language_id']}}
<br>
<b>Treść wiadomości:</b> {{$mailData['message']}}

Miłego dnia!<br>
{{ config('app.name') }}
@endcomponent
