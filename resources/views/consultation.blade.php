@extends('layouts.app')
<style>

.discount{
  text-align: center;
  background-color: #C75470;
  width: fit-content;
  padding: 0 9px;
  font-size: x-small;
  margin: auto;
}
.buy_arrow{
  display: flex;
  justify-content: end;
  color: white;
  background-color: #C75470;
  width: fit-content;
  padding-left: 7px;
  float: inline-end;
  cursor: pointer;
  pointer-events: all;
}
/* main{
  height: 100%;
  margin-bottom: -200px;
} */
.LessonAmount{
  font-size: 34px;
  display: flex;
  justify-content: center;
}
.DiscountDiv{
  display: flex;
  flex-direction: column;
}
.prizeDiv{
  text-align: center;
  font-size: larger;
}
.info{
  display: flex; 
  font-size: xx-small
}
.pricingButton{
  height: 100px;
  width: 250px;
  background-color: white;
  border: none;
  border-radius: 5px;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  padding: 5px;
}
.LineDiv{
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 50px;
}
.TwoButtons{
  display: flex;
  justify-content: center;
  gap: 50px;
}
.choosenType{
  box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset !important;
}
.Description{
  height: 70px;
  border-radius: 8px;
  border: 2px solid var(--bs-secondary);
  display: none;
  justify-content: center;
  align-items: center;
  font-weight: bold;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
  margin-top: 50px;
} 
.BuyButton{
  height: 70px;
  border-radius: 8px;
  background-color: var(--bs-primary);
  display: none;
  justify-content: center;
  align-items: center;
  font-weight: bold;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
  margin-top: 30px;
  color: white;
  width: 100%;
} 
.ButtonsLabel{
  font-weight: bold;
  margin: 20px 0 20px 50px;
}

h4{
  margin: auto;
  width: fit-content;
}
LABEL.indented-checkbox-text
{
  margin-left: 2em;
  display: block;
  position: relative;
  margin-top: -1.4em;  /* make this margin match whatever your line-height is */
  line-height: 1.4em;  /* can be set here, or elsewehere */
}
.inputH{
  height: 50px; !important;
}
.Info{
  border-radius: 44px;
  height: 30px;
  display: flex;
  align-items: center;
}
</style>

@section('content')
<div class="container">
  @if(session()->has('success'))
    <div class="Info" style="background-color: var(--bs-primary);">
      <span class="text-white">
        {{session()->get('success')}}
      </span>
    </div>
  @endif
  @if(session()->has('error'))
    <div class="Info" style="background-color: var(--bs-secondary);">
      <span class="text-white">
        {{session()->get('error')}}
      </span>
    </div>
  @endif
  <form method="POST" action="{{ route('sendConsultation') }}">
  @csrf

    <div class="row justify-content-center classic">
      <div class="classicTwo">
        <img src="{{ asset('images/logo512.png') }}" height="100" alt="">
      </div>
      <div class="classicTwo">
        <h4><b>Darmowa konsultacja</b></h4>
      </div>
    </div>

    <div style="padding: 20px 50px;">
          <div style="padding: 25px">
            <p>
              Nie wiesz do jakiej grupy się zapisać? Chcesz zacząć naukę z nowym lektorem 
              i potrzebujesz ustalić zasady współpracy lub sprawdzić jak wyglądają zajęcia z danym 
              lektorem? Zachęcamy do skorzystania z bezpłatnej 15-minutowej konsultacji, na której 
              ustalisz cele nauki, plan działania oraz sposób prowadzenia zajęć. Wypełnij poniższy 
              formularz, a my się z Tobą skontaktujemy.
            </p>
          </div>
        <div class="row justify-content-center classic2 radius" style="padding: 20px 10px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
          <h4 class="ButtonsLabel text-center">Zapisz się na darmową konsultację</h4>
          <div class="classicTwoFlex" style="gap: 15px;">
            <input id="name" type="text" class="form-control inputH" placeholder="Imię i nazwisko" name="name" required >
            <input id="email" type="email" class="form-control inputH" placeholder="Adres email" name="email" required >
            <select class="form-control inputH" name="language_id" id="language_id">
                <option value="Język nie został wybrany">Wybierz język</option>
                @foreach($languages as $lang)
                    <option value="{{$lang->name}}">{{$lang->name}}</option>
                @endforeach
            </select>
          </div>
          <div class="classicTwoFlex">
            <textarea placeholder="Treść Twojej wiadomości" class="form-control" style="height: 100%" name='message'></textarea>
          </div>
          <button class="btn btn-secondary SButton" style="margin-top: 20px;"> Wyślij</button>
        <div>
    </div>  
  </div>
    </div>


    <div class="classic2">
    <input id="myinput" type="checkbox" required />
    <label for="myinput" class="indented-checkbox-text">
    Zapoznałem się z <a href="{{ asset('files/Polityka prywatności LangueLove.pdf') }}">Polityką prywatności</a> Strony internetowej www.languelove.pl oraz wyrażam zgodę na przetwarzanie przez 
    LangueLove Wiktoria Skrzypczak i Weronika Cieślak Spółka Cywilna, Łaszkiewicza 4/39, 31-445 Kraków, udostępnionych przeze 
    mnie danych osobowych na zasadach opisanych w Polityce prywatności dostępnej na Stronie internetowej. Oświadczam, że są 
    mi znane cele przetwarzania danych oraz moje uprawnienia. Niniejsza zgoda może być wycofana w dowolnym czasie poprzez 
    kontakt z Administratorem pod adresem kontakt@languelove.pl, bez wpływu na zgodność z prawem przetwarzania, którego 
    dokonano na podstawie zgody przed jej cofnięciem. Więcej informacji dotyczących przetwarzania danych osobowych – 
    Obowiązek Informacyjny.
    </label>  
    </div>
  </form>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>

</script>