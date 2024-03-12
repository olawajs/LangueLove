@extends('layouts.app')

<style>
.MainDiv{
  padding: 272px 50px;
  display: flex;
  max-width: 790px;
  flex-direction: column;
  align-items: center;
  gap: 40px;
  margin: auto;
  text-align: center;
}

</style>

@section('content')
<div class="container">

    <div class="MainDiv" style="padding: 272px 50px;">
      <div><img src="{{asset('images/svg/pinkCheck.svg')}}"></div>
      <div style="color: var(--langue-love-black, #2B2B33);font-size: 40px;font-weight: 700;line-height: 48px;">Dziękujemy za zakup!</div>
      <div style="color: var(--langue-love-black, #2B2B33);font-size: 16px;font-weight: 400;line-height: 24px;">
      @if($type == 3)
        <p>Dziękujemy za zapisz na nasz webinar! Już nie możemy się doczekać! </p>
      @else
      <p>Dziękujemy za zakup lekcji w naszej szkole! Już nie możemy się doczekać! </p>
      @end
        <p>Terminy swoich zajęć możesz sprawdzić w kalendarzu na stronie swojego konta. Tam też znajdziesz linki do zajęć na Skype. Owocnej pracy! </p>
        <p>Zespół LangueLove 💜</p>
      </div>
       
    </div>

</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>

</script>