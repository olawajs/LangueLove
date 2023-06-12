@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.css">
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
    .cena1{
        text-align: center;
        font-size: x-large;
    }
    .box{
        margin: 5px 0;
    }
    .px-a{
        padding-right: 100px;
        padding-left: 100px;
        padding-bottom: 50px;
    }
    .fotoContainer{
        border-radius: 10px !important;
        border: 2px solid #EBEBEB;
        min-height: 200px;
        margin: 10px;
        padding: 10px;
    }
    p{
        text-align: justify;
    }
</style>
<div class="container px-a">

    <div class="content" id="content">
        <div class="d-flex" style="gap:20px;">
            <div class="d-flex flex-column" style="flex-grow: 3; gap:20px;">
                <h2>O lektorze</h2>
                <h3><b>{{$lector->name}}</b></h3>
                <div>{!! $lector->description !!}</div>
                <h2>Poziomy nauczania</h2>
                <div class="SType" style="margin: 10px;">
                    @foreach ($levels as $d)
                        <span class="SPrice"><i class="flag flag-{{ App\Models\Language::find($d->language_id)->short}}"></i>{{ $d->level}}</span>
                    @endforeach
                </div>
                <div>{!! $lector->levele !!}</div>
                @if($lector->style != '')
                <h2>Styl nauczania:</h2>
                <div>{!! $lector->style !!}</div>
                @endif
            </div>
            <div class="d-flex justify-content-center flex-column align-items-center fotoContainer" style="flex-grow: 1;max-height: 450px;">
                <div class="searchFoto"><img src="/images/lectors/{{$lector->photo}}" style='width:280px; height: 280px; object-fit: cover;'></div>
                <h4>{{$lector->name}}</h4>
                <div class="SType" style="margin: 10px;">
                    @foreach (App\Models\LanguageLevel::where('lector_id',$lector->id)->distinct('language_id')->pluck('language_id') as $d)
                        <span><i class="flag flag-{{ App\Models\Language::find($d)->short}}"></i>Język {{ App\Models\Language::find($d)->name}}</span><br>
                    @endforeach
                </div>
                <button class="btn btn-primary mb-3" onclick="przejdzDo()">Zobacz terminarz</button>
            </div>
        </div>
                <div>
                    <div id="calendar"></div>
                </div>
    </div>
    
</div>

