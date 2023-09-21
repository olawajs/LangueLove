<!DOCTYPE HTML> 
@extends('layouts.app')
<style>
    /* .form-group{
        display: flex;
    }
    .form-control{
        width: 300px !impotant;
    }
    label{
        width: 400px;
    } */
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center classicDIV" id="topper">
        <div class="col-md-11" >
            <div style="width: 100%">
                <h2>Dodaj nową lekcję</h2>
            </div>
            <form class="row g-3" method="POST" action="{{ route('addLessonDB') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <label for="title" class="form-label">Tytuł zajęć</label>
                    <input class="form-control" placeholder="Tytuł zajęć" name="title" id="amount_oftitle_lessons" required>
                </div>
                <div class="col-md-3">
                    <label for="type_id" class="form-label">Typ lekcji: </label>
                    <select class="form-control" name="type_id" id="type_id">
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
                </div>
                <div class="col-md-3">
                    <label for="duration_id" class="form-label">Długość zajęć:</label>
                    <select class="form-control" name="duration_id" id="duration_id">
                        @foreach($duration as $d)
                            <option value="{{$d->id}}">{{$d->duration}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="amount_of_lessons" class="form-label">Liczba lekcji</label>
                    <input class="form-control" type="number" value="1" name="amount_of_lessons" id="amount_of_lessons" required>
                </div>
                <div class="col-md-3">
                    <label for="amount_of_students" class="form-label">Maksymalna ilość uczestników: </label>
                    <input class="form-control" type="number" name="amount_of_students" id="amount_of_students" required>
                </div>

                <div class="col-md-3">
                    <label for="price" class="form-label">Cena za pojedyńcze zajęcia</label>
                    <input class="form-control" type="number" name="price" id="price" required>
                </div>
                <div class="col-md-3">
                    <label for="photo" class="form-label">Zdjęcie (Opcjonalnie)</label>
                    <input class="form-control" type="file" name="photo" id="photo">
                </div>
                <div class="col-md-3">
                    <label for="start" class="form-label">Data pierwszej lekcji: </label>
                    <input class="form-control" type="date" name="start" id="start" required>
                </div>
                <div class="col-md-3">
                    <label for="time" class="form-label">Początek zajęć: </label>
                    <input class="form-control" type="time" name="time" id="time" required>
                </div>

                <div class="col-md-6">
                    <label for="lector_id" class="form-label">Lektor:</label>
                    <select class="form-control" name="lector_id" id="lector_id">
                        @foreach($lectors as $lector)
                            <option value="{{$lector->id}}">{{$lector->name}} {{$lector->surname}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="language_id" class="form-label">Język: </label>
                    <select class="form-control" name="language_id" id="language_id">
                        @foreach($language as $lang)
                            <option value="{{$lang->id}}">{{$lang->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="skype" class="form-label">Skype</label>
                    <input class="form-control" placeholder="Skype" name="skype" id="skype">
                </div>
                
                <div class="col-md-6">
                    <label for="description" class="form-label">Opis:</label>
                    <textarea class="form-control" name="description" id="description"></textarea>
                </div>
                <div class="col-md-6">
                    <label for="draft" class="form-label">Plan zajęć</label>
                    <textarea class="form-control" name="draft" id="draft"></textarea>
                </div>

                    <button type="submit" class="btn btn-primary col-md-12 mb-3">Zapisz</button>
                       
                </form>
        </div> 
    </div>

<!-- Modals -->


<!-- end modals -->

</div>
@endsection
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> 
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/r7yvsqva0lmrh081yjb12u1yyn51cak9j4frujmxqj8ihg31/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
   tinymce.init({
    selector: 'textarea#draft', 
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: true,
    setup: function(ed) {
        ed.on('submit', function(e) { ed.save(); });
    }
  });
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
