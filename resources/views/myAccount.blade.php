@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.css">
<style>
.wallet {
  --bg-color: var(--bs-primary);
  --bg-color-light: #753ab2;
  --text-color-hover: #fff;
  --box-shadow-color: rgba(206, 178, 252, 0.48);
}
.wallet2 {
  --bg-color: var(--bs-secondary);
  --bg-color-light: #e595a8;
  --text-color-hover: #fff;
  --box-shadow-color: rgba(206, 178, 252, 0.48);
}

.card {
  width: 220px;
  height: 321px;
  background: #fff;
  border-top-right-radius: 10px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  position: relative;
  box-shadow: 0 14px 26px rgba(0, 0, 0, 0.04);
  transition: all 0.3s ease-out;
  text-decoration: none;
}

.card:hover {
  transform: translateY(-5px) scale(1.005) translateZ(0);
  box-shadow: 0 24px 36px rgba(0, 0, 0, 0.11),
    0 24px 46px var(--box-shadow-color);
}

.card:hover .overlay {
  transform: scale(4) translateZ(0);
}

.card:hover .circle {
  border-color: var(--bg-color-light);
  background: var(--bg-color);
}

.card:hover .circle:after {
  background: var(--bg-color-light);
}

.card:hover p {
  color: var(--text-color-hover);
}

.card p {
  font-size: 17px;
  color: #4c5656;
  margin-top: 30px;
  z-index: 1000;
  transition: color 0.3s ease-out;
}

.circle {
  width: 131px;
  height: 131px;
  border-radius: 50%;
  background: #fff;
  border: 2px solid var(--bg-color);
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  z-index: 1;
  transition: all 0.3s ease-out;
}

.circle:after {
  content: "";
  width: 118px;
  height: 118px;
  display: block;
  position: absolute;
  background: var(--bg-color);
  border-radius: 50%;
  top: 7px;
  left: 7px;
  transition: opacity 0.3s ease-out;
}

.circle svg {
  z-index: 10000;
  transform: translateZ(0);
}

.overlay {
  width: 118px;
  position: absolute;
  height: 118px;
  border-radius: 50%;
  background: var(--bg-color);
  top: 32px;
  left: 50px;
  z-index: 0;
  transition: transform 0.3s ease-out;
}
.number{
    font-size: xxx-large;
    color: white;
    z-index: 10;
}
.container2{
    display: flex;
    justify-content: space-around;
    padding: 50px 0;
    flex-wrap: wrap;

}
a{
  text-decoration: none;
}
.content{
  background-color: #f7f9fb;
  border: none;
}
</style>
<div class="container2">
    <form method="POST" action="{{ route('search') }}">
      @csrf
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="1" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="2" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="3" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="4" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="5" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="6" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="9" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="10" checked>
      <input style="display: none" type="checkbox" class="inputs typeInp" name="type[]" value="1" checked>
      <button class="content" id="content">
        <div class="card wallet">
            <div class="overlay"></div>
            <div class="circle">
                <div class="number">{{$IndEur}}</div>
            </div>
            <p>Lekcje indywidualne</p>
            <p>Języki europejskie</p>
        </div>   
      </button>
    </form>
     
    <!--  -->
    <form method="POST" action="{{ route('search') }}">
      @csrf
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="1" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="2" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="3" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="4" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="5" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="6" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="9" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="10" checked>
      <input style="display: none" type="checkbox" class="inputs typeInp" name="type[]" value="4" checked>
      <button class="content" id="content">
        <div class="card wallet">
            <div class="overlay"></div>
            <div class="circle">
                <div class="number">{{$IndAzj}}</div>
            </div>
            <p>Lekcje w parze</p>
            <p>Języki europejskie</p>
        </div>   
      </button>
    </form>
    <!--  -->
    <form method="POST" action="{{ route('search') }}">
      @csrf
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="7" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="8" checked>
      <input style="display: none" type="checkbox" class="inputs typeInp" name="type[]" value="1" checked>
      <button class="content" id="content">
        <div class="card wallet2">
            <div class="overlay"></div>
            <div class="circle">
                <div class="number">{{$ParEur}}</div>
            </div>
            <p>Lekcje indywidualne</p>
            <p>Języki azjatyckie</p>
        </div>   
      </button>
    </form>
    <!--  -->
    <form method="POST" action="{{ route('search') }}">
      @csrf
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="7" checked>
      <input style="display: none" type="checkbox" class="inputs langInp" name="lang[]" value="8" checked>
      <input style="display: none" type="checkbox" class="inputs typeInp" name="type[]" value="4" checked>
      <button class="content" id="content">
        <div class="card wallet2">
            <div class="overlay"></div>
            <div class="circle">
                <div class="number">{{$ParAzj}}</div>
            </div>
            <p>Lekcje w parze</p>
            <p>Języki azjatyckie</p>
        </div>   
      </button>
    </form>
   
</div>
<div class="d-flex p-2 justify-content-around align-items-center"style="flex-direction: column">
    <!-- @if($newsletter == 0)
        <a class="btn btn-secondary mb-3">Zapisz się do newslettera</a>
    @else
        <a class="btn btn-primary mb-3">Wypisz się z newslettera</a>
    @endif -->
    <a class="btn btn-danger mb-3" href="{{ route('deleteAccount') }}">Usuń konto</a>
</div>
 
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 


<script>
  

</script>