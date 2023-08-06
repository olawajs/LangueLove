@extends('layouts.app')
@section('content')
<style>
    .content{
        margin-top: 15px;
    }
    input[type='checkbox'] {
        accent-color:var(--bs-secondary);
    }
    .checkRow{
        padding: 5px;
        margin: auto;
    }
    .floatForm{
        position: fixed;
        background-color: var(--bs-sandy);
        margin: auto;
        width: 70%;
        z-index: 2;
        display: none;
    }
    #buyButton{
        width: 100%;
        margin-top: 10px;
    }
</style>
<div class="container">

    <div class="content">
    
            <div class="row justify-content-center lessonDIV">
                <h2>{{$lesson->title}}</h2>
                <span class="SType">  {{ App\Models\LessonDuration::find($lesson->duration_id)->duration }} min / {{ App\Models\LessonType::find($lesson->type_id)->name }} / Język {{ App\Models\Language::find($lesson->language_id)->name}} <i class="flag flag-{{ App\Models\Language::find($lesson->language_id)->short}}"></i>  </span>
                <div class="lectorDesc">
                    <div class="searchFoto"><img src="/images/lectors/{{$lector->photo}}" style='width:190px; height: 190px; object-fit: cover;'></div>
                    <div>
                        <div><b>{{$lector->name}}</b></div>
                        <!-- <div>{!!$lector->description!!}</div> -->
                       
                    </div> 
                    <div>
                        <h5><b>Terminy zajęć: </b></h5>
                        @foreach ($calendarLessons as $date)
                            <div class="SdateDiv">{{ \Carbon\Carbon::parse($date->start)->locale('pl')->dayName}} {{ \Carbon\Carbon::parse($date->start)->format('d.m')}} godz. {{ \Carbon\Carbon::parse($date->start)->format('H:i')}}</div>
                        @endforeach
                    </div>
                </div>
                
                <div class="LessonText">

                    <div>
                        <div><b>Dostępnych miejsc: </b>{{$lesson->amount_of_students}}</div>
                    </div>
                    <div>
                        <b>Cena: </b><span class="SPrice"><b>{{$lesson->price*$lesson->amount_of_lessons}} zł</b> /  {{$lesson->amount_of_lessons}} lekcji</span>
                    </div>
                    

                    @if($lesson->description != '')
                    <hr>
                    <div>
                        <h6><b>Opis:</b></h6>
                        <span>{!!$lesson->description!!}</span>
                    </div>
                    @endif
                    @if($lesson->draft != '')
                    <hr>
                    <div>
                        <h6><b>Plan zajęć:</b></h6>
                        <span>{!!$lesson->draft!!}</span>
                    </div>
                    @endif
                   
                    <!-- <div><b>Opis</b>{{$lesson->description}}</div> -->
                   
                </div>
                <form class="floatForm" id="buyForm" method='POST' action="{{ route('buyLesson') }}">
                @csrf
                <h2 class="Tcenter"> Podsumowanie płatności:</h2>
                    <h3 class="Tcenter">Do zapłaty: <b id="kwotaZaplaty">{{$lesson->price*$lesson->amount_of_lessons}} zł</b></h3>
                    
                    <h2 class="Tcenter">Dane do faktury: </h2>
                        <div class="box">
                            <span class="napis">Imię i nazwisko: </span>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="box">
                            <span class="napis">Ulica i numer domu: </span>
                            <input type="text" class="form-control" name="street" id="street" required>
                        </div>
                        <div class="box">
                            <span class="postcode">Kod Pocztowy: </span>
                            <input type="text" class="form-control" name="postcode" id="postcode" required>
                        </div>
                        <div class="box">
                            <span class="napis">Miasto: </span>
                            <input type="text" class="form-control" name="city" id="city" required>
                        </div>
                        <div class="box">
                            <span class="napis">NIP: </span>
                            <input type="text" class="form-control" name="nip" id="nip">
                        </div>
                        <div class="box">
                            <span class="napis" style="width: 100%; display: inline-block;">Posiadasz kod rabatowy? Wpisz go poniżej : </span>
                            <input type="text" class="form-control" style="width: calc(100% - 100px); float: left" name="code" id="code">
                            <button class="btn btn-secondary" style="width: 100px" onclick="checkCode()">Użyj kod</button>
                            <span id="codeResponse" class="napis" style="width: 100%; display: inline-block;"></span>
                        </div>

                    <input type="hidden" name="duration_id" value="{{$lesson->duration_id}}">
                    <input type="hidden" name="jezyk" value="{{$lesson->language_id}}">
                    <input type="hidden" name="rodzaj" value="{{$lesson->type_id}}">
                    <input type="hidden" name="lectorId" value="{{$lector->id}}">
                    <input type="hidden" name="ile" value="{{$lesson->amount_of_lessons}}">
                    <input type="hidden" name="zajecia" value="1">
                    <input type="hidden" name="price" id="price" value="{{$lesson->price*$lesson->amount_of_lessons}}">
                    <input type="hidden" name="lessonId" value="{{$lesson->id}}">
                    <input type="hidden" name="title" value="{{$lesson->title}}">
                    <input type="hidden" name="PromoCode" id="PromoCode" value="">
                    <button class="btn btn-secondary  mb-3" id="buyButton" type="submit">ZAPŁAĆ TERAZ</button>
                    <input type="button" class="btn btn-primary mb-3 close" id="buyButton" value="ANULUJ">
                </form>
                    <button class="btn btn-secondary SButton open">Zarezerwuj i zapłać</a>
            </div>
    
    </div>
    
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 

