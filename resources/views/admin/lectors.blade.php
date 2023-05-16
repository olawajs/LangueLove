@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center classicDIV" id="topper">
       <a class="btn btn-secondary mb-3" href="{{ route('newLector') }}"> DODAJ NOWEGO LEKTORA </a>
        <h2 style="text-align: center;">Nasi Lektorzy</h2>
       <div class="row row-cols-1 row-cols-md-3 g-4" style="justify-content: space-evenly;">
        @foreach($lectors as $lector)
            <div class="col" style="display: flex; justify-content: center;">
                <a href="{{ route('getLector',$lector->id) }}">
                    <div class="card h-100 lectorCard">
                        <img src="<?php echo asset("images/lectors/$lector->photo")?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center;">{{$lector->name}} {{$lector->surname}}</h5>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
       
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
   
</script>
