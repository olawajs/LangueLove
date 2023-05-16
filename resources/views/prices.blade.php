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
  display: flex;
  justify-content: center;
  align-items: center;
  font-weight: bold;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
  margin-top: 50px;
} 
.ButtonsLabel{
  font-weight: bold;
  margin: 20px 0 20px 50px;
}

@media (max-width:600px) { 
    h3{
        font-size: 25px !important;
      }
      .carousel__item {
      display: flex;
      align-items: center;
      justify-content: space-around;
      /* color: #fff; */
      color: #FCF9F5;
      /* font-size: 0px; */
      width: 150px;
      height: 350px;
      border-radius: 12px;
      box-shadow: 0px 2px 8px 0px rgba(50, 50, 50, 0.5);
      position: absolute;
      transition: all .3s ease-in;
      flex-direction: column;
      padding: 15px;
    }
    .discount{
      font-size: 8px;
    }
    .buy_arrow{
      font-size: 8px;
    }
    .LessonAmount{
      font-size: 15px;
    }
    .DiscountDiv{
      display: flex;
      flex-direction: column;
    }
    .prizeDiv{
      font-size: 15px;
    } 
    .material-symbols-outlined{
      font-size: 12px !important;
    }
    .info{
      display: flex; 
      font-size: 5px;
    }
  }
</style>

