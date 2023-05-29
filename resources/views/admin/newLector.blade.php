<!DOCTYPE HTML> 
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
</style>
@section('content')

<div class="container">
    <div class="justify-content-center classicDIV" id="topper">
        <h2>Karta lektora</h2>
        <form method="POST" action="{{ route('addLector') }}" enctype="multipart/form-data">
         @csrf
            <div class="FormContainer">
                <div class="inputDIV">
                    <input type="file" name="photo" id="file_input" class="file_upload" required>
                    <div id="gallery"></div>
                </div>
                <div>
                    <div class="TwoColumns">
                        <div class="form-group col-md-5">
                            <label for="name">Imię</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Imię" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="surname">Nazwisko</label>
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Nazwisko" required>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                    <div class="TwoColumns">
                        <div class="form-group col-md-5">
                            <label for="native_language">Język ojczysty</label>
                            <select name="native_language_id" class="form-control" required>
                                @foreach ($langs as $lang)
                                    <option value="{{$lang->id}}">{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-5" id="pozDiv">
                            <label for="native_language">Poziom językowy:</label></label>
                            <div style="display: flex; justify-content: space-around;">
                                <div class="col-md-5">
                                        <select name="native_language1" class="form-control" required>
                                            <option value="0">-</option>
                                            @foreach ($langs as $lang)
                                                <option value="{{$lang->id}}">{{$lang->name}}</option>
                                            @endforeach
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
                        <textarea class="form-control" id="education" name="education" required></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">Opis</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="style">Styl nauczania</label>
                        <textarea class="form-control" id="style" name="style"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="levels">Levele: </label>
                        <textarea class="form-control" id="levels" name="levels" required></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="street">Ulica i numer domu</label>
                        <input class="form-control" id="street" name="street" required placeholder="Ulica i numer domu">
                    </div>
                    <div class="TwoColumns">
                        <div class="form-group col-md-5">
                            <label for="post_code">Kod Pocztowy</label>
                            <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Kod pocztowy" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="city">Miasto</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Miasto" required>
                        </div>
                    </div>
                </div>
                
            </div>  
            <input type="hidden" name="languageAmount" id="languageAmount" value="1">
            <button type="submit" class="btn btn-primary col-md-12">Zapisz</button>
        </form>
        
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
    }
  });
</script>

<script>
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
             '                           <option value="0">-</option>'+
             '                           <option value="Ojczysty">Ojczysty</option>'+
             '                                        <option value="A1">A1</option>'+
             '                                        <option value="A2">A2</option>'+
             '                                        <option value="B1">B1</option>'+
             '                                        <option value="B2">B2</option>'+
             '                           <option value="C1">C1</option>'+
             '                           <option value="C2">C2</option>'+
             '                           <option value="Inne">Inne</option>'+
             '                       </select>'+
             '               </div>'+
             '           </div>';
let LanAmount = 1;
 $( document ).ready(function() {      
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
function AddLangLevel(e) { 
    e.preventDefault();
    LanAmount++;
    let MainDiv = document.getElementById('pozDiv');
    document.getElementById('languageAmount').value = LanAmount;
    let tekst = lanDiv;
    tekst = tekst.replaceAll("#", LanAmount);
    MainDiv.insertAdjacentHTML('beforeend',tekst);
    
}
</script>
