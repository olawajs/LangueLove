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
</style>
<div class="container" id="container">

    <div class="content" id="content">
    
            <div class="row justify-content-center lessonDIV">
                        <div>Lekcji do wykorzystania: {{$to_use}}</div>
                        <div id="calendar" style="width: 800px"></div>
            </div>
    
    </div>
    
</div>

@endsection
<div id="infoPOP" style="display: none">
    <span class="closeButton" onclick="closePop()">X</span>
    <h2>Szczegóły zajęć:</h2>
    <p><b>Lektor: </b><span id="le"></span></p>
    <p><b>Język: </b><span id="je"></span></p>
    <p><b>Typ zajęć: </b><span id="ty"></span></p>
    <p><b>Link do spotkania: </b><span id="li"></span></p>
    <p><b id="op"></b></p>
    
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 


<script>
    let kwota = 0;
    let ok = true;
    $(document).ready(function () {


        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            slotMinTime:"07:00",
            slotDuration: '00:30:00',
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
                url: '/getMyCalendar',
                method: 'GET',
            } ,

            selectConstraint: "businessHours",
            eventClick: function(info) {
                let id = info.event._def.publicId;
                // console.log(calendar.getEvents());
                document.getElementById('op').innerHTML = calendar.getEventById( id )._def.extendedProps.opis;
                document.getElementById('li').innerText = calendar.getEventById( id )._def.extendedProps.skype;
                document.getElementById('le').innerText = calendar.getEventById( id )._def.extendedProps.lektor;
                document.getElementById('ty').innerText = calendar.getEventById( id )._def.extendedProps.typeL;
                document.getElementById('je').innerText = calendar.getEventById( id )._def.extendedProps.typeJ;
                document.getElementById('infoPOP').style.display = 'block';
                document.getElementById('container').style.filter = 'blur(4px)';
                // alert('Tu pojawi się okienko z informacjami: imię lektora, język oraz link do skype :)');
            },
            dateClick: function(info) {
                var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
                if(!AuthUser){
                    window.location.href = "{{ route('login')}}";
                }else{
                   if(info.jsEvent.explicitOriginalTarget.innerText == 'Wolny termin'){
                        let data = info.date;
                        document.getElementById('data').value = data.getFullYear() + "-" +((data.getMonth()).length != 2 ? "0" + (data.getMonth()+1) : (data.getMonth()+1)) + "-" + data.getDate();
                        document.getElementById('godzina').value = data.getHours() + ":" +((data.getMinutes()) <= 9 ? "0" + (data.getMinutes()) : (data.getMinutes()));
                        // console.log('date: ' + Date.parse(info.dateStr).toISOString());
                        OpenModal('BuyModal');
                    } 
                }
                
                
            },
        });
        calendar.render();


    })
    function closePop()
    {
        document.getElementById('infoPOP').style.display = 'none';
        document.getElementById('container').style.filter = 'none';
    }

</script>