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


    <div class="row justify-content-center classic">
      <div class="classicTwo">
        <img src="{{ asset('images/logo512.png') }}" height="100" alt="">
      </div>
      <div class="classicTwo">
        <h4><b>Skontaktuj się z nami</b></h4>
      </div>
    </div>

    <div style="padding: 20px 50px;">
 
        <div class="row justify-content-center classic2 radius" style="padding: 20px 10px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; text-align: center;">
          <h3><b>Skontaktuj się z nami </b></h3>
          <p>
            Jeśli masz pytania odnośnie kursów, płatności lub potrzebujesz informacji, których nie <br>
            znalazłeś/aś na stronie zadzwoń pod numer <b>+48 516 632 063</b> lub <b>+48 790 617 937</b> <br>lub napisz 
            mail na adres: kontakt@languelove.pl
          </p>
          <p>
            Możesz również skontaktować się z nami na <b><a>Facebooku</a></b> lub na <b><a>Instagramie</a></b>. 
          
          </p>
          <p><b>Zapisy na zajęcia</b></p>
          <p>Możesz zapisać się na kurs klikając w ten <b><a>link</a></b></p>
        <div>
    </div>  
  </div>
    </div>

</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>

</script>