<!DOCTYPE HTML> 
@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
.nav-tabs{
    margin-top: 30px;
}
</style>
@section('content')
<div class="container" style="width: 100%">

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Płatności</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="calendar-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Newsletter</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="codes-tab" data-bs-toggle="tab" data-bs-target="#codes-tab-pane" type="button" role="tab" aria-controls="codes-tab-pane" aria-selected="false">Kody promocyjne</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-tab-pane" type="button" role="tab" aria-controls="users-tab-pane" aria-selected="false">Użytkownicy</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
        <div class="justify-content-center" id="topper">
            <h2 class="text-center">Płatności</h2>
            <table id="payments">
                <thead>
                    <th>Ponów</th>
                    <th>Opis</th>
                    <th>Język</th>
                    <th>Użytkownik</th>
                    <th>Faktura</th>
                    <th>Data</th>
                    <th>Dane do faktury</th>
                    <th>Adres</th>
                    <th>NIP</th>
                </thead>
                <tbody>
                    @foreach($payments as $p)
                    <tr>
                        <td>@if($p->status==1)<a href="{{ route('fixPayment', ['id' => $p->id]) }}">Zaksięguj</a> @endif</td>
                        <td>{{$p->description}}</td>
                        <td>{{$p->id_language}}</td>
                        <td>{{ App\Models\User::find($p->id_user)->name}}</td>
                        <td>{{$p->invoice}}</td>
                        <td>{{$p->created_at}}</td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->street}}, {{$p->postcode}} {{$p->city}}</td>
                        <td>{{$p->nip}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
  </div>
  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
    <div class="CalDiv">
        <h2 class="text-center">Newsletter</h2>
            <table id="newsletter">
                <thead>
                    <th>Email</th>
                    <th>Data Dodania</th>
                </thead>
                <tbody>
                    @foreach($newsletters as $n)
                    <tr>
                        <td>{{$n->email}}</td>
                        <td>{{$n->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
  </div>
  <div class="tab-pane fade" id="codes-tab-pane" role="tabpanel" aria-labelledby="codes-tab" tabindex="0">
    <div class="CalDiv">
        <h2 class="text-center">Kody promocyjne</h2>
            <table id="codes">
                <thead>
                    <th>Kod</th>
                    <th>Email</th>
                    <th>Wartość</th>
                    <th>Data Dodania</th>
                    <th>Data Użycia</th>
                </thead>
                <tbody>
                    @foreach($codes as $c)
                    <tr>
                        <td>{{$c->code}}</td>
                        <td>{{$c->email}}</td>
                        <td>{{$c->amount}} {{$c->type}}</td>
                        <td>{{$c->created_at}}</td>
                        <td>{{$c->use_date}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
  </div>
  <div class="tab-pane fade" id="users-tab-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
    <div class="CalDiv">
        <h2 class="text-center">Użytkownicy</h2>
            <table id="users">
                <thead>
                    <th>Imie i nazwisko</th>
                    <th>Email</th>
                    <th>Aktywny</th>
                    <th>Typ</th>
                    <th>Data Dodania</th>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr>
                        <td>{{$u->name}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{$u->active}}</td>
                        <td>{{ App\Models\UserType::where('id',$u->user_type)->distinct('level')->pluck('name')->first()   }}</td>
                        <td>{{$u->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
  </div>
</div>

</div>
@endsection
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> 
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.tiny.cloud/1/r7yvsqva0lmrh081yjb12u1yyn51cak9j4frujmxqj8ihg31/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


<script>
    $(document).ready(function () {
        let table = $('#payments').DataTable({
            order: [[4, 'desc']]
        });
        let table2 = $('#newsletter').DataTable({
            order: [[1, 'desc']]
        });
        let table3 = $('#codes').DataTable({
            order: [[1, 'desc']]
        });
        let table4 = $('#users').DataTable({
            order: [[1, 'desc']]
        });
    });

</script>
