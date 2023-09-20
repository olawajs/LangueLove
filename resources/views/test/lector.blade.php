@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.css">
<style>
    .content{
        margin-top: 15px;
    }
    input[type='checkbox'] {
        accent-color:var(--bs-secondary);
    }
    .checkRow{
        padding: 5px;
        margin: auto;
    }
    .cena1{
        text-align: center;
        font-size: x-large;
    }
    .box{
        margin: 5px 0;
    }
    .px-a{
        padding-right: 100px;
        padding-left: 100px;
        padding-bottom: 50px;
    }
    .fotoContainer{
        border-radius: 10px !important;
        border: 2px solid #EBEBEB;
        min-height: 200px;
        margin: 10px;
        padding: 10px;
    }
    p{
        text-align: justify;
    }
</style>
<div class="container px-a" id="container">
    @if(session()->has('success'))
        <div class="Info" style="background-color: var(--bs-primary);">
        <span class="text-white">
            {{session()->get('success')}}
        </span>
        </div>
    @endif
    <div class="content" id="content">    
        <div class="d-flex LectorDiv" style="gap:48px;">
            <div class="d-flex flex-column" style="flex-grow: 3; gap:20px; width: 100%;">
                <div class="d-flex flex-row LectorHeader">
                    <div style="margin-right: 32px">
                        <img src="/images/lectors/{{$lector->photo}}" style='width:174px; height: 174px; object-fit: cover;'>
                    </div>
                    <div class="LectorInfo">
                        <div>
                            <h2>{{$lector->name}}</h2>
                        </div>
                        <div class="bubbleInfo"> <b>Uczy:</b>
                            @foreach ($levels as $d)
                                <span class=""><img src="{{asset('images/flags/'.App\Models\Language::find($d->language_id)->short.'.svg')}}"> język {{App\Models\Language::find($d->language_id)->name}} <span style="color: #969696; font-weight: bold;">{{ $d->level}}</span></span>
                            @endforeach
                        </div>
                        <div class="bubbleInfo"> <b>Tematyka zajęć:</b>
                            @foreach ($topics as $d)
                                    <span class="TopicBubble">{{$d->level}}</span>
                            @endforeach
                        </div>
                        <buton class="LL-button LL-button-primary w-100 MobileLectorButtons"  onclick="przejdzDo()">Zobacz kalendarz</buton>
                        <buton class="LL-button LL-button-secondary MobileLectorButtons" onclick="OpenPriceTable()">Zobacz cennik</buton>
                    </div>
                </div>
              
                @if($lector->description != '')
                <div>
                    <h2 class="LectroH2">O lektorze</h2>
                    <div class="LectorText">{!! $lector->description !!}</div>
                </div>
                @endif
                <!-- @if($lector->levele != '')
                <div>
                    <h2 class="LectroH2">Styl nauczania</h2>
                    <div>{!! $lector->levele !!}</div>
                </div>
                @endif -->
                @if($lector->style != '')
                <div>
                    <h2 class="LectroH2">Styl nauczania</h2>
                    <div class="LectorText">{!! $lector->style !!}</div>
                </div>
                @endif
                
                <div>
                    <h2 class="LectroH2">Kalendarz</h2>
                    <div class="calendarInfo" id="calendarInfo">
                        <img src="{{asset('images/svg/warning.svg')}}">
                        <div>Zajęcia trwają 55 lub 85 minut. Wybierz godzinę rozpoczęcia zajęć, a w następnym kroku czas trwania.</div>
                    </div>
                        <div class="Desktop">
                            @foreach($calendar as $q => $c)
                            <div id="Week{{$loop->index}}" @if($loop->index > 0)style="display: none" @endif>
                                <div class="calendarButtons" >
                                    <div class="weekButtons">
                                        <div class="d-flex" style="gap: 6px;">
                                            <button class="btn activeButton @if($loop->index == 0)LLdisabled @endif  HBorder"  onClick="goTo('{{$loop->index -1}}','{{$loop->index}}')">@if($loop->index == 0)<img src="{{asset('images/svg/DArrowL.svg')}}"> @else <img src="{{asset('images/svg/AArrowL.svg')}}"> @endif </button>
                                        <button class="btn activeButton @if(($loop->index+1)==count($calendar) )LLdisabled @endif HBorder" onClick="goTo('{{$loop->index +1}}','{{$loop->index}}')">@if(($loop->index+1)==count($calendar))<img src="{{asset('images/svg/DArrowR.svg')}}"> @else <img src="{{asset('images/svg/AArrowR.svg')}}"> @endif</button>
                                        </div>
                                        <div>
                                            {{$q}}
                                        </div>
                                    </div>
                                    <button class="btn TodayButton @if($loop->index == 0)LLdisabled @endif  HBorder" onClick="goTo('0','{{$loop->index}}')">dzisiaj</button>
                                </div>
                                <div class="weekContainer" >
                                    @foreach($c as $k => $d)
                                    <div class="dayContainer">
                                        <div class="headContainer">
                                            <span>{{$d['name']}}</span>
                                            <span>{{$d['shortDate']}}</span>
                                        </div>
                                        <div class="hoursContainer">
                                            @foreach($d as $k2 => $d2)
                                                @if($k2 != 'name' && $k2 != 'shortDate')
                                                    @if(isset($d2['free']) && $d2['free']==1)
                                                        <div class="freeHour HBorder">{{$k2}}</div>
                                                    @endif
                                                    @if(isset($d2['free']) && $d2['free']==0)
                                                        <div class="takenHour">{{$k2}}</div>
                                                    @endif
                                                    @if(!isset($d2['free']))
                                                        <div class="emptyHour"></div>
                                                    @endif
                                                    
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                </div> 
                            </div> 
                            @endforeach
                        </div>
                        <div class="mobile">
                            @foreach($calendarMobile as $q => $c)
                            <div id="Week{{$loop->index}}M" @if($loop->index > 0)style="display: none" @endif>
                                <div class="calendarButtons" >
                                    <div class="weekButtons">
                                        <div class="d-flex" style="gap: 6px;">
                                            <button class="btn activeButton @if($loop->index == 0)LLdisabled @endif  HBorder"  onClick="goToM('{{$loop->index -1}}','{{$loop->index}}')">@if($loop->index == 0)<img src="{{asset('images/svg/DArrowL.svg')}}"> @else <img src="{{asset('images/svg/AArrowL.svg')}}"> @endif </button>
                                        <button class="btn activeButton @if(($loop->index+1)==count($calendar) )LLdisabled @endif HBorder" onClick="goToM('{{$loop->index +1}}','{{$loop->index}}')">@if(($loop->index+1)==count($calendar))<img src="{{asset('images/svg/DArrowR.svg')}}"> @else <img src="{{asset('images/svg/AArrowR.svg')}}"> @endif</button>
                                        </div>
                                        <div>
                                            {{$q}}
                                        </div>
                                    </div>
                                    <button class="btn TodayButton @if($loop->index == 0)LLdisabled @endif  HBorder" onClick="goToM('0','{{$loop->index}}')">dzisiaj</button>
                                </div>
                                <div class="weekContainer" >
                                    @foreach($c as $k => $d)
                                    <div class="dayContainer">
                                        <div class="headContainer">
                                            <span>{{$d['name']}}</span>
                                            <span>{{$d['shortDate']}}</span>
                                        </div>
                                        <div class="hoursContainer">
                                            @foreach($d as $k2 => $d2)
                                                @if($k2 != 'name' && $k2 != 'shortDate')
                                                    @if(isset($d2['free']) && $d2['free']==1)
                                                        <div class="freeHour HBorder">{{$k2}}</div>
                                                    @endif
                                                    @if(isset($d2['free']) && $d2['free']==0)
                                                        <div class="takenHour">{{$k2}}</div>
                                                    @endif
                                                    @if(!isset($d2['free']))
                                                        <div class="emptyHour"></div>
                                                    @endif
                                                    
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                </div> 
                            </div> 
                            @endforeach
                        </div>
                    </div>
                </div>
            <div class="VidInfoContainer">
                <iframe class="YTVideo" src="https://www.youtube.com/embed/C0DPdy98e4c?si=Nz6Etje8GK2mJO4p" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                <buton class="LL-button LL-button-primary w-100"  onclick="przejdzDo()">Zobacz kalendarz</buton>
                <buton class="LL-button LL-button-secondary" onclick="OpenPriceTable()">Zobacz cennik</buton>
                <!-- <buton class="LL-button LL-button-secondary">Wiadomość</buton> -->
            </div>
        </div>
      
    </div>
    
