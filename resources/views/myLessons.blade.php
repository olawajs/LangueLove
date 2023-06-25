@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.css">
<style>
.card{
  padding: 10px;
  flex-direction: row !important;
  gap: 10px;
}
.act{
  color: green;
  font-weight: bold;
}
</style>
<div class="container mt-3 p-3">
  <h2>Lekcje do zaakceptowania</h2>
  <div class="CardContainer justify-content-around">
    @foreach($lessons as $l)
      @if(($l->user_id == Auth::user()->id && $l->student_accept == 0) || ($l->user_id != Auth::user()->id && $l->lector_accept == 0) )
        <div class="card">
          <div>
            <img  src="/images/lectors/{{$l->photo}}" width="100px">
            @if($l->user_id == Auth::user()->id)
            <div style="margin: 3px 0px;"><h4 class="text-center"><b>{{$l->name}}</b></h4></div>   
            @else
              <div style="margin: 3px 0px;"><h4 class="text-center"><b>{{$l->title}}</b></h4></div>   
            @endif
          </div>
          
          <div class="d-flex flex-column" style="gap: 5px; justify-content: center;">
          <span class="text-center">{{ \Carbon\Carbon::parse($l->start)->format('d-m-Y')}}<br> {{ \Carbon\Carbon::parse($l->start)->format('H:i')}}-{{ \Carbon\Carbon::parse($l->end)->format('H:i')}}</span>
            <div class="d-flex flex-column" style="gap: 5px; justify-content: center;">
              <button class="btn btn-primary" onClick="accept({{$l->id}},event)">Akceptuj termin</button>
              <!-- <button class="btn btn-secondary">Odrzuć termin</button> -->
            </div>
            
          </div>  
        </div>
      @endif
    @endforeach
  </div>
  <hr>
  <h2>Lekcje czekające na akceptacje</h2>
  <div class="CardContainer justify-content-around">
    @foreach($lessons as $l)
    @if(($l->user_id == Auth::user()->id && $l->lector_accept == 0) || ($l->user_id != Auth::user()->id && $l->student_accept == 0) )
      <div class="card">
          <div style="max-width: 150px;display: flex;flex-flow: column;align-items: center;">
            <img  src="/images/lectors/{{$l->photo}}" width="100px">
            @if($l->user_id == Auth::user()->id)
            <div style="margin: 3px 0px;"><h4 class="text-center"><b>{{$l->name}}</b></h4></div>   
            @else
              <div style="margin: 3px 0px;"><h4 class="text-center"><b>{{$l->title}}</b></h4></div>   
            @endif
          </div>
          <div class="d-flex flex-column" style="gap: 5px; justify-content: center;">
            <span class="text-center">{{ \Carbon\Carbon::parse($l->start)->format('d-m-Y')}}<br> {{ \Carbon\Carbon::parse($l->start)->format('H:i')}}-{{ \Carbon\Carbon::parse($l->end)->format('H:i')}}</span>
          </div>  
        </div>
      @endif
    @endforeach
  </div>
  
</div>

 
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 


<script>
  function accept(id,e){
    let par = e.target.parentElement;
    
    $.ajax({
            type: "GET",
            url: '../accept/'+id,
            })
            .done(function(data) 
            {
                if(data == 1){
                  console.log('Akceptowano');
                  par.innerHTML = '<span class="act">AKCEPTOWANO</span>';
                }else{
                    console.log('Błąd dodawania');
                }
            })
            .fail(function() {
                console.log( "error" );
            });
  }

</script>