@section('content')
<div class="container">
  <div class="row justify-content-center classic">
    <div class="classicTwo">
      <img src="{{ asset('images/logo512.png') }}" height="100" alt="">
    </div>
    <div class="classicTwo">
      <h4><b>Wybierz jak chcesz się uczyć i sprawdź cenę Twojego kursu.</b></h4>
    </div>
  </div>
  <div class="row justify-content-center classicWhite">
    <div>
      <p class="ButtonsLabel">Jakiego języka chcesz się uczyć?</p>
      <select class="form-select pinkSelect" onchange="language(event)">
        <option selected value="0">Wybierz język</option>
        @foreach($languages as $l)
          <option value="{{$l->price_type}}/{{$l->id}}">{{$l->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row justify-content-center classic">
  <p class="ButtonsLabel">Jak chcesz się uczyć?</p>
    <div class="LineDiv">
      <div class="classicThree">
        <button class="pricingButton typeButton" onclick="kurs(event,1)">
          <img class="buttonImg" src="{{ asset('images/oneChat.png') }}"alt="" style="pointer-events: none;">
          <div style="pointer-events: none;"><b>Kurs indywidualny</b></div>
        </button>
      </div>
      <div class="classicThree">
        <button class="pricingButton typeButton" onclick="kurs(event,2)">
          <img class="buttonImg" src="{{ asset('images/twoChats.png') }}"alt="" style="pointer-events: none;">
          <div style="pointer-events: none;"><b>Kurs w parze</b></div>
        </button>
      </div>
      <div class="classicThree">
        <button class="pricingButton typeButton" onclick="kurs(event,3)">
          <img class="buttonImg" src="{{ asset('images/ThreeChats.png') }}"alt="" style="pointer-events: none;">
          <div style="pointer-events: none;"><b>Kurs grupowy</b></div>
        </button>
      </div>
    </div>
  <div>
  <div id="MoreInfo" style="display: none">
  <p class="ButtonsLabel">Wybierz długość lekcji</p>
    <div class="TwoButtons">
      <div class="classicThree">
        <button class="colorButtonMagenta timeButton" onclick="time(event,60)">
          <div style="pointer-events: none;"><b>60 min</b></div>  
        </button>
      </div>
      <div class="classicThree">
        <button class="colorButtonViolet timeButton" onclick="time(event,90)">
          <div style="pointer-events: none;"><b>90 min</b></div>
        </button>
      </div>
    </div>
  <div>
  <p class="ButtonsLabel">Czy przygotowujesz się do certyfikatu językowego?</p>
  <div class="TwoButtons">
    <div class="classicThree">
      <button class="colorButtonMagenta certyficateButton" onclick="certyficate(event,1)">
      <div style="pointer-events: none;"><b>Tak</b></div>
      </button>
    </div>
    <div class="classicThree">
      <button class="colorButtonViolet certyficateButton" onclick="certyficate(event,0)">
        <div style="pointer-events: none;"><b>Nie</b></div>
      </button>
    </div>
  </div>
</div>
  <div>
    <p class="ButtonsLabel">Jak chcesz płacić za kurs?</p>
    <div class="TwoButtons">
      <div class="classicThree">
        <button class="pricingButton amountButton" onclick="amount(event,1)">
          <div class="PinkCircle">1</div>
          <div style="pointer-events: none;"><b>1 zajęcia</b></div>
        </button>
      </div>
      <div class="classicThree">
        <button class="pricingButton amountButton" onclick="amount(event,5)">
          <div class="VioletCircle">5</div>
          <div style="pointer-events: none;"><b>5 zajęć</b></div>
        </button>
      </div>
    </div>
    <div class="TwoButtons" style="margin-top: 40px;">
      <div class="classicThree">
        <button class="pricingButton amountButton" onclick="amount(event,10)">
          <div class="PinkCircle">10</div>
          <div style="pointer-events: none;"><b>10 zajęć</b></div>
        </button>
      </div>
      <div class="classicThree">
        <button class="pricingButton amountButton" onclick="amount(event,30)">
          <div class="VioletCircle">30</div>
          <div style="pointer-events: none;"><b>30 zajęć</b></div>
        </button>
      </div>
    </div> 
  </div>
</div>

</div>
</div>
  <div class="Description" id="descriptionBox">
    Za pakiet 10 zajęć
  </div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
  let typeV = 0;
  let certyficateV = 0;
  let timeV = 0;
  let amountV = 0;
  let languageV = 0;
  let letdesc = [];
  letdesc['1,60,1,1']=[119,'Za pojedynczą indywidualną 60-minutową lekcję z języka angielskiego przygotowującą do certyfikatu zapłacisz 119 zł.','60-minutowa lekcja indywidualna z języka angielskiego przygotowująca do certyfikatu'];
  letdesc['1,60,1,5']=[585,'Za pakiet 5 lekcji indywidualnych 60-minutowych z języka angielskiego, przygotowujących do certyfikatu zapłacisz 585 zł.','pakiet 5 lekcji indywidualnych 60-minutowych z języka angielskiego, przygotowujących do certyfikatu'];
  letdesc['1,60,1,10']=[1149,'Za pakiet 10 lekcji indywidualnych 60-minutowych z języka angielskiego, przygotowujących do certyfikatu zapłacisz 1149 zł.','pakiet 10 lekcji indywidualnych 60-minutowych z języka angielskiego, przygotowujących do certyfikatu'];
  letdesc['1,60,1,30']=[3299,'Za pakiet 30 lekcji indywidualnych 60-minutowych z języka angielskiego, przygotowujących do certyfikatu, zapłacisz 3299 zł.','pakiet 30 lekcji indywidualnych 60-minutowych z języka angielskiego, przygotowujących do certyfikatu'];
  letdesc['1,60,0,1']=[99,'Za pojedynczą indywidualną 60-minutową lekcję z języka angielskiego zapłacisz 99 zł.','60-minutowa lekcja indywidualna z języka angielskiego '];
  letdesc['1,60,0,5']=[489,'Za pakiet 5 lekcji indywidualnych 60-minutowych z języka angielskiego zapłacisz 489 zł.','pakiet 5 lekcji indywidualnych 60-minutowych z języka angielskiego'];
  letdesc['1,60,0,10']=[949,'Za pakiet 10 lekcji indywidualnych 60-minutowych z języka angielskiego zapłacisz 949 zł.','pakiet 10 lekcji indywidualnych 60-minutowych z języka angielskiego'];
  letdesc['1,60,0,30']=[2699,'Za pakiet 30 lekcji indywidualnych 60-minutowych z języka angielskiego zapłacisz 2699 zł.','pakiet 30 lekcji indywidualnych 60-minutowych z języka angielskiego'];
  letdesc['1,90,1,1']=[175,'Za pojedynczą indywidualną 90-minutową lekcję z języka angielskiego przygotowującą do certyfikatu zapłacisz 175 zł.','90-minutowa lekcja indywidualna z języka angielskiego przygotowująca do certyfikatu'];
  letdesc['1,90,1,5']=[865,'Za pakiet 5 lekcji indywidualnych 90-minutowych z języka angielskiego, przygotowujących do certyfikatu zapłacisz 865 zł.','pakiet 5 lekcji indywidualnych 90-minutowych z języka angielskiego, przygotowujących do certyfikatu'];
  letdesc['1,90,1,10']=[1699,'Za pakiet 10 lekcji indywidualnych 90-minutowych z języka angielskiego, przygotowujących do certyfikatu zapłacisz 1699 zł.','pakiet 10 lekcji indywidualnych 90-minutowych z języka angielskiego, przygotowujących do certyfikatu'];
  letdesc['1,90,1,30']=[4949,'Za pakiet 30 lekcji indywidualnych 90-minutowych z języka angielskiego, przygotowujących do certyfikatu zapłacisz 4949 zł.','pakiet 30 lekcji indywidualnych 90-minutowych z języka angielskiego, przygotowujących do certyfikatu'];
  letdesc['1,90,0,1']=[145,'Za pojedynczą indywidualną 90-minutową lekcję z języka angielskiego zapłacisz 145 zł.','90-minutowa lekcja indywidualna z języka angielskiego '];
  letdesc['1,90,0,5']=[699,'Za pakiet 5 lekcji indywidualnych 90-minutowych z języka angielskiego zapłacisz 699 zł.','pakiet 5 lekcji indywidualnych 90-minutowych z języka angielskiego'];
  letdesc['1,90,0,10']=[1349,'Za pakiet 10 lekcji indywidualnych 90-minutowych z języka angielskiego zapłacisz 1349 zł.','pakiet 10 lekcji indywidualnych 90-minutowych z języka angielskiego'];
  letdesc['1,90,0,30']=[3899,'Za pakiet 30 lekcji indywidualnych 90-minutowych z języka angielskiego zapłacisz 3899 zł.','pakiet 30 lekcji indywidualnych 90-minutowych z języka angielskiego'];
  letdesc['2,60,1,1']=[169,'Za pojedynczą 60-minutową lekcję w parze z języka angielskiego, przygotowującą do certyfikatu, zapłacisz 169 zł.','60-minutowa lekcja w parze z języka angielskiego przygotowująca do certyfikatu'];
  letdesc['2,60,1,5']=[819,'Za pakiet 5 lekcji 60-minutowych w parze z języka angielskiego, przygotowujących do certyfikatu, zapłacisz 819 zł.','pakiet 5 lekcji  60-minutowych w parze z języka angielskiego, przygotowujących do certyfikatu'];
  letdesc['2,60,1,10']=[1599,'Za pakiet 10 lekcji 60-minutowych w parze z języka angielskiego, przygotowujących do certyfikatu, zapłacisz 1599 zł.','pakiet 10 lekcji 60-minutowych w parze z języka angielskiego, przygotowujących do certyfikatu'];
  letdesc['2,60,1,30']=[4619,'Za pakiet 30 lekcji 60-minutowych w parze z języka angielskiego, przygotowujących do certyfikatu, zapłacisz 4619 zł.','pakiet 30 lekcji 60-minutowych w parze z języka angielskiego, przygotowujących do certyfikatu'];
  letdesc['2,60,0,1']=[119,'Za pojedynczą 60-minutową lekcję w parze z języka angielskiego zapłacisz 119 zł.','60-minutowa lekcja w parze z języka angielskiego '];
  letdesc['2,60,0,5']=[569,'Za pakiet 5 lekcji 60-minutowych w parze z języka angielskiego zapłacisz 569 zł.','pakiet 5 lekcji 60-minutowych w parze z języka angielskiego'];
  letdesc['2,60,0,10']=[1099,'Za pakiet 10 lekcji 60-minutowych w parze z języka angielskiego zapłacisz 1099 zł.','pakiet 10 lekcji 60-minutowych w parze z języka angielskiego'];
  letdesc['2,60,0,30']=[3119,'Za pakiet 30 lekcji 60-minutowych w parze z języka angielskiego zapłacisz 3119 zł.','pakiet 30 lekcji 60-minutowych w parze z języka angielskiego'];
  letdesc['2,90,1,1']=[199,'Za pojedynczą 90-minutową lekcję w parze z języka angielskiego, przygotowującą do certyfikatu, zapłacisz 199 zł.','90-minutowa lekcja w parze z języka angielskiego przygotowująca do certyfikatu'];
  letdesc['2,90,1,5']=[975,'Za pakiet 5 lekcji 90-minutowych w parze z języka angielskiego, przygotowujących do certyfikatu, zapłacisz 975 zł.','pakiet 5 lekcji 90-minutowych w parze z języka angielskiego, przygotowujących do certyfikatu'];
  letdesc['2,90,1,10']=[1899,'Za pakiet 10 lekcji 90-minutowych w parze z języka angielskiego, przygotowujących do certyfikatu, zapłacisz 1899 zł.','pakiet 10 lekcji 90-minutowych w parze z języka angielskiego, przygotowujących do certyfikatu'];
  letdesc['2,90,1,30']=[5549,'Za pakiet 30 lekcji 90-minutowych w parze z języka angielskiego, przygotowujących do certyfikatu, zapłacisz 5549 zł.','pakiet 30 lekcji 90-minutowych w parze z języka angielskiego, przygotowujących do certyfikatu'];
  letdesc['2,90,0,1']=[175,'Za pojedynczą 90-minutową lekcję w parze z języka angielskiego zapłacisz 175 zł.','90-minutowa lekcja w parze z języka angielskiego '];
  letdesc['2,90,0,5']=[849,'Za pakiet 5 lekcji 90-minutowych w parze z języka angielskiego zapłacisz 849 zł.','pakiet 5 lekcji 90-minutowych w parze z języka angielskiego'];
  letdesc['2,90,0,10']=[1649,'Za pakiet 10 lekcji 90-minutowych w parze z języka angielskiego zapłacisz 1649 zł.','pakiet 10 lekcji 90-minutowych w parze z języka angielskiego'];
  letdesc['1,90,0,30']=[4799,'Za pakiet 30 lekcji 90-minutowych w parze z języka angielskiego zapłacisz 4799 zł.','pakiet 30 lekcji 90-minutowych w parze z języka angielskiego'];
  letdesc['3,1']=[0,'Sprawdź dostępne kursy grupowe przygotowujące do certyfikatu z języka angielskiego tutaj!',''];
  letdesc['3,0']=[0,'Sprawdź dostępne kursy grupowe z języka angielskiego tutaj!',''];


  function kurs(e,id){
    var anchors = document.getElementsByClassName('typeButton');
    for(var i = 0; i < anchors.length; i++) {
        var anchor = anchors[i];
        anchor.classList.remove("choosenType");
    }
    e.target.classList.add("choosenType");
    typeV = id;
    if(id != 3){
      document.getElementById('MoreInfo').style.display = 'block';
    }else{
      document.getElementById('MoreInfo').style.display = 'none';
    }
    WriteDescription();
  }

  function time(e,id){
    var anchors = document.getElementsByClassName('timeButton');
    for(var i = 0; i < anchors.length; i++) {
        var anchor = anchors[i];
        anchor.classList.remove("choosenType");
    }
    e.target.classList.add("choosenType");
    timeV = id;
    WriteDescription();
  }
  function certyficate(e,id){
    var anchors = document.getElementsByClassName('certyficateButton');
    for(var i = 0; i < anchors.length; i++) {
        var anchor = anchors[i];
        anchor.classList.remove("choosenType");
    }
    e.target.classList.add("choosenType");
    certyficateV = id;
    WriteDescription();
  }
  function amount(e,id){
    var anchors = document.getElementsByClassName('amountButton');
    for(var i = 0; i < anchors.length; i++) {
        var anchor = anchors[i];
        anchor.classList.remove("choosenType");
    }
    e.target.classList.add("choosenType");
    amountV = id;
    WriteDescription();
  }
  function language(e){
    var anchors = document.getElementsByClassName('amountButton');
    for(var i = 0; i < anchors.length; i++) {
        var anchor = anchors[i];
        anchor.classList.remove("choosenType");
    }
    e.target.classList.add("choosenType");
    languageV = str.split('/')[0];
    WriteDescription();
  }
  function WriteDescription(){
   if(typeV != 0 && typeV == 3){
      document.getElementById('descriptionBox').innerHTML = letdesc[typeV+','+certyficateV][1];
   }
   if(typeV != 0 && typeV != 3){
      if(timeV != 0 && amountV != 0){
        alert('!1');
        document.getElementById('descriptionBox').innerHTML = letdesc[typeV+','+timeV+','+certyficateV+','+amountV][1];
      }
   }
  }
</script>