@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center classicDIV" id="topper">
        <div class="col-md-11 TwosideTable" >
            <div>
                <h2 class="underline-magenta Tcenter">Długość zajęć</h2>
                <button type="button" class="btn btn-primary col-md-12 mb-3" onclick = "OpenModal('DurationModal')">Dodaj nową wartość</button>
                <table id="durationTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Czas trwania</th>
                            <th>Aktywny</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <div>
                <h2 class="underline-magenta Tcenter">Dodaj nowy typ zajęć</h2>
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
    <form class="Custom_modal" style="display: none; z-index: 3;" id="DurationModal">
      <h2 class="Tcenter">Dodaj nową wartość</h2>
      <hr>
       <div class="ModalFlex">
          <div class="input-group mb-3">
            <span class="input-group-text col-md-3" id="name2">Czas trwania</span>
            <input type="text" class="form-control" aria-describedby="name2" name="duration" id="duration" required>
          </div>
          <button class="btn btn-secondary  mb-3" onclick="AddDuration(event)">DODAJ WARTOŚĆ</button>
          <button class="btn btn-primary  mb-3" onclick="CloseModal('DurationModal')">ANULUJ</button>
        </div>
    </form>
  <!-- end LM -->
  <!-- Type modal -->
  <form class="Custom_modal" style="display: none; z-index: 3;" id="TypeModal">
      <h2 class="Tcenter">Dodaj typ zajęć</h2>
      <hr>
       <div class="ModalFlex">
          <div class="input-group mb-3">
            <span class="input-group-text col-md-2" id="name3">Nazwa</span>
            <input type="text" class="form-control" aria-describedby="name3" name="nameType" id="nameType" required>
          </div>
          <button class="btn btn-secondary  mb-3" onclick="AddType(event)">DODAJ ZAJĘCIA</button>
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
        table = $('#durationTable').DataTable({
            ajax: {
                url: '../api/lesson_durations',
                dataSrc: "",
                dataType: "json",
            },
            columns: [
                { data: 'duration' },
                { data: 'active' },
            ],
            order: [[ 0, "desc" ], [ 1, "desc" ]],
        });
        table2 = $('#typeTable').DataTable({
            ajax: {
                url: '../api/lesson_types',
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
    function AddDuration(e){
        e.preventDefault();
        let duration = document.getElementById('duration').value;
        $.ajax({
            type: "POST",
            url: '../api/lesson_durations',
            data: {
                duration: duration, 
                active: 1
            },
        })
        .done(function( data) {
            if(data == 1){
                table.ajax.reload();
                CloseModal('DurationModal');
            }else{
                alert('Wystąpił błąd');
            }
        })
        .fail(function() {
            alert( "error" );
        });
    }
    function AddType(e){
        e.preventDefault();
        let nazwa = document.getElementById('nameType').value;
        $.ajax({
            type: "POST",
            url: '../api/lesson_types',
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
        .fail(function(jqXHR, textStatus ) {
            console.log(jqXHR);
            console.log(textStatus);
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
