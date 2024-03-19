@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.css">
<style>
.container{
  padding: 0 120px;
}
.input-div {
  position: relative;
}

.input2 {
  position: absolute;
  opacity: 0;
  width: 100%;
  height: 100%;
  cursor: pointer !important;
}


</style>
<div class="container">
  <div class="accordion row ">
      <div class="menuRadio2 col-3">
        <div style="font-size: 20px; font-weight: 500;">Moje konto</div>
        <div style="display: flex;  flex-flow: column;">
          <div class="custom-radio2">
            <input type="radio" id="radioButton1" name="radioGroup" onclick="showContent('section1')" checked>
            <label for="radioButton1">Moje zajęcia</label>
          </div>
          <div class="custom-radio2">
            <input type="radio" id="radioButton2" name="radioGroup" onclick="showContent('section2')">
            <label for="radioButton2">Wiadomości</label>
          </div>
          <div class="custom-radio2">
            <input type="radio" id="radioButton3" name="radioGroup" onclick="showContent('section3')">
            <label for="radioButton3">Powiadomienia</label>
          </div>
          <div class="custom-radio2">
            <input type="radio" id="radioButton4" name="radioGroup" onclick="showContent('section4')" >
            <label for="radioButton4">Ustawienia</label>
          </div>
          <div class="custom-radio2">
            <input type="radio" id="radioButton5" name="radioGroup" onclick="showContent('section5')" >
            <label for="radioButton1">Wyloguj się</label>
          </div>
        </div>
        

      </div>
      <div class="col-1"></div>
      <div id="section1" class="content col-8">1    </div>
      <div id="section2" class="content hidden col-8">2    </div>
      <div id="section3" class="content hidden col-8">3    </div>
      <div id="section4" name="ustawienia" class="content hidden col-8">
        <div class="bubbleCard">
          <form name="photo" id="imageUploadForm" enctype="multipart/form-data" class="input-div">
          @csrf
            <input class="input2" name="file" id="fileInput" type="file">
            <img style="width: 125px; height: 125px" @if($user->img == '') src="{{ asset('images/fileInput.svg') }}" @else src="{{$user->img}}" @endif id="fileDisplayArea" class="" alt="">
            <img style="position: absolute;  right: 0;  bottom: 0;" src="{{ asset('images/camera.svg') }}" class="" alt="">
          </form>
          <div style="width: 100%;  display: flex;  align-items: center;">
            <b style="white-space: nowrap;">Imię i nazwisko: </b><input class="input" id="name" name="name" value="{{$user->name}}">
          </div>
          <div>
            <button class="clearButton">Zmień</button>
          </div>
        </div>
      </div>
      <div id="section5" class="content hidden col-8">5    </div>

  </div>
</div>

    
<!-- <div class="d-flex p-2 justify-content-around align-items-center"style="flex-direction: column">
    @if($newsletter == 0)
        <a class="btn btn-secondary mb-3" onclick="SignIn(event)">Zapisz się do newslettera</a>
    @else
        <a class="btn btn-primary mb-3" onclick="SignOut(event)">Wypisz się z newslettera</a>
    @endif
    <a class="btn btn-danger mb-3" href="{{ route('deleteAccount') }}">Usuń konto</a>
</div> -->
 
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 


<script>
  
  function SignIn(e){
    $.ajax({
              type: "GET",
              url: '../signIn',
              data: {
                  email: '{{Auth::user()->email}}', 
              },
            })
            .done(function( data) {
              if(data == 1){
                alert('Dziękujemy za zapisanie się do newslettera!');
              }
            })
            .fail(function() {
                console.log( "error" );
            });
    event.target.innerText = 'Wypisz się z newslettera';
    event.target.setAttribute('onclick','SignOut(event)');
  }
  function SignOut(e){
    $.ajax({
              type: "GET",
              url: '../signOff',
              data: {
                  email: '{{Auth::user()->email}}', 
              },
            })
            .done(function( data) {
              if(data == 1){
                alert('Subskrypcja anulowana');
              }
            })
            .fail(function() {
                console.log( "error" );
            });
    event.target.innerText = 'Zapisz się do newslettera';
    event.target.setAttribute('onclick','SignIn(event)');
  }

  function showContent(sectionId) {
      // Ukryj wszystkie sekcje
      var sections = document.querySelectorAll('.content');
      sections.forEach(function(section) {
        section.classList.add('hidden');
      });

      // Pokaż wybraną sekcję
      var selectedSection = document.getElementById(sectionId);
      selectedSection.classList.remove('hidden');
    }
    $(document).ready(function (e) {
    $('#imageUploadForm').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: '../savePhoto',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
             if(isNumeric(data)){
              if(data == -1){
                console.log('zły typ pliku');
              }else{
                console.log('za duży plik');
              }
                
              }else{
                console.log("success");
                console.log(data);
                let link = `images/users/${data}?`+ new Date().getTime();
                $("#fileDisplayArea").attr("src",link);
              }
                
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

    $("#fileInput").on("change", function() {
        $("#imageUploadForm").submit();
    });
    
});
function isNumeric(value) {
    return /^-?\d+$/.test(value);
}
</script>