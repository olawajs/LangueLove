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
      <img src="{{ asset('images/logo/logo1 2x.png') }}" height="100" alt="">
    </div>
    <div class="classicTwo">
      <h4><b>Wybierz jak chcesz się uczyć i sprawdź cenę Twojego kursu.</b></h4>
    </div>
  </div>
  <div class="row justify-content-center classicWhite">
    <div>
      <p class="ButtonsLabel">Jakiego języka chcesz się uczyć?</p>
      <select class="form-select pinkSelect" id="lang" onchange="language(event)">
        <option selected value="0/0/0">Wybierz język</option>
        @foreach($languages as $l)
          <option value="{{$l->price_type}}/{{$l->id}}/języka {{$l->name}}ego">Języka {{$l->name}}ego</option>
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
   
  </div>
  <button class="BuyButton" id="sign" onClick="buy()"> Zapisz się na zajęcia </button>
  <div id='formDiv'></div>
  <div id='formDiv2'></div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>

function searchFor(type)
  {
    window.location.href = `https://languelove.pl/priceList/search/${languageI}/${type}`;
  }

  let typeV = 0;
  let certyficateV = 0;
  let timeV = 0;
  let amountV = 0;
  let languageV = 0;
  let languageN = '';
  let languageI = 0;
  let price = 0;
  let letdesc = [];
  let desc = '';
  letdesc['1,60,1,1']=['119','139',`Za pojedynczą indywidualną 60-minutową lekcję z [LANG] przygotowującą do certyfikatu zapłacisz [CENA] zł.<br> By zapisać się na lekcje indywidualne z [LANG] kliknij <a onclick='searchFor(1)'><b class="second">&nbsptutaj!</b> </a>`,''];
  // letdesc['1,60,1,1']=[119,139,'Za pojedynczą indywidualną 60-minutową lekcję z [LANG] przygotowującą do certyfikatu zapłacisz [CENA] zł.','60-minutowa lekcja indywidualna z [LANG] przygotowująca do certyfikatu'];
  letdesc['1,60,1,5']=[585,685,'Za pakiet 5 lekcji indywidualnych 60-minutowych z [LANG], przygotowujących do certyfikatu zapłacisz [CENA] zł.','pakiet 5 lekcji indywidualnych 60-minutowych z [LANG], przygotowujących do certyfikatu'];
  letdesc['1,60,1,10']=[1149,1349,'Za pakiet 10 lekcji indywidualnych 60-minutowych z [LANG], przygotowujących do certyfikatu zapłacisz [CENA] zł.','pakiet 10 lekcji indywidualnych 60-minutowych z [LANG], przygotowujących do certyfikatu'];
  letdesc['1,60,1,30']=[3299,3959,'Za pakiet 30 lekcji indywidualnych 60-minutowych z [LANG], przygotowujących do certyfikatu, zapłacisz [CENA] zł.','pakiet 30 lekcji indywidualnych 60-minutowych z [LANG], przygotowujących do certyfikatu'];
  letdesc['1,60,0,1']=[99,109,`Za pojedynczą indywidualną 60-minutową lekcję z [LANG] zapłacisz [CENA] zł.<br> By zapisać się na lekcje indywidualne z [LANG] kliknij <a onclick='searchFor(1)'><b class="second">&nbsptutaj!</b> </a>`,'60-minutowa lekcja indywidualna z [LANG] '];
  letdesc['1,60,0,5']=[489,535,'Za pakiet 5 lekcji indywidualnych 60-minutowych z [LANG] zapłacisz [CENA] zł.','pakiet 5 lekcji indywidualnych 60-minutowych z [LANG]'];
  letdesc['1,60,0,10']=[949,1049,'Za pakiet 10 lekcji indywidualnych 60-minutowych z [LANG] zapłacisz [CENA] zł.','pakiet 10 lekcji indywidualnych 60-minutowych z [LANG]'];
  letdesc['1,60,0,30']=[2699,3059,'Za pakiet 30 lekcji indywidualnych 60-minutowych z [LANG] zapłacisz [CENA] zł.','pakiet 30 lekcji indywidualnych 60-minutowych z [LANG]'];
  letdesc['1,90,1,1']=[175,179,  `Za pojedynczą indywidualną 90-minutową lekcję z [LANG] przygotowującą do certyfikatu zapłacisz [CENA] zł. <br>By zapisać się na lekcje indywidualne z [LANG] kliknij <a onclick='searchFor(1)'> <b class="second">&nbsptutaj!</b> </a>`,'90-minutowa lekcja indywidualna z [LANG] przygotowująca do certyfikatu'];
  letdesc['1,90,1,5']=[865,885,'Za pakiet 5 lekcji indywidualnych 90-minutowych z [LANG], przygotowujących do certyfikatu zapłacisz [CENA] zł.','pakiet 5 lekcji indywidualnych 90-minutowych z [LANG], przygotowujących do certyfikatu'];
  letdesc['1,90,1,10']=[1699,1749,'Za pakiet 10 lekcji indywidualnych 90-minutowych z [LANG], przygotowujących do certyfikatu zapłacisz [CENA] zł.','pakiet 10 lekcji indywidualnych 90-minutowych z [LANG], przygotowujących do certyfikatu'];
  letdesc['1,90,1,30']=[4949,5159,'Za pakiet 30 lekcji indywidualnych 90-minutowych z [LANG], przygotowujących do certyfikatu zapłacisz [CENA] zł.','pakiet 30 lekcji indywidualnych 90-minutowych z [LANG], przygotowujących do certyfikatu'];
  letdesc['1,90,0,1']=[145,159,'Za pojedynczą indywidualną 90-minutową lekcję z [LANG] zapłacisz [CENA] zł. <br>By zapisać się na lekcje indywidualne z [LANG] kliknij <a onclick="searchFor(1)"> <b class="second">&nbsptutaj!</b> </a>','90-minutowa lekcja indywidualna z [LANG] '];
  letdesc['1,90,0,5']=[699,785,'Za pakiet 5 lekcji indywidualnych 90-minutowych z [LANG] zapłacisz [CENA] zł.','pakiet 5 lekcji indywidualnych 90-minutowych z [LANG]'];
  letdesc['1,90,0,10']=[1349,1549,'Za pakiet 10 lekcji indywidualnych 90-minutowych z [LANG] zapłacisz [CENA] zł.','pakiet 10 lekcji indywidualnych 90-minutowych z [LANG]'];
  letdesc['1,90,0,30']=[3899,4559,'Za pakiet 30 lekcji indywidualnych 90-minutowych z [LANG]o zapłacisz [CENA] zł.','pakiet 30 lekcji indywidualnych 90-minutowych z [LANG]'];
  letdesc['2,60,1,1']=[169,179,'Za pojedynczą 60-minutową lekcję w parze z [LANG], przygotowującą do certyfikatu, zapłacisz [CENA] zł.  <br>By zapisać się na lekcje indywidualne z [LANG] kliknij <a onclick="searchFor(4)"> <b class="second">&nbsptutaj!</b> </a>','60-minutowa lekcja w parze z [LANG] przygotowująca do certyfikatu'];
  letdesc['2,60,1,5']=[819,885,'Za pakiet 5 lekcji 60-minutowych w parze z [LANG], przygotowujących do certyfikatu, zapłacisz [CENA] zł.','pakiet 5 lekcji  60-minutowych w parze z [LANG], przygotowujących do certyfikatu'];
  letdesc['2,60,1,10']=[1599,1749,'Za pakiet 10 lekcji 60-minutowych w parze z [LANG], przygotowujących do certyfikatu, zapłacisz [CENA] zł.','pakiet 10 lekcji 60-minutowych w parze z [LANG], przygotowujących do certyfikatu'];
  letdesc['2,60,1,30']=[4619,5159,'Za pakiet 30 lekcji 60-minutowych w parze z [LANG], przygotowujących do certyfikatu, zapłacisz [CENA] zł.','pakiet 30 lekcji 60-minutowych w parze z [LANG], przygotowujących do certyfikatu'];
  letdesc['2,60,0,1']=[119,159,'Za pojedynczą 60-minutową lekcję w parze z [LANG] zapłacisz [CENA] zł.  <br>By zapisać się na lekcje indywidualne z [LANG] kliknij <a onclick="searchFor(4)"> <b class="second">&nbsptutaj!</b></a>','60-minutowa lekcja w parze z [LANG] '];
  letdesc['2,60,0,5']=[569,769,'Za pakiet 5 lekcji 60-minutowych w parze z [LANG] zapłacisz [CENA] zł.','pakiet 5 lekcji 60-minutowych w parze z [LANG]'];
  letdesc['2,60,0,10']=[1099,1499,'Za pakiet 10 lekcji 60-minutowych w parze z [LANG] zapłacisz [CENA] zł.','pakiet 10 lekcji 60-minutowych w parze z [LANG]'];
  letdesc['2,60,0,30']=[3119,4319,'Za pakiet 30 lekcji 60-minutowych w parze z [LANG] zapłacisz [CENA] zł.','pakiet 30 lekcji 60-minutowych w parze z [LANG]'];
  letdesc['2,90,1,1']=[199,239,'Za pojedynczą 90-minutową lekcję w parze z [LANG], przygotowującą do certyfikatu, zapłacisz [CENA] zł.  <br>By zapisać się na lekcje indywidualne z [LANG] kliknij <a onclick="searchFor(4)"><b class="second">&nbsptutaj!</b> </a>','90-minutowa lekcja w parze z [LANG] przygotowująca do certyfikatu'];
  letdesc['2,90,1,5']=[975,1185,'Za pakiet 5 lekcji 90-minutowych w parze z [LANG], przygotowujących do certyfikatu, zapłacisz [CENA] zł.','pakiet 5 lekcji 90-minutowych w parze z [LANG], przygotowujących do certyfikatu'];
  letdesc['2,90,1,10']=[1899,2349,'Za pakiet 10 lekcji 90-minutowych w parze z [LANG], przygotowujących do certyfikatu, zapłacisz [CENA] zł.','pakiet 10 lekcji 90-minutowych w parze z [LANG], przygotowujących do certyfikatu'];
  letdesc['2,90,1,30']=[5549,6899,'Za pakiet 30 lekcji 90-minutowych w parze z [LANG], przygotowujących do certyfikatu, zapłacisz [CENA] zł.','pakiet 30 lekcji 90-minutowych w parze z [LANG], przygotowujących do certyfikatu'];
  letdesc['2,90,0,1']=[175,199,'Za pojedynczą 90-minutową lekcję w parze z [LANG] zapłacisz [CENA] zł. <br> By zapisać się na lekcje indywidualne z [LANG] kliknij <a onclick="searchFor(1)"><b class="second">&nbsptutaj!</b> </a>','90-minutowa lekcja w parze z [LANG] '];
  letdesc['2,90,0,5']=[849,979,'Za pakiet 5 lekcji 90-minutowych w parze z [LANG]o zapłacisz [CENA] zł.','pakiet 5 lekcji 90-minutowych w parze z [LANG]'];
  letdesc['2,90,0,10']=[1649,1899,'Za pakiet 10 lekcji 90-minutowych w parze z[LANG] zapłacisz [CENA] zł.','pakiet 10 lekcji 90-minutowych w parze z [LANG]'];
  letdesc['1,90,0,30']=[4799,5399,'Za pakiet 30 lekcji 90-minutowych w parze z [LANG] zapłacisz [CENA] zł.','pakiet 30 lekcji 90-minutowych w parze z [LANG]'];
  letdesc['3,1']=[0,'Sprawdź dostępne kursy grupowe przygotowujące do certyfikatu z [LANG] <a onclick="showGroup([ID])"><b class="second">&nbsptutaj!</b></a>',''];
  letdesc['3,0']=[0,'Sprawdź dostępne kursy grupowe z [LANG] <a onclick="showGroup([ID])"><b class="second">&nbsptutaj!</b></a>',''];



  function kurs(e,id){
    var anchors = document.getElementsByClassName('typeButton');
    for(var i = 0; i < anchors.length; i++) {
        var anchor = anchors[i];
        anchor.classList.remove("choosenType");
    }
    e.target.classList.add("choosenType");
    typeV = id;
      document.getElementById('MoreInfo').style.display = 'block';
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
    WriteDescription();
  }
  function showGroup(idLan){
    let form = document.createElement('form');
      form.setAttribute('method','POST');
      form.setAttribute('action',"{{ route('search') }}");
    let type = document.createElement('input');
      type.setAttribute('name','type[]');
      type.setAttribute('type','hidden');
      type.value = 3;
    let lang = document.createElement('input');
      lang.setAttribute('name','lang[]');
      lang.setAttribute('type','hidden');
      lang.value = idLan;
    form.appendChild(type);
    form.innerHTML ='@csrf';
    form.appendChild(lang);
    document.getElementById('formDiv').appendChild(form);
    form.submit();
  }
  function WriteDescription(){
  //  if(typeV != 0 && typeV == 3){
      // document.getElementById('descriptionBox').innerHTML = letdesc[typeV+','+certyficateV][1];
  //  }
   let box =  document.getElementById('descriptionBox');
   let b=  document.getElementById('sign');
   if(typeV != 0 && typeV != 3){
    let lan = document.getElementById('lang').value.split('/');
    languageV = lan[0];
    languageI = lan[1];
    languageN = lan[2];
      if(timeV != 0 && amountV != 0 && languageV != 0){
        let tab = letdesc[typeV+','+timeV+','+certyficateV+','+amountV];
        let opis='';
        if(languageV == 1){
          document.getElementById('descriptionBox').innerHTML =  '<div style="text-align: center;">'+tab[2].replaceAll('[CENA]', tab[0]).replaceAll('[LANG]', languageN)+'</div>';
          price = tab[0];
        }else{
           document.getElementById('descriptionBox').innerHTML =  '<div style="text-align: center;">'+tab[2].replaceAll('[CENA]', tab[1]).replaceAll('[LANG]', languageN)+'</div>';
           price = tab[1];
        }
          desc = tab[3].replaceAll('[LANG]', languageN);
          box.style.display = 'flex';
          b.style.display = 'flex';
      }
   }
   else if( typeV == 3){
    let lan = document.getElementById('lang').value.split('/');
    languageV = lan[0];
    languageI = lan[1];
    languageN = lan[2];
    let tab = letdesc[typeV+','+certyficateV];
        if(certyficateV == 1){
          document.getElementById('descriptionBox').innerHTML = '<div style="text-align: center;">'+tab[1].replaceAll('[LANG]', languageN).replaceAll('[ID]', languageI)+'</div>';
        }else{
           document.getElementById('descriptionBox').innerHTML = '<div style="text-align: center;">'+tab[1].replaceAll('[LANG]', languageN).replaceAll('[ID]', languageI)+'</div>';
        }
       box.style.display = 'flex';
   }
   else{
    b.style.display = 'none';
    box.style.display = 'none';
   }
  }
  function buy(){
    let form = document.createElement('form');
      form.setAttribute('method','POST');
      form.setAttribute('action',"{{ route('transaction') }}");

    let descR = document.createElement('input');
      descR.setAttribute('name','desc');
      descR.setAttribute('type','hidden');
      descR.value = desc;

    let lang = document.createElement('input');
      lang.setAttribute('name','langDesc');
      lang.setAttribute('type','hidden');
      lang.value = languageI;

    let priceA = document.createElement('input');
      priceA.setAttribute('name','price');
      priceA.setAttribute('type','hidden');
      priceA.value = price;

    
    form.innerHTML ='@csrf';
    form.appendChild(lang);
    form.appendChild(descR);
    form.appendChild(priceA);
    document.getElementById('formDiv2').appendChild(form);
    form.submit();
  }
</script>