</div>
<!-- Cennik -->
<div class="PriceTable" id="PriceTable">
    <div class='desktop'>
        <div class="DivHead">
            <span class="HeadText">Cennik</span>
            <button class="btn XButton" onClick="closePriceTable()">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.362686 11.4335L4.68772 7L0.362686 2.56647C0.108271 2.30567 0.108271 1.87892 0.362686 1.61812L1.7504 0.195597C2.00481 -0.065199 2.42113 -0.065199 2.67554 0.195597L7.00058 4.62913L11.3256 0.195597C11.58 -0.065199 12.0195 -0.065199 12.2739 0.195597L13.6385 1.61812C13.8929 1.87892 13.8929 2.30567 13.6385 2.56647L9.31343 7L13.6385 11.4335C13.8929 11.6943 13.8929 12.1448 13.6385 12.4056L12.2739 13.8044C12.0195 14.0652 11.58 14.0652 11.3256 13.8044L7.00058 9.37087L2.67554 13.8044C2.42113 14.0652 2.00481 14.0652 1.7504 13.8044L0.362686 12.4056C0.108271 12.1448 0.108271 11.6943 0.362686 11.4335Z" fill="#2B2B33"/>
                </svg>
            </button>
        </div>
        <div class="DivButtons">
            <div class="PriceTab PriceTabActive">Indywidualne</div>
            <div class="PriceTab">W parze</div>
        </div>
        <div class="DivButtons">
            <div class="PriceColumn">
                <div class="PriceBubble"></div>
                <div class="priceText" style="height: 44px;">pojedyncza lekcja</div>
                <div class="priceText" style="height: 44px;">pakiet 5 lekcji</div>
                <div class="priceText" style="height: 44px;">pakiet 10 lekcji</div>
                <div class="priceText" style="height: 44px;">pakiet 30 lekcji</div>
            </div>
            
            @foreach($durations as $d)
                <div class="PriceColumn">
                    <div class="priceText">{{($d->duration)-5}} min</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\LectorPrices::where('type_id',1)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certification',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                </div>  
            @endforeach
            @foreach($durations as $d)
                <div class="PriceColumn" style="display: none">
                    <div class="priceText">{{($d->duration)-5}} min</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\LectorPrices::where('type_id',4)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certification',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                </div>  
            @endforeach
            
            
            @foreach($durations as $d)
                <div class="PriceColumn">
                    <div class="priceText"><img src="{{asset('images/svg/badge 1.svg')}}">{{($d->duration)-5}} min</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\LectorPrices::where('type_id',1)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certification',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                </div>
            @endforeach
        </div>
    </div>
    <div class='mobile mobileFlex' style="width: 100%;">
        <div class="DivHead">
            <span class="HeadText">Cennik</span>
            <button class="btn XButton" onClick="closePriceTable()">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.362686 11.4335L4.68772 7L0.362686 2.56647C0.108271 2.30567 0.108271 1.87892 0.362686 1.61812L1.7504 0.195597C2.00481 -0.065199 2.42113 -0.065199 2.67554 0.195597L7.00058 4.62913L11.3256 0.195597C11.58 -0.065199 12.0195 -0.065199 12.2739 0.195597L13.6385 1.61812C13.8929 1.87892 13.8929 2.30567 13.6385 2.56647L9.31343 7L13.6385 11.4335C13.8929 11.6943 13.8929 12.1448 13.6385 12.4056L12.2739 13.8044C12.0195 14.0652 11.58 14.0652 11.3256 13.8044L7.00058 9.37087L2.67554 13.8044C2.42113 14.0652 2.00481 14.0652 1.7504 13.8044L0.362686 12.4056C0.108271 12.1448 0.108271 11.6943 0.362686 11.4335Z" fill="#2B2B33"/>
                </svg>
            </button>
        </div>
        <div class="DivButtons">
            <div class="PriceTab PriceTabActive">Indywidualne</div>
            <div class="PriceTab">W parze</div>
        </div>
        <div class="DivButtons">
            <b>Standardowe zajęcia:</b>
        </div>
        <div class="DivButtons" style="justify-content: space-evenly;">
            <div class="PriceColumn">
                <div class="PriceBubble"></div>
                <div class="priceText" style="height: 44px;">pojedyncza</div>
                <div class="priceText" style="height: 44px;">5 lekcji</div>
                <div class="priceText" style="height: 44px;">10 lekcji</div>
                <div class="priceText" style="height: 44px;">30 lekcji</div>
            </div>
            
            @foreach($durations as $d)
                <div class="PriceColumn">
                    <div class="priceText">{{($d->duration)-5}} min</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\LectorPrices::where('type_id',1)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certification',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                </div>  
            @endforeach
        </div>
        <div class="DivButtons">
            <b><img src="{{asset('images/svg/badge 1.svg')}}">Zajęcia przygotowujące do egzaminu:</b>
        </div>
        <div class="DivButtons" style="justify-content: space-evenly;">    
            <div class="PriceColumn">
                <div class="PriceBubble"></div>
                <div class="priceText" style="height: 44px;">pojedyncza</div>
                <div class="priceText" style="height: 44px;">5 lekcji</div>
                <div class="priceText" style="height: 44px;">10 lekcji</div>
                <div class="priceText" style="height: 44px;">30 lekcji</div>
            </div>
            @foreach($durations as $d)
                <div class="PriceColumn">
                    <div class="priceText"><img src="{{asset('images/svg/badge 1.svg')}}">{{($d->duration)-5}} min</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\LectorPrices::where('type_id',1)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certification',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                </div>
            @endforeach
        </div>
        </div>
    </div>
    