<!-- Language modal -->
<form class="Custom_modal" style="display: none; z-index: 3;" id="BuyModal" method='POST' action="{{ route('buyLesson') }}">
    @csrf
      <h2 class="Tcenter">SZCZEGÓŁY ZAKUPU: </h2>
      <hr>
       <div id="addNewLanguage" class="ModalFlex">
        <input type="hidden" value="{{$lector->id}}" name="lectorId"> 
            <div class="box">
                <span class="napis">Data: </span>
                <input type="date" class="form-control" name="data" id="data"  readonly>
            </div>
            <div class="box">
                <span class="napis" for="godzina">Godzina rozpoczęcia: </span>
                <input type="time" class="form-control timepicker" name="godzina" id="godzina" readonly>
            </div>
            <div class="box">
                <span class="napis" for="data">Długość zajęć: </span>
                <select class="form-control CountCost" name="duration_id" id="duration_id">
                    @foreach($durations as $d)
                        <option value="{{$d->id}}">{{$d->duration}} min</option>
                    @endforeach
                </select>
            </div>
            <div class="box">
                <span class="napis" for="jezyk">Język: </span>
                <select class="form-control CountCost" name="jezyk" id="jezyk" autocomplete="off">
                    @foreach($languages as $l)
                        <option value="{{$l->id}}">{{$l->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="box">
                <span class="napis" for="rodzaj">Rodzaj zajęć: </span>
                <select class="form-control CountCost" name="rodzaj" id="rodzaj">
                        <option value="1">Indywidualne</option>
                        <option value="4">W parach</option>
                </select>
            </div>
            <div class="form-check form-switch box">
                <input class="form-check-input" type="checkbox" role="switch" id="cykliczne" name="cykliczne" onchange="cykl(event)">
                <label class="form-check-label" for="cykliczne">Zajęcia cykliczne</label>
            </div>
            <div class="form-check form-switch box">
                <input class="form-check-input  CountCost" type="checkbox" role="switch" id="cert" name="cert">
                <label class="form-check-label" for="cert">Przygotowanie do certyfikatu</label>
            </div>
            <div id="ileLekcji" style="display: none" class="box">
                <span class="napis" for="ile">Ilość: </span>
                <input type="number" class="form-control CountCost" name="ile" id="ile" step="1" min="1" placeholder="Ilość lekcji">
            </div>
           <p class="cena1">Do zapłaty: <b id='kwota'></b></p>
           <hr>
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
          <button class="btn btn-secondary  mb-3" id="buyButton" type="submit">ZAPŁAĆ TERAZ</button>
          <input type="button" class="btn btn-primary mb-3" onclick="CloseModal('BuyModal')" value="ANULUJ">
        </div>
    </form>
  <!-- end LM -->

@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 


<script>
    let kwota = 0;
    let ok = true;
    $(document).ready(function () {

        $('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            minTime: '7:00am',
            maxTime: '8:30pm',
            defaultTime: '11',
            startTime: '7:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });


        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            slotMinTime:"07:00",
            slotDuration: '00:15:00',
            slotMaxTime:"23:00",
            allDaySlot: false,
            hiddenDays: [ 0 ], //wyłączenie niedzieli
            editable: true,
            locale: 'pl',
            eventOverlap:false,
            validRange: {
                start: new Date(),
            },
            events:{
                url: '/getCalendar/{{$lector->id}}',
                method: 'GET',
            } ,

            selectConstraint: "businessHours",
            eventClick: function(info) {
                
            },
            dateClick: function(info) {
                var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
                if(!AuthUser){
                    window.location.href = "{{ route('login')}}";
                }else{
                    let text = '';
                    if(typeof info.jsEvent.explicitOriginalTarget === "undefined"){
                        text=info.jsEvent.target.textContent;
                    }
                    else{
                        text=info.jsEvent.explicitOriginalTarget.textContent;
                    }
                   if(text == 'Wolny termin' ){
                   
                        let data = info.date; 
                        document.getElementById('data').value = data.getFullYear() + "-" +((data.getMonth()).length != 2 ? "0" + (data.getMonth()+1) : (data.getMonth()+1)) + "-" + ((data.getDate()).length != 2 ? "0" + (data.getDate()) : (data.getDate())) ;
                        document.getElementById('godzina').value = data.getHours() + ":" +((data.getMinutes()) <= 9 ? "0" + (data.getMinutes()) : (data.getMinutes()));
                        OpenModal('BuyModal');
                    } 
                }
                
                
            },
        });
        calendar.render();

           function OpenModal(id){
            document.getElementById(id).style.display = 'block';
            document.getElementById('content').style.pointerEvents = "none";
            document.getElementById('content').style.opacity = "0.2";
            Cost();
            var anchors = document.getElementsByClassName('CountCost');
            for(var i = 0; i < anchors.length; i++) {
                var anchor = anchors[i];
                anchor.onchange = function(){Cost();  validTermins();};
            }
            validTermins();
        }
    })
    function Cost(){
        if(document.getElementById('ile').value >=5){
            alert('Dziękujemy za wybranie tak dużej ilości zajęć! Zajrzyj do naszego cennika, aby kupić pakiet zajęć w okazyjnej cenie!!!');
        }
        let cert = 0;
        if(document.getElementById('cert').checked){
            cert = 1;
        }
        $.ajax({
            type: "POST",
            url: '../api/count',
            data: {
                language: document.getElementById('jezyk').value, 
                duration: document.getElementById('duration_id').value, 
                ile: document.getElementById('ile').value,
                rodzaj: document.getElementById('rodzaj').value,
                cert: cert
            },
        })
        .done(function( data) {
           kwota = data;
           document.getElementById('kwota').innerText = kwota + 'zł';
        })
        .fail(function() {
            alert( "error" );
        });
    }
    
    function validTermins(){
        $.ajax({
            type: "POST",
            url: '../api/validTermins',
            data: {
                lector: '{{$lector->id}}', 
                date: document.getElementById('data').value, 
                hour: document.getElementById('godzina').value,
                dlugosc: document.getElementById('duration_id').value,
                ile: document.getElementById('ile').value
            },
        })
        .done(function( data) {
            let button  = document.getElementById('buyButton');
            if(data == 0){
                alert('Przepraszamy, ale wybrana data jest niedostępna bądź koliduje z innymi zajęciami. Prosimy o wybranie innej godziny bądź długości zajęć, dziękujemy!');
                ok = false;
                button.disabled = true;
            }
            else{
                ok = true;
                button.disabled = false;
            }
        })
        .fail(function() {
            alert( "error" );
        });
    }
       
        function cykl(e){
            if(e.target.checked){
                document.getElementById('ileLekcji').style.display = 'block';
            }else{
                document.getElementById('ileLekcji').style.display = 'none';
                document.getElementById('ile').value = 1;
                Cost();
            }

        }
        function CloseModal(id){
            document.getElementById(id).style.display = 'none';
            document.getElementById('content').style.pointerEvents = "";
            document.getElementById('content').style.opacity = "1";
        }
        function przejdzDo(){
            const element = document.getElementById("calendar");
            element.scrollIntoView();
        }
</script>