@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center classicDIV" id="topper">
        <div class="col-md-11 TwosideTable" >
            <div>
                <h2 class="underline-magenta Tcenter">Dodaj nowy język</h2>
                <button type="button" class="btn btn-primary col-md-12 mb-3" onclick = "OpenModal('LanguageModal')">Dodaj nowy język</button>
                <table id="langTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Skrót</th>
                            <th>Typ</th>
                            <th>Aktywny</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <div>
                <h2 class="underline-magenta Tcenter">Dodaj nowy typ języka</h2>
                <button type="button" class="btn btn-primary col-md-12 mb-3" onclick = "OpenModal('TypeModal')">Dodaj nowy typ</button>
                <table id="typeTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Aktywny</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            
        </div> 
    </div>
    <!-- modals -->

<!-- Modals -->
  <!-- Language modal -->
    <form class="Custom_modal" style="display: none; z-index: 3;" id="LanguageModal">
      <h2 class="Tcenter">Dodaj nowy język</h2>
      <hr>
       <div id="addNewLanguage" class="ModalFlex">
          <div class="input-group mb-3">
            <span class="input-group-text col-md-2" id="name2">Nazwa</span>
            <input type="text" class="form-control" aria-describedby="name2" name="name" id="name" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text col-md-2" id="short2">Skrót</span>
            <input type="text" class="form-control" aria-describedby="short2" name="short" id="short" required>
          </div>
          <div class="input-group mb-3" id="TypeDiv">
            <span class="input-group-text col-md-2" id="type2">Typ</span>
            <!-- <input type="text" class="form-control" aria-describedby="type" name="type"> -->
          </div>
          <button class="btn btn-secondary  mb-3" onclick="AddLanguage(event)">DODAJ JĘZYK</button>
          <button class="btn btn-primary  mb-3" onclick="CloseModal('LanguageModal')">ANULUJ</button>
        </div>
    </form>
  <!-- end LM -->
  <!-- Type modal -->
  <form class="Custom_modal" style="display: none; z-index: 3;" id="TypeModal">
      <h2 class="Tcenter">Dodaj typ języka</h2>
      <hr>
       <div class="ModalFlex">
          <div class="input-group mb-3">
            <span class="input-group-text col-md-2" id="name3">Nazwa</span>
            <input type="text" class="form-control" aria-describedby="name3" name="nameType" id="nameType" required>
          </div>
          <button class="btn btn-secondary  mb-3" onclick="AddLenType(event)">DODAJ JĘZYK</button>
          <button class="btn btn-primary  mb-3" onclick="CloseModal('TypeModal')">ANULUJ</button>
        </div>
    </form>
  <!-- end TM -->

<!-- end modals -->

</div>
@endsection
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> 
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">

    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    let typesTable =[];
    let table;
    $(document).ready(function () {
        getTypes();
        table = $('#langTable').DataTable({
            ajax: {
                url: '../api/languages',
                dataSrc: "",
                dataType: "json",
            },
            columns: [
                { data: 'name' },
                { data: 'short' },
                { sortable: false,
                    "render": function ( data, type, full, meta ) {
                        return typesTable[full.price_type-1].name;
                }},
                { data: 'active' },
            ],
            order: [[ 0, "desc" ], [ 1, "desc" ]],
        });
        table2 = $('#typeTable').DataTable({
            ajax: {
                url: '../api/price_types',
                dataSrc: "",
                dataType: "json",
            },
            columns: [
                { data: 'name' },
                { data: 'active' },
            ],
            order: [[ 0, "desc" ], [ 1, "desc" ]],
        });

       
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
    function AddLanguage(e){
        e.preventDefault();
        let typ = document.getElementById('type').value;
        let nazwa = document.getElementById('name').value;
        let short = document.getElementById('short').value;
        $.ajax({
            type: "POST",
            url: '../api/languages',
            data: {
                name: nazwa, 
                short: short, 
                price_type: typ,
                active: 1
            },
        })
        .done(function( data) {
            if(data == 1){
                table.ajax.reload();
                CloseModal('LanguageModal');
            }else{
                alert('Wystąpił błąd');
            }
        })
        .fail(function() {
            alert( "error" );
        });
    }
    function AddLenType(e){
        e.preventDefault();
        let nazwa = document.getElementById('nameType').value;
        $.ajax({
            type: "POST",
            url: '../api/price_types',
            data: {
                name: nazwa,
                active: 1
            },
        })
        .done(function( data) {
            if(data == 1){
                table2.ajax.reload();
                CloseModal('TypeModal');
            }else{
                alert('Wystąpił błąd');
            }
        })
        .fail(function() {
            alert( "error" );
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