</div>
<!-- Language modal -->
<form class="Custom_modal" style="display: none; z-index: 3;" id="BuyModal" method='POST' action="{{ route('buyLesson') }}">
    @csrf
      <h2 class="Tcenter">SZCZEGÓŁY ZAKUPU: </h2>
      <hr>
       <div id="addNewLanguage" class="ModalFlex">
        <input type="hidden" value="{{$lector->id}}" name="lectorId"> 
            <div class="box">
                <span class="napis">Data: </span>
                <input type="date" class="form-control" name="data" id="data"  readonly>
            </div>
            <div class="box">
                <span class="napis" for="godzina">Godzina rozpoczęcia: </span>
                <input type="time" class="form-control timepicker" name="godzina" id="godzina" readonly>
            </div>
            <div class="box">
                <span class="napis" for="data">Długość zajęć: </span>
                <select class="form-control CountCost" name="duration_id" id="duration_id">
                    @foreach($durations as $d)
                        <option value="{{$d->id}}">{{$d->duration}} min</option>
                    @endforeach
                </select>
            </div>
            <div class="box">
                <span class="napis" for="jezyk">Język: </span>
                <select class="form-control CountCost" name="jezyk" id="jezyk" autocomplete="off">
                    @foreach($languages as $l)
                        <option value="{{$l->id}}">{{$l->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="box">
                <span class="napis" for="rodzaj">Rodzaj zajęć: </span>
                <select class="form-control CountCost" name="rodzaj" id="rodzaj">
                        <option value="1">Indywidualne</option>
                        <option value="4">W parach</option>
                </select>
            </div>
            <div class="form-check form-switch box">
                <input class="form-check-input" type="checkbox" role="switch" id="cykliczne" name="cykliczne" onchange="cykl(event)">
                <label class="form-check-label" for="cykliczne">Zajęcia cykliczne</label>
            </div>
            <div class="form-check form-switch box">
                <input class="form-check-input  CountCost" type="checkbox" role="switch" id="cert" name="cert">
                <label class="form-check-label" for="cert">Przygotowanie do certyfikatu</label>
            </div>
            <div id="ileLekcji" style="display: none" class="box">
                <span class="napis" for="ile">Ilość: </span>
                <input type="number" class="form-control CountCost" name="ile" id="ile" step="1" min="1" placeholder="Ilość lekcji">
            </div>
           <p class="cena1" id="cena1">Do zapłaty: <b id='kwota'></b></p>
           <hr>
           <div id="daneFaktura">
                <h2 class="Tcenter">Dane do faktury: </h2>
                <div class="box">
                    <span class="napis">Imię i nazwisko: </span>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="box">
                    <span class="napis">Ulica i numer domu: </span>
                    <input type="text" class="form-control" name="street" id="street" required>
                </div>
                <div class="box">
                    <span class="postcode">Kod Pocztowy: </span>
                    <input type="text" class="form-control" name="postcode" id="postcode" required>
                </div>
                <div class="box">
                    <span class="napis">Miasto: </span>
                    <input type="text" class="form-control" name="city" id="city" required>
                </div>
                <div class="box">
                    <span class="napis">NIP: </span>
                    <input type="text" class="form-control" name="nip" id="nip">
                </div>
           </div>
          
          <button class="btn btn-secondary  mb-3" id="buyButton" type="submit">ZAPŁAĆ TERAZ</button>
          <button class="btn btn-secondary  mb-3" id="buyButton2" onclick="UseLessons(event)" >WYKORZYSTAJ ZAKUPIONE LEKCJE</button>
          <input type="button" class="btn btn-primary mb-3" onclick="CloseModal('BuyModal')" value="ANULUJ">
        </div>
    </form>
  <!-- end LM -->

@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 


<script>
    let LessonAmount = {!! json_encode($lessonAmount) !!};
   
    // console.log(Languages);
    let kwota = 0;
    let ok = true;
    $(document).ready(function () {

        $('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            minTime: '7:00am',
            maxTime: '8:30pm',
            defaultTime: '11',
            startTime: '7:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });



        function OpenModal(id){
            document.getElementById(id).style.display = 'block';
            document.getElementById('content').style.pointerEvents = "none";
            document.getElementById('content').style.opacity = "0.2";
           
            Cost();
            var anchors = document.getElementsByClassName('CountCost');
            for(var i = 0; i < anchors.length; i++) {
                var anchor = anchors[i];
                anchor.onchange = function(){Cost();  validTermins();};
            }
            validTermins(); checkAmount();
        }
    })
    function goTo(week,active){
        document.getElementById('Week'+active).style.display = 'none';
        document.getElementById('Week'+week).style.display = 'block';
    }
    function goToM(week,active){
        document.getElementById('Week'+active+'M').style.display = 'none';
        document.getElementById('Week'+week+'M').style.display = 'block';
    }
    function Cost(){
        if(document.getElementById('ile').value >=5){
            alert('Dziękujemy za wybranie tak dużej ilości zajęć! Zajrzyj do naszego cennika, aby kupić pakiet zajęć w okazyjnej cenie!!!');
        }
        let cert = 0;
        if(document.getElementById('cert').checked){
            cert = 1;
        }
        $.ajax({
            type: "POST",
            url: '../api/count',
            data: {
                language: document.getElementById('jezyk').value, 
                duration: document.getElementById('duration_id').value, 
                ile: document.getElementById('ile').value,
                rodzaj: document.getElementById('rodzaj').value,
                cert: cert
            },
        })
        .done(function( data) {
           kwota = data;
           document.getElementById('kwota').innerText = kwota + 'zł';
        })
        .fail(function() {
            alert( "error" );
        });
        checkAmount();
    }
    function checkAmount(){
        let typ = document.getElementById('rodzaj').value; //ind i par
        let typJ = document.getElementById('jezyk').value;  //trzeba poszukać jaki typ platnosci
        let ile = document.getElementById('ile').value;  
        let Languages = {!! json_encode($languages) !!};
        let priceT = -1;
            for (const [key, value] of Object.entries(Languages)) {
                if(value.id==typJ){
                    priceT = value.price_type;
                }
            }

        if(document.getElementById('cert').checked){
            cert = 1;
        }else{
            cert=0;
        }
        if(LessonAmount[typ][priceT][cert] >0 && LessonAmount[typ][priceT][cert]>=ile){
            document.getElementById('daneFaktura').style.display = 'none'; 
            document.getElementById('cena1').style.display = 'none'; 
            document.getElementById('buyButton2').style.display = 'block'; 
            document.getElementById('buyButton').style.display = 'none'; 
        } else{
            document.getElementById('daneFaktura').style.display = 'block'; 
            document.getElementById('cena1').style.display = 'block'; 
            document.getElementById('buyButton2').style.display = 'none'; 
            document.getElementById('buyButton').style.display = 'block'; 
        }
    }
    function validTermins(){
        $.ajax({
            type: "POST",
            url: '../api/validTermins',
            data: {
                lector: '{{$lector->id}}', 
                date: document.getElementById('data').value, 
                hour: document.getElementById('godzina').value,
                dlugosc: document.getElementById('duration_id').value,
                ile: document.getElementById('ile').value
            },
        })
        .done(function( data) {
            let button  = document.getElementById('buyButton');
            if(data == 0){
                alert('Przepraszamy, ale wybrana data jest niedostępna bądź koliduje z innymi zajęciami. Prosimy o wybranie innej godziny bądź długości zajęć, dziękujemy!');
                ok = false;
                button.disabled = true;
            }
            else{
                ok = true;
                button.disabled = false;
            }
        })
        .fail(function() {
            alert( "error" );
        });
    }
       
        function cykl(e){
            if(e.target.checked){
                document.getElementById('ileLekcji').style.display = 'block';
            }else{
                document.getElementById('ileLekcji').style.display = 'none';
                document.getElementById('ile').value = 1;
                Cost();
            }

        }
        function CloseModal(id){
            document.getElementById(id).style.display = 'none';
            document.getElementById('content').style.pointerEvents = "";
            document.getElementById('content').style.opacity = "1";
        }
        function UseLessons(e){
            e.preventDefault();
            document.getElementById('BuyModal').action ="{{ route('useLessons') }}";
            document.getElementById('BuyModal').submit();
        }
        function przejdzDo(){
            const element = document.getElementById("calendarInfo");
            element.scrollIntoView();
        }
</script>