<script>
    let useCode = false;
    $(document).ready(function () {
        
        $('.langInp').click(function() {
            check(event,1);
        });
        $('.close').click(function() {
            document.getElementById('buyForm').style.display="none";
        });
        $('.open').click(function() {
            var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
            if(!AuthUser){
                window.location.href = "{{ route('login')}}";
            }else{
                document.getElementById('buyForm').style.display="block";
            }
        });
        $('.typeInp').click(function() {
            check(event,2);
        });
       


        function check(e,type) {
            let id ='';
            let class1 = '';
            let text = '';
            if(type == 1){
                id='lang0';
                class1 = 'langInp';
                text = 'langText';
            }
            if(type == 2){
                id='type0';
                class1 = 'typeInp';
                text = 'typeText';
            }
            let textSpan = document.getElementById(text);
            if(e.target.value == '0'){
                var anchors = document.getElementsByClassName(class1);
                for(var i = 0; i < anchors.length; i++) {
                    var anchor = anchors[i];
                    anchor.checked = false;
                }
                e.target.checked = true;
                textSpan.innerText = 'Dowolny';
            }
            else{
                document.getElementById(id).checked = false;
                if(textSpan.innerText == 'Dowolny'){
                    textSpan.innerText =  e.target.parentElement.innerText;
                }else{
                    if(!textSpan.innerText.includes("i więcej")){
                        textSpan.innerText += ' i więcej';
                    }
                    
                }
                   
            }

        }
    })
    function checkCode(){
        event.preventDefault();
        let code = document.getElementById('code').value;
        // alert(code);
        if(!useCode){
            useCode = true;
            $.ajax({
            type: "POST",
            url: '../checkCode',
            data: {
                code: code,
                type: 2,
                _token: "{{ csrf_token() }}",
            },
            })
            .done(function( data) {
                if(data != 0){
                    let container = document.getElementById('kwotaZaplaty');
                    let kwota = document.getElementById('price');
                    let opis = document.getElementById('codeResponse');
                    let PromoCode = document.getElementById('PromoCode');
                    
                    let amount = data.amount;
                    let nowaKwota;
                    if(data.type == '%'){
                        nowaKwota = kwota.value - (kwota.value*(amount/100));
                    }
                    else{
                        nowaKwota = kwota.value - amount;
                        
                    }
                    kwota.value = nowaKwota;
                    container.innerText = nowaKwota+' zł';
                    opis.innerHTML = '<span style="color: green"><b>Kod został przypisany</b></span>';
                    PromoCode.value = data.code;
                }
                else{
                    opis.innerHTML = '<span style="color: red"><b>Kod nie istnieje bądź został już wykorzystany</b></span>';
                }
            })
            .fail(function() {
                alert( "error" );
            });
        }
        
    }
   
</script>