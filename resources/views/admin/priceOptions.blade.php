@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center classicDIV" id="topper">
        <div class="col-md-11 TwosideTable" >
        @foreach ($priceTypes as $pT)
            <div class="PriceTable">
                <h2 class="Tcenter">Cennik dla {{ $pT->name }} </h2>
                <table id="priceTable{{ $pT->id }}" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Zajęcia</th>
                            @foreach ($durations as $duration)
                                <th>{{ $duration->duration }} min</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($types as $type)
                     <tr>  
                        <th>{{ $type->name }}</th>
                        @foreach ($durations as $duration)
                           <td>
                            <div class="input-group mb-3" style="max-width: 100px;">
                                <input type="text" class="form-control" onfocusout="AddPrice(event,'{{$pT->id}}','{{$type->id}}','{{$duration->id}}',0)" value="{{$prices[$pT->id][$type->id][$duration->id][0] ?? ''}}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">zł</span>
                                </div>
                            </div>
                            <div class="input-group mb-3" style="max-width: 100px;">
                                <input type="text" class="form-control" onfocusout="AddPrice(event,'{{$pT->id}}','{{$type->id}}','{{$duration->id}}',1)" value="{{$prices[$pT->id][$type->id][$duration->id][1] ?? ''}}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">zł</span>
                                </div>
                            </div>
                           </td>
                        @endforeach 
                    </tr>    
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach            
        </div> 
    </div>
    <div class="row justify-content-center classicDIV mt-3" id="topper">
        <button class="btn btn-secondary mb-3" onclick="OpenModal('PacketModal')"> DODAJ NOWY PAKIET ZNIŻKOWY </button>
        <table id="packetTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>L.p</th>
                            <th>Typ</th>
                            <th>Ilość</th>
                            <th>Zniżka</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($packets as $packet)
                        <tr>  
                            <td>{{$loop->index+1}}</td>
                            <td>{{$priceTypes[$packet->price_type_id-1]->name}}</td>
                            <td>{{$packet->amount}}</td>
                            <td>{{$packet->discount}} %</td>
                        </tr>    
                    @endforeach
                    </tbody>
                </table>
    </div>

</div>
  <!-- Type modal -->
  <form class="Custom_modal" style="display: none; z-index: 3;" id="PacketModal">
      <h2 class="Tcenter">Dodaj pakiet zniżkowy</h2>
      <hr>
       <div class="ModalFlex">
          <div class="input-group mb-3">
            <span class="input-group-text col-md-2" id="name3">Ilość zajęć</span>
            <input type="number" class="form-control" aria-describedby="name3" name="amount" id="amount" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text col-md-2" id="name3">Zniżka w %</span>
            <input type="number" class="form-control" aria-describedby="name3" name="discount" id="discount" required>
          </div>
          <div class="input-group mb-3" id="TypeDiv">
            <span class="input-group-text col-md-2" id="type2">Typ</span>
            <!-- <input type="text" class="form-control" aria-describedby="type" name="type"> -->
          </div>
          <button class="btn btn-secondary  mb-3" onclick="AddPacket(event)">DODAJ PAKIET</button>
          <button class="btn btn-primary  mb-3" onclick="CloseModal('PacketModal')">ANULUJ</button>
        </div>
    </form>
  <!-- end TM -->
@endsection
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> 
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    let table;
    $(document).ready(function () {
        getTypes();
        @foreach ($priceTypes as $pT)
            $('#priceTable{{ $pT->id }}').DataTable({});
        @endforeach
        table = $('#packetTable').DataTable({});
        

    });
    function getTypes(){
        if(document.getElementById('type')){
            document.getElementById('type').remove();
        }
        let select = document.createElement("select"); //select with Price types
        select.setAttribute('name', 'type');
        select.setAttribute('id', 'type');
        select.setAttribute('class', 'form-control');
       
        $.ajax( "../api/price_types" )
            .done(function( data) {
                typesTable = data;
                for (const i in data) {
                    let option = document.createElement("option"); //select with Price types
                    option.setAttribute('value', data[i].id);
                    option.innerText = data[i].name;
                    select.appendChild(option);
                }
                document.getElementById('TypeDiv').appendChild(select);
            })
            .fail(function() {
                alert( "error" );
            });
    }
   function AddPrice(e,Pt,T,D,C){
        if(e.target.value){
            $.ajax({
            type: "POST",
            url: '../api/prices',
            data: {
                type_id: T, 
                price_type_id: Pt,
                duration_id: D,
                price: e.target.value,
                certification: C
            },
            })
            .done(function( data) {
                if(data == 1){
                }else{
                    console.log('Błąd dodawania');
                }
            })
            .fail(function() {
                console.log( "error" );
            });
        }
   }
   function AddPacket(e){
    e.preventDefault();
    let amount = document.getElementById('amount').value;
    let discount = document.getElementById('discount').value;
    let type = document.getElementById('type').value;
            $.ajax({
            type: "POST",
            url: '../api/packets',
            data: {
                price_type_id: type, 
                discount: discount,
                amount: amount
            },
            })
            .done(function( data) {
                if(data == 1){
                    location.reload();
                    CloseModal('PacketModal');
                }else{
                    console.log('Błąd dodawania');
                }
            })
            .fail(function() {
                console.log( "error" );
            });
   }
   function OpenModal(id){
        document.getElementById(id).style.display = 'block';
        document.getElementById('topper').style.pointerEvents = "none";
        document.getElementById('topper').style.opacity = "0.5";
    }
    function CloseModal(id){
        document.getElementById(id).style.display = 'none';
        document.getElementById('topper').style.pointerEvents = "";
        document.getElementById('topper').style.opacity = "1";
    }
</script>
