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
    .CalDiv{
    display: flex;
    justify-content: space-around;
    width: 100%;
    flex-wrap: wrap;
}
#calendar{
    margin-bottom: 30px;
}
.Setup{

}
.SetupDate{
    display: flex;
    justify-content: stretch;
    gap: 15px;
    margin-top: 10px;
}
input[type=time] {
  width: 80px;
  float: left;
}
.weekday{
    width: 100px;
}
/* radio */
.radio-buttons {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgb(199, 84, 112);
  border-radius: 15px;
  box-shadow: rgb(199, 84, 112) 0px 5px 29px 5px;
  width: fit-content;
  margin: 15px auto;
}

.radio-buttons label {
  position: relative;
  cursor: pointer;
}

.radio-buttons input[type="radio"] {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.option {
  position: relative;
  display: inline-block;
  padding-top: 10px;
  padding-bottom: 10px;
  border: none;
  color: black;
  border-radius: 14px;
  padding: 10px;
  color: white;
}

.option:hover {
    background-color: rgb(227, 93, 125);
}

.radio-buttons input[type="radio"]:checked + .option {
  background-color: rgb(60, 0, 121);
  box-shadow: rgb(85, 0, 171) 0px 5px 29px 5px;
  color: white;
}
</style>
<div class="container" id="container">

    <div class="content" id="content">
    
            <div class="row justify-content-center lessonDIV">
                        <div>Lekcji do wykorzystania: {{$to_use}}</div>
                        <div class="CalDiv justify-content-center d-flex" style="gap: 15px">
        <div id="calendar" style="width: 800px"></div>
        @if (Auth::user()->user_type == 3)
        <div class="Setup">
            <form method="POST" action="{{ route('AddSetup') }}">
                @csrf
                <input type="hidden" value="{{App\Models\Lector::where('id_user',Auth::user()->id)->first()->id}}" name="id_lector">
                <h3>Dostępność:</h3>
                <div class="SetupDate">
                    <label for="date_from">Od: </label><input class="form-control" type="date" id="date_from" name="date_from" required>
                    <label for="date_to">Do: </label><input class="form-control" type="date" id="date_to" name="date_to" required>
                </div>
                <div class="radio-buttons">
                    <label>
                        <input type="radio" name="option" value="1" checked="">
                        <span class="option">Dostępne</span>
                    </label>
                    <label>
                        <input type="radio" name="option" value="0">
                        <span class="option">Zajęte</span>
                    </label>
                </div>

                <table style="width: 100%">
                    <tr>
                        <td class="weekday">
                            Poniedziałek:
                        </td>
                        <td>
                            <input class="form-control" type="time" id="from_1" name="from_1" value="00:00" required>
                            <label for="pon_to">Do: </label><input class="form-control" type="time" id="to_1" name="to_1"  value="00:00" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="weekday">
                            Wtorek:
                        </td>
                        <td>
                            <input class="form-control" type="time" id="from_2" name="from_2" value="00:00" required>
                            <input class="form-control" type="time" id="to_2" name="to_2" value="00:00" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="weekday">
                            Środa:
                        </td>
                        <td>
                            <input class="form-control" type="time" id="from_3" name="from_3" value="00:00" required>
                            <input class="form-control" type="time" id="to_3" name="to_3" value="00:00" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="weekday">
                            Czwartek:
                        </td>
                        <td>
                            <input class="form-control" type="time" id="from_4" name="from_4" value="00:00" required>
                            <input class="form-control" type="time" id="to_4" name="to_4" value="00:00" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="weekday">
                            Piątek:
                        </td>
                        <td>
                            <input class="form-control" type="time" id="from_5" name="from_5" value="00:00" required>
                            <input class="form-control" type="time" id="to_5" name="to_5" value="00:00" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="weekday">
                            Sobota:
                        </td>
                        <td>
                            <input class="form-control" type="time" id="from_6" name="from_6" value="00:00" required>
                        <input class="form-control" type="time" id="to_6" name="to_6" value="00:00" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <button class="btn btn-secondary col-12" type="submit"> Zapisz </button>
                        </td>
                    
                    </tr>
                </table>
           </form>
        </div> 
        @endif
    </div>
  
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
    <p><b>Email: </b><span id="em"></span></p>
    <p><b>Link do spotkania: </b><span id="li"></span></p>
    <p><b id="op"></b></p>
    
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 


<script>
    let kwota = 0;
    let ok = true;
    let link = '';
    let b = "{{App\Models\Lector::firstOrFail()->where('id_user',Auth::user()->id)->pluck('id')}}";
    b=b.slice(1, -1);
    let a = '{{Auth::user()->user_type}}';
    if(a == 3){
        link = "/admin/getSetup/"+b;
    }
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
            eventSources: [
                '/getMyCalendar',
                link
            ],
            // events:{
            //     url: '/getMyCalendar',
            //     method: 'GET',
            // } ,

            selectConstraint: "businessHours",
            eventClick: function(info) {
                let id = info.event._def.publicId;
                // console.log(calendar.getEvents());
                document.getElementById('op').innerHTML = calendar.getEventById( id )._def.extendedProps.opis;
                document.getElementById('li').innerText = calendar.getEventById( id )._def.extendedProps.skype;
                document.getElementById('le').innerText = calendar.getEventById( id )._def.extendedProps.lektor;
                document.getElementById('ty').innerText = calendar.getEventById( id )._def.extendedProps.typeL;
                document.getElementById('je').innerText = calendar.getEventById( id )._def.extendedProps.typeJ;
                document.getElementById('em').innerText = calendar.getEventById( id )._def.extendedProps.email;
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