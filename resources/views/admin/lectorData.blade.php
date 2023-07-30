<!DOCTYPE HTML> 
@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
            <!-- <form method="POST" action="{{ route('editLector') }}" enctype="multipart/form-data"> -->
            <!-- @csrf -->
            <div class="FormContainer">
                <div class="inputDIV">
                    <input type="file" name="photo" id="file_input" value="" class="file_upload">
                    <div id="gallery">
                        <div>
                            <img src="<?php echo asset("images/lectors/{$lector->photo}")?>" width="200">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="TwoColumns">
                        <div class="form-group col-md-5">
                            <label for="name">Imię</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$lector->name}}" onfocusout="editInfo(event)" placeholder="Imię" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="surname">Nazwisko</label>
                            <input type="text" class="form-control" id="surname" name="surname" value="{{$lector->surname}}" onfocusout="editInfo(event)" placeholder="Nazwisko" required>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$lector->email}}" onfocusout="editInfo(event)" placeholder="Email" required>
                        </div>
                    <div class="TwoColumns">
                        <div class="form-group col-md-5">
                            <label for="native_language">Język ojczysty</label>
                            <select name="native_language_id" id="native_language_id" onfocusout="editInfo(event)" class="form-control" required>
                                @foreach ($langs as $lang)
                                    <option value="{{$lang->id}}">{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-5" id="pozDiv">
                            <label for="native_language">Poziom językowy:</label></label>
                            @foreach($levels as $level)
                                <div style="display: flex; justify-content: space-around;">
                                    <div class="col-md-5">
                                            <select name="native_language1" class="form-control" onchange="editLevels('language_id','{{$level->id}}',event)" required>
                                                <option value="0">-</option>
                                                @foreach ($langs as $lang)
                                                    <option value="{{$lang->id}}" @if($lang->id == $level->language_id) selected @endif>{{$lang->name}}</option>
                                                @endforeach
                                            </select>  
                                        </div>
                                    <div class="col-md-5">
                                            <select name="language_level1" onchange="editLevels('level','{{$level->id}}',event)" class="form-control" required>
                                                <option value="0" >-</option>
                                                <option value="Ojczysty" @if($level->level == "Ojczysty" ) selected @endif>Ojczysty</option>
                                                <option value="A1"  @if($level->level == "A1") selected @endif>A1</option>
                                                <option value="A2"  @if($level->level == "A2") selected @endif>A2</option>
                                                <option value="B1"  @if($level->level == "B1") selected @endif>B1</option>
                                                <option value="B2"  @if($level->level == "B2") selected @endif>B2</option>
                                                <option value="C1"  @if($level->level == "C1") selected @endif>C1</option>
                                                <option value="C2"  @if($level->level == "C2") selected @endif>C2</option>
                                                <option value="A1 - A2"  @if($level->level == "A1-A2") selected @endif>A1 - A2</option>
                                                <option value="A1 - C1" @if($level->level == "A1-C1") selected @endif >A1 - C1</option>
                                                <option value="A2 - C1"  @if($level->level == "A2-C1") selected @endif>A2 - C1 </option>
                                                <option value="A1 - B1" @if($level->level == "A1-B1") selected @endif>A1 - B1</option>
                                                <option value="A1 - C2" @if($level->level == "A1-C2") selected @endif>A1 - C2</option>
                                                <option value="A1 - B2" @if($level->level == "A1-B2") selected @endif>A1 - B2</option>
                                                <option value="Business English" @if($level->level == "Business English") selected @endif>Business English</option>
                                                <option value="Przygotowanie do egzaminu/ matury" @if($level->level == "Przygotowanie do egzaminu/matury") selected @endif>Przygotowanie do egzaminu/ matury</option>
                                                <option value="Konwersacje" @if($level->level == "Konwersacje") selected @endif>Konwersacje</option>
                                                <option value="Języki specjalistyczne" @if($level->level == "Języki specjalistyczne") selected @endif>Języki specjalistyczne</option>
                                                <option value="Dialekt" @if($level->level == "Dialekt") selected @endif>Dialekt</option>
                                                <option value="Italiano al lavoro" @if($level->level == "Italiano al lavoro") selected @endif>Italiano al lavoro</option>
                                                <option value="Kultura krajów portugalskojęzycznych" @if($level->level == "Kultura krajów portugalskojęzycznych") selected @endif>Kultura krajów portugalskojęzycznych</option>
                                                <option value="Nauka o dialektach" @if($level->level == "Nauka o dialektach") selected @endif>Nauka o dialektach</option>
                                                <option value="Português no turismo" @if($level->level == "Português no turismo") selected @endif>Português no turismo</option>
                                                <option value="Polish for foreigners" @if($level->level == "Polish for foreigners") selected @endif>Polish for foreigners</option>
                                                <option value="NATIVE SPEAKER" @if($level->level == "NATIVE SPEAKER") selected @endif>NATIVE SPEAKER</option>
                                                <option value="Language for Specific Purposes" @if($level->level == "Language for Specific Purposes") selected @endif>Language for Specific Purposes</option>
                                                <option value="Français au travail" @if($level->level == "Français au travail") selected @endif>Français au travail</option>
                                                <option value="Deutsch bei der Arbeit" @if($level->level == "Deutsch bei der Arbeit") selected @endif>Deutsch bei der Arbeit</option>
                                                <option value="Chiński w pracy" @if($level->level == "Chiński w pracy") selected @endif>Chiński w pracy</option>
                                                <option value="Kultura Chin" @if($level->level == "Kultura Chin") selected @endif>Kultura Chin</option>
                                                <option value="Turecki w pracy" @if($level->level == "Turecki w pracy") selected @endif>Turecki w pracy</option>
                                                <option value="Kultura Turcji" @if($level->level == "Kultura Turcji") selected @endif>Kultura Turcji</option>
                                                <option value="Inne" @if($level->level == "Inne") selected @endif>Inne</option>
                                                <option value="Español en el trabajo" @if($level->level == "Español en el trabajo") selected @endif>Español en el trabajo</option>
                                            </select>
                                    </div>
                                    
                                </div>
                            @endforeach

                        </div>
                            <div class="col-md-1">
                                <button class="plusButton" onclick="AddLangLevel(event)">
                                    +
                                </button>
                            </div>
                    </div> 
                    
                    <div class="form-group col-md-12">
                        <label for="education">Wykształcenie</label>
                        <textarea class="form-control" id="education" onfocusout="editInfo(event)"  name="education" required>{{$lector->education}}</textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="street">Ulica i numer domu</label>
                        <input class="form-control" id="street" name="street" onfocusout="editInfo(event)" value="{{$lector->street}}" required placeholder="Ulica i numer domu">
                    </div>
                    <div class="TwoColumns">
                        <div class="form-group col-md-5">
                            <label for="post_code">Kod Pocztowy</label>
                            <input type="text" class="form-control" id="post_code" onfocusout="editInfo(event)" value="{{$lector->post_code}}" name="post_code" placeholder="Kod pocztowy" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="city">Miasto</label>
                            <input type="text" class="form-control" id="city" name="city" onfocusout="editInfo(event)" value="{{$lector->city}}" placeholder="Miasto" required>
                        </div>
                    </div>
                    <div class="TwoColumns">
                        <div class="form-group col-md-5">
                            <label for="phone">Telefon</label>
                            <input type="text" class="form-control" id="phone" onfocusout="editInfo(event)" value="{{$lector->phone}}" name="phone" placeholder="Telefon">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="skype">Skype</label>
                            <input type="text" class="form-control" id="skype" onfocusout="editInfo(event)" value="{{$lector->skype}}" name="skype" placeholder="Skype link" required>
                        </div>
                    </div>
                </div>
                
            </div>  
            <div class="FormContainer">
                <div class="form-group col-md-12">
                        <label for="description">Opis</label>
                        <textarea class="form-control" id="description" onblur="editInfoTiny('description',event)" name="description">{{$lector->description}}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="style">Styl nauczania</label>
                        <textarea class="form-control" id="style" onblur="editInfoTiny('style',event)" name="style">{{$lector->style}}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="levels">Levele: </label>
                        <textarea class="form-control" id="levels" onblur="editInfoTiny('levels',event)" name="levels">{{$lector->levels}}</textarea>
                    </div>
            </div>
                <input type="hidden" name="languageAmount" id="languageAmount" value="{{count($levels)}}">
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
                <input type="hidden" value="{{$lector->id}}" name="id_lector">
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
           <!-- </form> -->
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
    <script src="https://cdn.tiny.cloud/1/r7yvsqva0lmrh081yjb12u1yyn51cak9j4frujmxqj8ihg31/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
     tinymce.init({
    selector: 'textarea#description', 
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: true,
    setup: function(ed) {
        ed.on('submit', function(e) { ed.save(); });
        ed.on('focusout', function(e) {editInfo2('description',ed.getContent());});
    }
  });
  tinymce.init({
    selector: 'textarea#levels', 
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: true,
    setup: function(ed) {
        ed.on('submit', function(e) { ed.save(); });
        ed.on('focusout', function(e) {editInfo2('levels',ed.getContent());});
    }
  });
  tinymce.init({
    selector: 'textarea#style', 
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: true,
    setup: function(ed) {
        ed.on('submit', function(e) { ed.save(); });
        ed.on('focusout', function(e) {editInfo2('style',ed.getContent());});
    }
  });
</script>

<script>
   var calendar; 
   let lanDiv = ' <div style="display: flex; gap: 7px; margin-left: 3px;">'+
             '               <div class="col-md-5">'+
             '                       <select name="native_language#" class="form-control" required>'+
             '                           <option value="0">-</option>'+
                                        @foreach ($langs as $lang)
             '                               <option value="{{$lang->id}}">{{$lang->name}}</option>'+
                                      @endforeach
             '                       </select>  '+
             '                                </div>'+
             '               <div class="col-md-5">'+
             '                       <select name="language_level#" class="form-control" required>'+
             '                                   <option value="0">-</option>'+
            '                              <option value="Ojczysty">Ojczysty</option>'+
            '                               <option value="A1">A1</option>'+
            '                               <option value="A2">A2</option>'+
            '                               <option value="B1">B1</option>'+
            '                               <option value="B2">B2</option>'+
            '                               <option value="C1">C1</option>'+
            '                               <option value="C2">C2</option>'+
            '                               <option value="A1 - A2">A1 - A2</option>'+
            '                               <option value="A1 - C1">A1 - C1</option>'+
            '                               <option value="A2 - C1">A2 - C1 </option>'+
            '                               <option value="A1 - B1">A1 - B1</option>'+
            '                               <option value="A1 - C2">A1 - C2</option>'+
            '                               <option value="A1 - B2">A1 - B2</option>'+
            '                               <option value="Business English">Business English</option>'+
            '                              <option value="Przygotowanie do egzaminu/ matury">Przygotowanie do egzaminu/ matury</option>'+
            '                               <option value="Konwersacje">Konwersacje</option>'+
            '                               <option value="Języki specjalistyczne">Języki specjalistyczne</option>'+
            '                               <option value="Dialekt">Dialekt</option>'+
            '                               <option value="Italiano al lavoro">Italiano al lavoro</option>'+
            '                               <option value="Kultura krajów portugalskojęzycznych">Kultura krajów portugalskojęzycznych</option>'+
            '                               <option value="Nauka o dialektach">Nauka o dialektach</option>'+
            '                               <option value="Português no turismo">Português no turismo</option>'+
            '                              <option value="Polish for foreigners">Polish for foreigners</option>'+
            '                               <option value="NATIVE SPEAKER">NATIVE SPEAKER</option>'+
            '                               <option value="Language for Specific Purposes">Language for Specific Purposes</option>'+
            '                               <option value="Français au travail">Français au travail</option>'+
            '                               <option value="Deutsch bei der Arbeit">Deutsch bei der Arbeit</option>'+
            '                               <option value="Chiński w pracy">Chiński w pracy</option>'+
            '                               <option value="Kultura Chin">Kultura Chin</option>'+
            '                               <option value="Turecki w pracy">Turecki w pracy</option>'+
            '                               <option value="Kultura Turcji">Kultura Turcji</option>'+
            '                               <option value="Inne">Inne</option>'+
            '                               <option value="Español en el trabajo">Español en el trabajo</option>'+
             '                           <option value="C1">C1</option>'+
             '                           <option value="C2">C2</option>'+
             '                           <option value="Inne">Inne</option>'+
             '                       </select>'+
             '               </div>'+
             '           </div>';
let LanAmount = {{count($levels)}};
let lector = {{$lector->id}};
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
        let end = dateToYMD(new Date().addWeeks(30));
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
function editInfo(e){
    let column = e.target.id;
    $.ajax({
            type: "POST",
            url: '../editLector',
            data: {
                column: column, 
                value: e.target.value,
                lector: lector,
                _token: "{{ csrf_token() }}",
            },
        })
        .done(function( data) {
            if(data == 1){
               alert('Edytowano');
            }else{
                alert('Wystąpił błąd');
            }
        })
        .fail(function() {
            alert( "error" );
        });
}
function editInfo2(column,e){
    $.ajax({
            type: "POST",
            url: '../editLector',
            data: {
                column: column, 
                value: e,
                lector: lector,
                _token: "{{ csrf_token() }}",
            },
        })
        .done(function( data) {
            if(data == 1){
               alert('Edytowano');
            }else{
                alert('Wystąpił błąd');
            }
        })
        .fail(function() {
            alert( "error" );
        });
}
function editLevels(column,id,e){
   
    $.ajax({
            type: "POST",
            url: '../editLevel',
            data: {
                column: column, 
                value: e.target.value,
                id: id,
                _token: "{{ csrf_token() }}",
            },
        })
        .done(function( data) {
            if(data == 1){
               alert('Edytowano');
            }else{
                alert('Wystąpił błąd');
            }
        })
        .fail(function() {
            alert( "error" );
        });
}
// 

</script>
