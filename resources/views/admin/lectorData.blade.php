@extends('layouts.app')

<style>
.inputDIV {
   position: relative;
   width: 200px;
   height: 300px !important;
   line-height: 30px;
   text-align: center;
   background-image: url('https://cdn.pixabay.com/photo/2017/03/19/03/51/material-icon-2155448_960_720.png');
    background-position: center;
    background-size: 100px;
    background-repeat: no-repeat;
    background-color: #e1e1e1;
}

.file_upload {
   opacity: 0.0;
   /* IE 8 */
   -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
   /* IE 5-7 */
   filter: alpha(opacity=0);
   /* Netscape or and older firefox browsers */
   -moz-opacity: 0.0;
   /* older Safari browsers */
   -khtml-opacity: 0.0;
   position: absolute;
   top: 0;
   left: 0;
   bottom: 0;
   right: 0;
   width: 100%;
   height:100%;
}
.TwoColumns{
    display: flex;
    justify-content: space-between;
}
.FormContainer{
    display: flex;
    justify-content: space-around;
    padding: 5px;
    flex-wrap: wrap;
}
.plusButton{
    height: 100%;
    border: none;
    border-radius: 5px;
    background: var(--bs-primary);
    color: white;
}
h2{
    text-align: center;
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
@section('content')
<div class="container" style="width: 100%">

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Dane</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="calendar-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false" onClick="cal()">Kalendarz</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
        <div class="justify-content-center classicDIV" id="topper">
            <h2>Karta lektora</h2>
            <form method="POST" action="{{ route('editLector') }}" enctype="multipart/form-data">
            @csrf
                <div class="FormContainer">
                    <div class="inputDIV">
                        <input type="file" name="photo" id="file_input" value="" class="file_upload">
                        <div id="gallery">
                            <div>
                                <img src="<?php echo asset("images/lectors/{$lector[0]->photo}")?>" width="200">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="TwoColumns">
                            <div class="form-group col-md-5">
                                <label for="name">Imię</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$lector[0]->name}}" placeholder="Imię" required>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="surname">Nazwisko</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="{{$lector[0]->surname}}" placeholder="Nazwisko" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$lector[0]->email}}" placeholder="Email" required>
                            </div>
                        <div class="TwoColumns">
                            <div class="form-group col-md-5">
                                <label for="native_language">Język ojczysty</label>
                                <select name="native_language_id" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group col-md-5" id="pozDiv">
                                <label for="native_language">Poziom językowy:</label></label>
                                <div style="display: flex; justify-content: space-around;">
                                    <div class="col-md-5">
                                            <select name="native_language1" class="form-control" required>
                                                <option value="0">-</option>
                                            </select>  
                                        </div>
                                    <div class="col-md-5">
                                            <select name="language_level1" class="form-control" required>
                                                <option value="0">-</option>
                                                <option value="Ojczysty">Ojczysty</option>
                                                <option value="A1">A1</option>
                                                <option value="A2">A2</option>
                                                <option value="B1">B1</option>
                                                <option value="B2">B2</option>
                                                <option value="C1">C1</option>
                                                <option value="C2">C2</option>
                                                <option value="Inne">Inne</option>
                                            </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="plusButton" onclick="AddLangLevel(event)">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group col-md-12">
                            <label for="education">Wykształcenie</label>
                            <textarea class="form-control" id="education" name="education" required>{{$lector[0]->education}}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="description">Opis</label>
                            <textarea class="form-control" id="description" name="description" required>{{$lector[0]->description}}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="street">Ulica i numer domu</label>
                            <input class="form-control" id="street" name="street" value="{{$lector[0]->street}}" required placeholder="Ulica i numer domu">
                        </div>
                        <div class="TwoColumns">
                            <div class="form-group col-md-5">
                                <label for="post_code">Kod Pocztowy</label>
                                <input type="text" class="form-control" value="{{$lector[0]->post_code}}" id="post_code" name="post_code" placeholder="Kod pocztowy" required>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="city">Miasto</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{$lector[0]->city}}" placeholder="Miasto" required>
                            </div>
                        </div>
                    </div>
                    
                </div>  
                <input type="hidden" name="languageAmount" id="languageAmount" value="1">
                <button type="submit" class="btn btn-primary col-md-12">Zapisz</button>
            </form>
            
        </div>
  </div>
  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
    <div class="CalDiv">
        <div id="calendar" style="width: 800px"></div>
        <div class="Setup">
            <form method="POST" action="{{ route('AddSetup') }}">
                @csrf
                <input type="hidden" value="{{$lector[0]->id}}" name="id_lector">
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
    </div>
  
  </div>
</div>

   
        

<!-- modals -->
<!-- Modals -->
 

<!-- end modals -->

</div>
@endsection
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> 
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
<script>
   var calendar; 


 $( document ).ready(function() {      
   
    //
        Date.prototype.addHours= function(h){
            this.setHours(this.getHours()+h);
            return this;
        }
        Date.prototype.addWeeks= function(h){
            this.setDate(this.getDate() + 7 * h);
            return this;
        }
        function dateToYMD(date) {
            var d = date.getDate();
            var m = date.getMonth() + 1; //Month from 0 to 11
            var y = date.getFullYear();
            return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
        }

        let now= dateToYMD(new Date().addHours(-120));
        let now2= new Date().addHours(12);
        let end = dateToYMD(new Date().addWeeks(10));
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            slotMinTime:"07:00",
            slotMaxTime:"23:00",
            allDaySlot: false,
            hiddenDays: [ 0 ], //wyłączenie niedzieli
            editable: true,
            locale: 'pl',
            eventOverlap:false,
            validRange: {
                start: '2023-02-27 09:00',
                end: end,
            },
            events:{
                url: '/admin/getSetup/{{$id}}',
                method: 'GET',
            } ,
            selectConstraint: "businessHours",
            eventClick: function(info) {
                
            },
            dateClick: function(info) {
                if(info.jsEvent.explicitOriginalTarget.innerText == 'Wolny termin'){
                      alert('Clicked on: ' + info.dateStr);
                }
                
            },
        });
        calendar.render();
//
var fileInput = document.getElementById('file_input');
fileInput.addEventListener("change", () => {

div = document.createElement("div");

for(let file of fileInput.files) {
    var image = file
    if (image) {
        var imageElement = new Image();
        imageElement.src = URL.createObjectURL(image);
        imageElement.width = 200;
        document.getElementById('gallery').innerHTML='';
        document.getElementById('gallery').appendChild(div);
        div.appendChild(imageElement);


        $("img").click(function(){
            // console.log(4);
        });
    }
}
});



});

function cal() { 
     calendar.render();
}
function AddLangLevel(e) { 
    e.preventDefault();
    LanAmount++;
    let MainDiv = document.getElementById('pozDiv');
    document.getElementById('languageAmount').value = LanAmount;
    let tekst = lanDiv;
    MainDiv.insertAdjacentHTML('beforeend',tekst.replace('@', LanAmount));
    
}
// 

</script>
