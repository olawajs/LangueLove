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
                                                        <div class="freeHour HBorder" onclick="OpenHour(`{{$k2}}`,`{{$k}}`,`{{$d['name']}}`,`{{$d2['60']}}`,`{{$d2['90']}}`)">{{$k2}}</div>
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
                                        <button class="btn activeButton @if(($loop->index+1)==count($calendarMobile) )LLdisabled @endif HBorder" onClick="goToM('{{$loop->index +1}}','{{$loop->index}}')">@if(($loop->index+1)==count($calendarMobile))<img src="{{asset('images/svg/DArrowR.svg')}}"> @else <img src="{{asset('images/svg/AArrowR.svg')}}"> @endif</button>
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
                                                        <div class="freeHour HBorder" onclick="OpenHour(`{{$k2}}`,`{{$k}}`,`{{$d['name']}}`,`{{$d2['60']}}`,`{{$d2['90']}}`)">{{$k2}}</div>
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
                <iframe class="YTVideo width="560" height="315" src="https://www.youtube.com/embed/jFLFeucqPh0?si=EuO7aroigvszu_c_" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
            <div class="PriceTab PriceTabActive" id="BInd" data="Ind" onClick="changeType(event,'Par')">Indywidualne</div>
            <div class="PriceTab" data="Par" id="BPar" onClick="changeType(event,'Ind')">W parze</div>
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
                <div class="PriceColumn" id="Ind1">
                    <div class="priceText">{{($d->duration)-5}} min</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\LectorPrices::where('type_id',1)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certification',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                </div>  
            @endforeach
            @foreach($durations as $d)
                <div class="PriceColumn" style="display: none" id="Par1">
                    <div class="priceText">{{($d->duration)-5}} min</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\LectorPrices::where('type_id',4)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certification',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                </div>  
            @endforeach
            
            
            @foreach($durations as $d)
                <div class="PriceColumn" id="Ind2">
                    <div class="priceText"><img src="{{asset('images/svg/badge 1.svg')}}">{{($d->duration)-5}} min</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\LectorPrices::where('type_id',1)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certification',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                </div>
            @endforeach
            @foreach($durations as $d)
                <div class="PriceColumn" style="display: none"  id="Par2">
                    <div class="priceText"><img src="{{asset('images/svg/badge 1.svg')}}">{{($d->duration)-5}} min</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\LectorPrices::where('type_id',4)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certification',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',4)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',4)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',4)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
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
            <div class="PriceTab PriceTabActive"  id="MIndM" data="IndM" onClick="changeTypeM(event,'ParM')">Indywidualne</div>
            <div class="PriceTab" id="MParM" data="ParM" onClick="changeTypeM(event,'IndM')">W parze</div>
        </div>
        <div class="DivButtons">
            <b>Standardowe zajęcia:</b>
        </div>
        <div class="DivButtons" style="justify-content: space-evenly;" id="IndM1">
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
        <div class="DivButtons" style="justify-content: space-evenly; display: none" id="ParM1">
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
                    <div class="PriceBubble purpleBubble">{{App\Models\LectorPrices::where('type_id',4)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certification',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                </div>  
            @endforeach
        </div>
        <div class="DivButtons">
            <b><img src="{{asset('images/svg/badge 1.svg')}}">Zajęcia przygotowujące do egzaminu:</b>
        </div>
        <div class="DivButtons" style="justify-content: space-evenly;"  id="IndM2">    
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
        <div class="DivButtons" style="justify-content: space-evenly; display:none"  id="ParM2">    
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
                    <div class="PriceBubble pinkBubble">{{App\Models\LectorPrices::where('type_id',4)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certification',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',4)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',4)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',4)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$lector->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                </div>
            @endforeach
        </div>
        </div>
    </div>
    
</div>

<!-- Modal płatności -->
<div class="PaymentTable" id="PaymentTable">
    <div class='desktop'>
        <div class='d-flex' style="flex-flow: column; gap:60px;">
            <div class="DivHead">
                <span class="HeadText">Szczegóły rezerwacji</span>
                <button class="btn XButton" onClick="closePaymentTable()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.362686 11.4335L4.68772 7L0.362686 2.56647C0.108271 2.30567 0.108271 1.87892 0.362686 1.61812L1.7504 0.195597C2.00481 -0.065199 2.42113 -0.065199 2.67554 0.195597L7.00058 4.62913L11.3256 0.195597C11.58 -0.065199 12.0195 -0.065199 12.2739 0.195597L13.6385 1.61812C13.8929 1.87892 13.8929 2.30567 13.6385 2.56647L9.31343 7L13.6385 11.4335C13.8929 11.6943 13.8929 12.1448 13.6385 12.4056L12.2739 13.8044C12.0195 14.0652 11.58 14.0652 11.3256 13.8044L7.00058 9.37087L2.67554 13.8044C2.42113 14.0652 2.00481 14.0652 1.7504 13.8044L0.362686 12.4056C0.108271 12.1448 0.108271 11.6943 0.362686 11.4335Z" fill="#2B2B33"/>
                    </svg>
                </button>
            </div>
            <div>
                <span class="HeadText2">Wybierz odpowiedni pakiet dla Ciebie:</span>
            </div>
            <div class="d-flex">
                <div class="PaymentColumn rightLine" style="padding-right: 32px;">
                    <div>
                        <div>
                            <span class="HeadText2">Pakiet</span>
                        </div>
                        <div style="min-height: 40px">
                            <span class="UnderText">5, 10 lub 30 zajęć do wykorzystania odpowiednio w ciągu 5, 10 lub 30 tygodni</span> 
                        </div>
                    </div>
                    <div class="PaymentList">
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                            <span>promocyjna cena</span>
                        </div>
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                            <span>rezerwacja najlepszego dla Ciebie terminu</span>
                        </div>
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                            <span>elastyczne terminy</span>
                        </div>
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                            <span>możliwość przełożenia i odwołania zajęć</span>
                        </div>
                    </div>
                    <div>
                        <buton class="LL-button LL-button-primary w-100" onclick="MPacketLessons()">Rezerwuj</buton>
                    </div>
                </div>
                <div class="PaymentColumn rightLine" style="padding: 0px 24px 0px 32px;">
                    <div>
                        <div>
                            <span class="HeadText2">Zajęcia cykliczne</span>
                        </div>
                        <div style="min-height: 40px">
                            <span class="UnderText">dowolna ilość zajęć co tydzień o stałej porze</span>
                        </div>  
                    </div>
                    <div class="PaymentList">
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/cross.svg')}}"></span>
                            <span class="CrossLine">promocyjna cena</span>
                        </div>
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                            <span>rezerwacja najlepszego dla Ciebie terminu</span>
                        </div>
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                            <span>regularne zajęcia</span>
                        </div>
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                            <span>możliwość przełożenia i odwołania zajęć</span>
                        </div>
                    </div>
                    <div>
                        <buton class="LL-button LL-button-primary w-100"  onclick="MCyklLessons()">Rezerwuj</buton>
                    </div>
                </div>
                <div class="PaymentColumn" style="padding-left: 32px;">
                    <div>
                        <div>
                            <span class="HeadText2">Pojedyncze zajęcia</span>
                        </div>
                        <div style="min-height: 40px">
                            <span class="UnderText">pojedyncze zajęcia o wybranej godzinie</span>
                        </div>   
                    </div>
                    <div class="PaymentList">
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/cross.svg')}}"></span>
                            <span class="CrossLine">promocyjna cena</span>
                        </div>
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/cross.svg')}}"></span>
                            <span class="CrossLine">rezerwacja najlepszego dla Ciebie terminu</span>
                        </div>
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/cross.svg')}}"></span>
                            <span class="CrossLine">regularne zajęcia</span>
                        </div>
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                            <span>możliwość przełożenia i odwołania zajęć</span>
                        </div>
                    </div>
                    <div>
                        <buton class="LL-button LL-button-primary w-100"  onclick="openInd()">Rezerwuj</buton>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='mobile mobileFlex' style="width: 100%;">
        <div class="DivHead">
            <span class="HeadText">Szczegóły rezerwacji</span>
            <button class="btn XButton" onClick="closePaymentTable()">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.362686 11.4335L4.68772 7L0.362686 2.56647C0.108271 2.30567 0.108271 1.87892 0.362686 1.61812L1.7504 0.195597C2.00481 -0.065199 2.42113 -0.065199 2.67554 0.195597L7.00058 4.62913L11.3256 0.195597C11.58 -0.065199 12.0195 -0.065199 12.2739 0.195597L13.6385 1.61812C13.8929 1.87892 13.8929 2.30567 13.6385 2.56647L9.31343 7L13.6385 11.4335C13.8929 11.6943 13.8929 12.1448 13.6385 12.4056L12.2739 13.8044C12.0195 14.0652 11.58 14.0652 11.3256 13.8044L7.00058 9.37087L2.67554 13.8044C2.42113 14.0652 2.00481 14.0652 1.7504 13.8044L0.362686 12.4056C0.108271 12.1448 0.108271 11.6943 0.362686 11.4335Z" fill="#2B2B33"/>
                </svg>
            </button>
        </div>
        <div>
            <span class="HeadText2">Wybierz odpowiedni pakiet dla Ciebie:</span>
        </div>
        <div>
            <!-- test -->
	<div class="container">
		<div id="1" class="Paymentcard">
            <div class="PaymentColumn rightLine" style="padding-right: 32px;">
                <div>
                    <div>
                        <span class="HeadText2">Pakiet</span>
                    </div>
                    <div style="min-height: 40px">
                        <span class="UnderText">5, 10 lub 30 zajęć do wykorzystania odpowiednio w ciągu 5, 10 lub 30 tygodni</span> 
                    </div>
                </div>
                <div class="PaymentList">
                    <div class="ListArgument">
                        <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                        <span>promocyjna cena</span>
                    </div>
                    <div class="ListArgument">
                        <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                        <span>rezerwacja najlepszego dla Ciebie terminu</span>
                    </div>
                    <div class="ListArgument">
                        <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                        <span>elastyczne terminy</span>
                    </div>
                    <div class="ListArgument">
                        <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                        <span>możliwość przełożenia i odwołania zajęć</span>
                    </div>
                </div>
                <div>
                    <buton class="LL-button LL-button-primary w-100" onclick="MPacketLessons()">Rezerwuj</buton>
                </div>
            </div>
		</div>
		<div id="2" class="Paymentcard">
            <div class="PaymentColumn">
                <div>
                    <div>
                        <span class="HeadText2">Zajęcia cykliczne</span>
                    </div>
                    <div style="min-height: 40px">
                        <span class="UnderText">dowolna ilość zajęć co tydzień o stałej porze</span>
                    </div>  
                </div>
                <div class="PaymentList">
                    <div class="ListArgument">
                        <span class="ListImage"><img src="{{asset('images/svg/cross.svg')}}"></span>
                        <span class="CrossLine">promocyjna cena</span>
                    </div>
                    <div class="ListArgument">
                        <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                        <span>rezerwacja najlepszego dla Ciebie terminu</span>
                    </div>
                    <div class="ListArgument">
                        <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                        <span>regularne zajęcia</span>
                    </div>
                    <div class="ListArgument">
                        <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                        <span>możliwość przełożenia i odwołania zajęć</span>
                    </div>
                </div>
                <div>
                    <buton class="LL-button LL-button-primary w-100"  onclick="MCyklLessons()">Rezerwuj</buton>
                </div>
            </div>
		</div>
		<div id="3" class="Paymentcard">
            <div class="PaymentColumn">
                <div>
                    <div>
                        <span class="HeadText2">Pojedyncze zajęcia</span>
                    </div>
                    <div style="min-height: 40px">
                        <span class="UnderText">pojedyncze zajęcia o wybranej godzinie</span>
                    </div>   
                </div>
                <div class="PaymentList">
                    <div class="ListArgument">
                        <span class="ListImage"><img src="{{asset('images/svg/cross.svg')}}"></span>
                        <span class="CrossLine">promocyjna cena</span>
                    </div>
                    <div class="ListArgument">
                        <span class="ListImage"><img src="{{asset('images/svg/cross.svg')}}"></span>
                        <span class="CrossLine">rezerwacja najlepszego dla Ciebie terminu</span>
                    </div>
                    <div class="ListArgument">
                        <span class="ListImage"><img src="{{asset('images/svg/cross.svg')}}"></span>
                        <span class="CrossLine">regularne zajęcia</span>
                    </div>
                    <div class="ListArgument">
                        <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                        <span>możliwość przełożenia i odwołania zajęć</span>
                    </div>
                </div>
                <div>
                    <buton class="LL-button LL-button-primary w-100" onclick="openInd()">Rezerwuj</buton>
                </div>
            </div>
        </div>
	</div>
</div>
    <div>  
        <div>
            <div class="pagination pg-red">
                <div class="page-item active"><a class="page-link" data="1" id="1B"></a></div>
                <div class="page-item"><a class="page-link" data="2" id="2B"></a></div>
                <div class="page-item"><a class="page-link" data="3" id="3B"></a></div>
            </div>
        </div>
    </div>
    </div> 
</div>
<!-- Indywidualny -->
<div class="StickDiv" id="MIndLessons" style="display: none">
    <div class='desktop'>
        <div class='d-flex' style="flex-flow: column; gap:60px;">
            <div class="DivHead">
                <span class="HeadText">Szczegóły rezerwacji</span>
                <button class="btn XButton" onClick="closeModal('MIndLessons')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.362686 11.4335L4.68772 7L0.362686 2.56647C0.108271 2.30567 0.108271 1.87892 0.362686 1.61812L1.7504 0.195597C2.00481 -0.065199 2.42113 -0.065199 2.67554 0.195597L7.00058 4.62913L11.3256 0.195597C11.58 -0.065199 12.0195 -0.065199 12.2739 0.195597L13.6385 1.61812C13.8929 1.87892 13.8929 2.30567 13.6385 2.56647L9.31343 7L13.6385 11.4335C13.8929 11.6943 13.8929 12.1448 13.6385 12.4056L12.2739 13.8044C12.0195 14.0652 11.58 14.0652 11.3256 13.8044L7.00058 9.37087L2.67554 13.8044C2.42113 14.0652 2.00481 14.0652 1.7504 13.8044L0.362686 12.4056C0.108271 12.1448 0.108271 11.6943 0.362686 11.4335Z" fill="#2B2B33"/>
                    </svg>
                </button>
            </div>
            <div class="d-flex" style="flex-flow: column">
                <div class="DivButtons">
                    <div class="PayTab IndLink PayTabActive" data="IndS" id="IndS" data="IndM">Szczegóły zajęć</div>
                    <div class="PayTab IndLink" data="IndD" id="IndD">Dane do płatności</div>
                </div>
                <div class="container">
                    <div id="ContainerIndS" class="PayCard">
                        <div class="PayInfo">
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="{{asset('images/svg/cap.svg')}}"></div>
                                <div>Pojedyncze zajęcia</div>
                            </div>    
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="{{asset('images/svg/calendar.svg')}}"></div>
                                <div><span id="IndData">01.09.2023</span> (<span id="IndDzien">piątek</span>), <span id="IndGodz">09:00 - 9:55</span></div>
                            </div>    
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="/images/lectors/{{$lector->photo}}" style='width:48px; height: 48px; object-fit: cover;'></div>
                                <div>{{$lector->name}}</div>
                            </div>     
                        </div>
                       <div>
                            <div class="PayCustom">
                                <div class="PayRow">
                                    <label class="SelectLabel">Rodzaj zajęć</label>
                                    <select class="select" id="LessonTypeD" onChange="PriceCheck()">
                                        <option value="1">Indywidualne</option>
                                        <option value="4">W parach</option>
                                    </select>
                                </div>
                                <div class="PayRow">
                                    <label class="SelectLabel">Długość trwania</label>
                                    <select class="select" id="LessonDurationD" onChange="PriceCheck()">
                                        <option value="2" id="D60">55 minut</option>
                                        <option value="3" id="D90">85 minut</option>
                                    </select>
                                </div>
                            </div>
                            <div class="PayCustom">
                                <div class="PayRow">
                                    <label class="SelectLabel">Język</label>
                                    <select class="select" id="LessonLanguageD" onchange="fixSelects()">
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}">{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="PayRow">
                                    <label class="SelectLabel">Przygotowanie do egzaminu</label>
                                    <select class="select" id="LessonCertyficateD" onChange="PriceCheck()">
                                        <option value="0">Nie</option>
                                        <option value="1">Tak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="AmountDiv">
                            Cena: <span id="cenaD">99</span> zł
                        </div>
                    </div>
                </div>
            </div>
            <div id="ContainerIndD" class="PayCard">
                <div>
                    <label class="SelectLabel">Imię i nazwisko</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="NameIndD" onchange="fixSelects()" required>
                </div>
                <div>
                    <label class="SelectLabel">Ulica i nr domu</label>
                    <input class="input" id="AdressIndD" onchange="fixSelects()">
                </div>
                <div class="PayCustom">
                    <div class="PayRow">
                        <label class="SelectLabel">Kod pocztowy</label>
                        <input class="input" id="PostCodeIndD" onchange="fixSelects()">
                    </div>
                    <div class="PayRow">
                        <label class="SelectLabel">Miasto</label>
                        <input class="input" id="CityIndD" onchange="fixSelects()">
                    </div>
                </div>
                <div>
                    <label class="SelectLabel">NIP (opcjonalnie)</label>
                    <input class="input" id="NIPIndD" onchange="fixSelects()">
                </div>
            </div>
            <div class="PaymentButtons">
                <button id="backButton1" onClick="closeModal('MIndLessons')" class="btn LL-button LL-button-secondary">Wróć</button>
                <button id="backButton2" style="display: none" data="IndS" class="IndLink btn LL-button LL-button-secondary">Wróć</button>
                <button id="nextButton1" data="IndD" class="IndLink btn LL-button LL-button-primary">Dalej</button>
                <button id="nextButton2" style="display: none" class="btn LL-button LL-button-primary">Przejdź do płatności</button>
            </div>
        </div>
    </div>
    <div class='mobile mobileFlex' style="width: 100%;">
        <div class="DivHead">
            <span class="HeadText">Szczegóły rezerwacji</span>
            <button class="btn XButton" onClick="closeModal('MIndLessons')">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.362686 11.4335L4.68772 7L0.362686 2.56647C0.108271 2.30567 0.108271 1.87892 0.362686 1.61812L1.7504 0.195597C2.00481 -0.065199 2.42113 -0.065199 2.67554 0.195597L7.00058 4.62913L11.3256 0.195597C11.58 -0.065199 12.0195 -0.065199 12.2739 0.195597L13.6385 1.61812C13.8929 1.87892 13.8929 2.30567 13.6385 2.56647L9.31343 7L13.6385 11.4335C13.8929 11.6943 13.8929 12.1448 13.6385 12.4056L12.2739 13.8044C12.0195 14.0652 11.58 14.0652 11.3256 13.8044L7.00058 9.37087L2.67554 13.8044C2.42113 14.0652 2.00481 14.0652 1.7504 13.8044L0.362686 12.4056C0.108271 12.1448 0.108271 11.6943 0.362686 11.4335Z" fill="#2B2B33"/>
                </svg>
            </button>
        </div>
        <div class="d-flex" style="flex-flow: column">
                <div class="DivButtons">
                    <div class="PayTab IndLinkM PayTabActive" data="IndMS" id="IndMS">Szczegóły zajęć</div>
                    <div class="PayTab IndLinkM" data="IndMD" id="IndMD">Dane do płatności</div>
                </div>
                <div class="container">
                    <div id="ContainerIndMS" class="PayCardM">
                        <div class="PayInfo">
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="{{asset('images/svg/cap.svg')}}"></div>
                                <div>Pojedyncze zajęcia</div>
                            </div>    
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="{{asset('images/svg/calendar.svg')}}"></div>
                                <div><span id="IndDataM">01.09.2023</span> (<span id="IndDzienM">piątek</span>), <span id="IndGodzM">09:00 - 9:55</span></div>
                            </div>    
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="/images/lectors/{{$lector->photo}}" style='width:48px; height: 48px; object-fit: cover;'></div>
                                <div>{{$lector->name}}</div>
                            </div>     
                        </div>
                       <div>
                            <div>
                                <label class="SelectLabel">Rodzaj zajęć</label>
                                <select class="select" id="LessonTypeM" onChange="PriceCheck()">
                                    <option value="1">Indywidualne</option>
                                    <option value="4">W parach</option>
                                </select>
                            </div>
                            <div>
                                <label class="SelectLabel">Długość trwania</label>
                                <select class="select" id="LessonDurationM" onChange="PriceCheck()">
                                    <option value="2" id="M60">55 minut</option>
                                    <option value="3" id="M90">85 minut</option>
                                </select>
                            </div>
                            <div>
                                <label class="SelectLabel">Język</label>
                                <select class="select" id="LessonLanguageM" onchange="fixSelects()">
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="SelectLabel">Przygotowanie do egzaminu</label>
                                <select class="select" id="LessonCertyficateM" onChange="PriceCheck()">
                                    <option value="0">Nie</option>
                                    <option value="1">Tak</option>
                                </select>
                            </div>
                        </div>
                        <div class="AmountDiv">
                            Cena: <span id="cenaM">99</span> zł
                        </div>
                    </div>
                </div>
            </div>
            <div id="ContainerIndMD" class="PayCardM">
                <div>
                    <label class="SelectLabel">Imię i nazwisko</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="NameIndM" onchange="fixSelects()" required>
                </div>
                <div>
                    <label class="SelectLabel">Ulica i nr domu</label>
                    <input class="input" id="AdressIndM" onchange="fixSelects()">
                </div>
                <div>
                    <label class="SelectLabel">Kod pocztowy</label>
                    <input class="input" id="PostCodeIndM" onchange="fixSelects()">
                </div>
                <div>
                    <label class="SelectLabel">Miasto</label>
                    <input class="input" id="CityIndM" onchange="fixSelects()">
                </div>
                <div>
                    <label class="SelectLabel">NIP (opcjonalnie)</label>
                    <input class="input" id="NIPIndM" onchange="fixSelects()">
                </div>
                
                
            </div>
            <div class="d-flex" style="gap: 12px; flex-flow: column">
                <button id="backButtonM1" onClick="closeModal('MIndLessons')" class="btn LL-button LL-button-secondary W-100">Wróć</button>
                <button id="backButtonM2" style="display: none" data="IndMS" class="IndLinkM btn LL-button LL-button-secondary W-100">Wróć</button>
                <button id="nextButtonM1" data="IndMD" class="IndLinkM btn LL-button LL-button-primary w-100">Dalej</button>
                <button id="nextButtonM2" style="display: none" class="btn LL-button LL-button-primary w-100">Przejdź do płatności</button>
            </div>
    </div> 
</div>
<!-- Cykliczne -->
<div class="StickDiv" id="MCyklLessons" style="display: none">
    <div class='desktop'>
        <div class='d-flex' style="flex-flow: column; gap:60px;">
            <div class="DivHead">
                <span class="HeadText">Szczegóły rezerwacji</span>
                <button class="btn XButton" onClick="closeModal('MCyklLessons')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.362686 11.4335L4.68772 7L0.362686 2.56647C0.108271 2.30567 0.108271 1.87892 0.362686 1.61812L1.7504 0.195597C2.00481 -0.065199 2.42113 -0.065199 2.67554 0.195597L7.00058 4.62913L11.3256 0.195597C11.58 -0.065199 12.0195 -0.065199 12.2739 0.195597L13.6385 1.61812C13.8929 1.87892 13.8929 2.30567 13.6385 2.56647L9.31343 7L13.6385 11.4335C13.8929 11.6943 13.8929 12.1448 13.6385 12.4056L12.2739 13.8044C12.0195 14.0652 11.58 14.0652 11.3256 13.8044L7.00058 9.37087L2.67554 13.8044C2.42113 14.0652 2.00481 14.0652 1.7504 13.8044L0.362686 12.4056C0.108271 12.1448 0.108271 11.6943 0.362686 11.4335Z" fill="#2B2B33"/>
                    </svg>
                </button>
            </div>
            <div class="d-flex" style="flex-flow: column">
                <div class="DivButtons">
                    <div class="PayTab CyklLink PayTabActive" data="CyklS" id="CyklS" data="CyklM">Szczegóły zajęć</div>
                    <div class="PayTab CyklLink" data="CyklD" id="CyklD">Dane do płatności</div>
                </div>
                <div class="container">
                    <div id="ContainerCyklS" class="PayCard">
                        <div class="PayInfo">
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="{{asset('images/svg/cap.svg')}}"></div>
                                <div>Cykliczne zajęcia</div>
                            </div>    
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="{{asset('images/svg/calendar.svg')}}"></div>
                                <div><span id="CyklData">01.09.2023</span> (<span id="CyklDzien">piątek</span>), <span id="CyklGodz">09:00 - 9:55</span></div>
                            </div>    
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="/images/lectors/{{$lector->photo}}" style='width:48px; height: 48px; object-fit: cover;'></div>
                                <div>{{$lector->name}}</div>
                            </div>     
                        </div>
                       <div>
                            <div class="PayCustom">
                                <div class="PayRow">
                                    <label class="SelectLabel">Rodzaj zajęć</label>
                                    <select class="select" id="LessonTypeCyklD" onChange="PriceCheckCykl()">
                                        <option value="1">Indywidualne</option>
                                        <option value="4">W parach</option>
                                    </select>
                                </div>
                                <div class="PayRow">
                                    <label class="SelectLabel">Długość trwania</label>
                                    <select class="select" id="LessonDurationCyklD" onChange="PriceCheckCykl()">
                                        <option value="2" id="DC60">55 minut</option>
                                        <option value="3" id="DC90">85 minut</option>
                                    </select>
                                </div>
                            </div>
                            <div class="PayCustom">
                                <div class="PayRow">
                                    <label class="SelectLabel">Język</label>
                                    <select class="select" id="LessonLanguageCyklD"  onchange="fixSelectsCykl()">
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}">{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="PayRow">
                                    <label class="SelectLabel">Przygotowanie do egzaminu</label>
                                    <select class="select" id="LessonCertyficateCyklD" onChange="PriceCheckCykl()">
                                        <option value="0">Nie</option>
                                        <option value="1">Tak</option>
                                    </select>
                                </div>
                               
                            </div> 
                            <div class="PayCustom" style="margin-top: 32px">
                                <label class="SelectLabel">Ilość zajęć</label>
                                <div class="NumberDiv">
                                    <button class="NumberType" id="minusD" onClick="addLessons('-')" disabled ><img src="{{asset('images/svg/minus.svg')}}"></button>
                                        <input class="number" value="2" id="LessonAmountCyklD" onChange="PriceCheckCykl()" readonly >
                                    <button class="NumberType" onClick="addLessons('+')"><img src="{{asset('images/svg/plus.svg')}}"></button>
                                </div>
                            </div>
                        </div>
                        <div class="AmountDiv">
                            Cena: <span id="cenaCyklD">99</span> zł
                        </div>
                    </div>
                </div>
            </div>
            <div id="ContainerCyklD" class="PayCard">
                <div>
                    <label class="SelectLabel">Imię i nazwisko</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="NameCyklD" onchange="fixSelectsCykl()" required>
                </div>
                <div>
                    <label class="SelectLabel">Ulica i nr domu</label>
                    <input class="input" id="AdressCyklD" onchange="fixSelectsCykl()">
                </div>
                <div class="PayCustom">
                    <div class="PayRow">
                        <label class="SelectLabel">Kod pocztowy</label>
                        <input class="input" id="PostCodeCyklD" onchange="fixSelectsCykl()">
                    </div>
                    <div class="PayRow">
                        <label class="SelectLabel">Miasto</label>
                        <input class="input" id="CityCyklD" onchange="fixSelectsCykl()">
                    </div>
                </div>
                <div class="PayCustom">
                    <label class="SelectLabel">NIP (opcjonalnie)</label>
                    <input class="input" id="NIPCyklD" onchange="fixSelectsCykl()">
                </div>
            </div>
            <div class="PaymentButtons">
                <button id="CyklbackButton1" onClick="closeModal('MCyklLessons')" class="btn LL-button LL-button-secondary">Wróć</button>
                <button id="CyklbackButton2" style="display: none" data="CyklS" class="CyklLink btn LL-button LL-button-secondary">Wróć</button>
                <button id="CyklnextButton1" data="CyklD" class="CyklLink btn LL-button LL-button-primary">Dalej</button>
                <button id="CyklnextButton2" style="display: none" class="btn LL-button LL-button-primary">Przejdź do płatności</button>
            </div>
        </div>
    </div>
    <div class='mobile mobileFlex' style="width: 100%;">
        <div class="DivHead">
            <span class="HeadText">Szczegóły rezerwacji</span>
            <button class="btn XButton" onClick="closeModal('MCyklLessons')">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.362686 11.4335L4.68772 7L0.362686 2.56647C0.108271 2.30567 0.108271 1.87892 0.362686 1.61812L1.7504 0.195597C2.00481 -0.065199 2.42113 -0.065199 2.67554 0.195597L7.00058 4.62913L11.3256 0.195597C11.58 -0.065199 12.0195 -0.065199 12.2739 0.195597L13.6385 1.61812C13.8929 1.87892 13.8929 2.30567 13.6385 2.56647L9.31343 7L13.6385 11.4335C13.8929 11.6943 13.8929 12.1448 13.6385 12.4056L12.2739 13.8044C12.0195 14.0652 11.58 14.0652 11.3256 13.8044L7.00058 9.37087L2.67554 13.8044C2.42113 14.0652 2.00481 14.0652 1.7504 13.8044L0.362686 12.4056C0.108271 12.1448 0.108271 11.6943 0.362686 11.4335Z" fill="#2B2B33"/>
                </svg>
            </button>
        </div>
        <div class="d-flex" style="flex-flow: column">
                <div class="DivButtons">
                    <div class="PayTab CyklLinkM PayTabActive" data="CyklMS" id="CyklMS">Szczegóły zajęć</div>
                    <div class="PayTab CyklLinkM" data="CyklMP" id="CyklMP">Dane do płatności</div>
                </div>
                <div class="container">
                    <div id="ContainerCyklMS" class="PayCardM">
                        <div class="PayInfo">
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="{{asset('images/svg/cap.svg')}}"></div>
                                <div>Cykliczne zajęcia</div>
                            </div>    
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="{{asset('images/svg/calendar.svg')}}"></div>
                                <div><span id="CyklDataM">01.09.2023</span> (<span id="CyklDzienM">piątek</span>), <span id="CyklGodzM">09:00 - 9:55</span></div>
                            </div>    
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="/images/lectors/{{$lector->photo}}" style='width:48px; height: 48px; object-fit: cover;'></div>
                                <div>{{$lector->name}}</div>
                            </div>     
                        </div>
                       <div>
                            <div>
                                <label class="SelectLabel">Rodzaj zajęć</label>
                                <select class="select" id="LessonTypeCyklM" onChange="PriceCheckCykl()">
                                    <option value="1">Indywidualne</option>
                                    <option value="4">W parach</option>
                                </select>
                            </div>
                            <div>
                                <label class="SelectLabel">Długość trwania</label>
                                <select class="select" id="LessonDurationCyklM" onChange="PriceCheckCykl()">
                                    <option value="2" id="MC60">55 minut</option>
                                    <option value="3" id="MC90">85 minut</option>
                                </select>
                            </div>
                            <div>
                                <label class="SelectLabel">Język</label>
                                <select class="select" id="LessonLanguageCyklM" onchange="fixSelectsCykl()" >
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="SelectLabel">Przygotowanie do egzaminu</label>
                                <select class="select" id="LessonCertyficateCyklM" onChange="PriceCheckCykl()">
                                    <option value="0">Nie</option>
                                    <option value="1">Tak</option>
                                </select>
                            </div>
                            <div>
                                <label class="SelectLabel">Ilość zajęć</label>
                                <div class="NumberDiv">
                                    <button class="NumberType" id="minusM" onClick="addLessons('-')" disabled><img src="{{asset('images/svg/minus.svg')}}"></button>
                                        <input class="number" value="2" id="LessonAmountCyklM" onChange="PriceCheckCykl()" readonly >
                                    <button class="NumberType" onClick="addLessons('+')"><img src="{{asset('images/svg/plus.svg')}}"></button>
                                </div>
                            </div>
                        </div>
                        <div class="AmountDiv">
                            Cena: <span id="cenaCyklM">99</span> zł
                        </div>
                    </div>
                </div>
            </div>
            <div id="ContainerCyklMP" class="PayCardM">
                <div>
                    <label class="SelectLabel">Imię i nazwisko</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="NameCyklM" onchange="fixSelectsCykl()" required>
                </div>
                <div>
                    <label class="SelectLabel">Ulica i nr domu</label>
                    <input class="input" id="AdressCyklM" onchange="fixSelectsCykl()">
                </div>
                <div>
                    <label class="SelectLabel">Kod pocztowy</label>
                    <input class="input" id="PostCodeCyklM" onchange="fixSelectsCykl()">
                </div>
                <div>
                    <label class="SelectLabel">Miasto</label>
                    <input class="input" id="CityCyklM" onchange="fixSelectsCykl()">
                </div>
                <div>
                    <label class="SelectLabel">NIP (opcjonalnie)</label>
                    <input class="input" id="NIPCyklM" onchange="fixSelectsCykl()">
                </div>
                
                
            </div>
            <div class="d-flex" style="gap: 12px; flex-flow: column">
                <button id="CyklbackButtonM1" onClick="closeModal('MCyklLessons')" class="btn LL-button LL-button-secondary W-100">Wróć</button>
                <button id="CyklbackButtonM2" style="display: none" data="CyklMS" class="CyklLinkM btn LL-button LL-button-secondary W-100">Wróć</button>
                <button id="CyklnextButtonM1" data="CyklMD" class="CyklLinkM btn LL-button LL-button-primary w-100">Dalej</button>
                <button id="CyklnextButtonM2" style="display: none" class="btn LL-button LL-button-primary w-100">Przejdź do płatności</button>
            </div>
    </div> 
</div>
<!-- Pakiet -->
<!-- Cykliczne -->
<div class="StickDiv" id="MPacketLessons" style="display: none">
    <div class='desktop'>
        <div class='d-flex' style="flex-flow: column; gap:60px;">
            <div class="DivHead">
                <span class="HeadText">Szczegóły rezerwacji</span>
                <button class="btn XButton" onClick="closeModal('MPacketLessons')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.362686 11.4335L4.68772 7L0.362686 2.56647C0.108271 2.30567 0.108271 1.87892 0.362686 1.61812L1.7504 0.195597C2.00481 -0.065199 2.42113 -0.065199 2.67554 0.195597L7.00058 4.62913L11.3256 0.195597C11.58 -0.065199 12.0195 -0.065199 12.2739 0.195597L13.6385 1.61812C13.8929 1.87892 13.8929 2.30567 13.6385 2.56647L9.31343 7L13.6385 11.4335C13.8929 11.6943 13.8929 12.1448 13.6385 12.4056L12.2739 13.8044C12.0195 14.0652 11.58 14.0652 11.3256 13.8044L7.00058 9.37087L2.67554 13.8044C2.42113 14.0652 2.00481 14.0652 1.7504 13.8044L0.362686 12.4056C0.108271 12.1448 0.108271 11.6943 0.362686 11.4335Z" fill="#2B2B33"/>
                    </svg>
                </button>
            </div>
            <div class="d-flex" style="flex-flow: column">
                <div class="DivButtons">
                    <div class="PayTab PacketLink PayTabActive" data="PacketS" id="PacketS" data="PacketM">Szczegóły zajęć</div>
                    <div class="PayTab PacketLink" data="PacketD" id="PacketD">Dane do płatności</div>
                </div>
                <div class="container">
                    <div id="ContainerPacketS" class="PayCard">
                        <div class="PayInfo">
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="{{asset('images/svg/cap.svg')}}"></div>
                                <div>Pakiet</div>
                            </div>    
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="{{asset('images/svg/calendar.svg')}}"></div>
                                <div><span id="PacketData">01.09.2023</span> (<span id="PacketDzien">piątek</span>), <span id="PacketGodz">09:00 - 9:55</span></div>
                            </div>    
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="/images/lectors/{{$lector->photo}}" style='width:48px; height: 48px; object-fit: cover;'></div>
                                <div>{{$lector->name}}</div>
                            </div>     
                        </div>
                       <div>
                            <div class="PayCustom">
                                <div class="PayRow">
                                    <label class="SelectLabel">Rodzaj zajęć</label>
                                    <select class="select" id="LessonTypePacketD" onChange="PriceCheckPacket()">
                                        <option value="1">Indywidualne</option>
                                        <option value="4">W parach</option>
                                    </select>
                                </div>
                                <div class="PayRow">
                                    <label class="SelectLabel">Długość trwania</label>
                                    <select class="select" id="LessonDurationPacketD" onChange="PriceCheckPacket()">
                                        <option value="2" id="DC60">55 minut</option>
                                        <option value="3" id="DC90">85 minut</option>
                                    </select>
                                </div>
                            </div>
                            <div class="PayCustom">
                                <div class="PayRow">
                                    <label class="SelectLabel">Język</label>
                                    <select class="select" id="LessonLanguagePacketD"  onchange="fixSelectsPacket()">
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}">{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="PayRow">
                                    <label class="SelectLabel">Przygotowanie do egzaminu</label>
                                    <select class="select" id="LessonCertyficatePacketD" onChange="PriceCheckPacket()">
                                        <option value="0">Nie</option>
                                        <option value="1">Tak</option>
                                    </select>
                                </div>
                               
                            </div> 
                            <div class="PayCustom flex-column" style="margin-top: 32px">
                                <label class="SelectLabel">Wybierz pakiet:</label>
                                <div class="radio-input">
                                    <label>
                                        <input type="radio" name="radio" checked="">
                                        <span>5 zajęć</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="radio">
                                        <span>10 zajęć</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="radio">
                                        <span>30 zajęć</span>
                                    </label>
                                </div>  
                            </div>
                        </div>
                        <div class="AmountDiv">
                            Cena: <span id="cenaPacketD">99</span> zł
                        </div>
                    </div>
                </div>
            </div>
            <div id="ContainerPacketD" class="PayCard">
                <div>
                    <label class="SelectLabel">Imię i nazwisko</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="NamePacketD" onchange="fixSelectsPacket()" required>
                </div>
                <div>
                    <label class="SelectLabel">Ulica i nr domu</label>
                    <input class="input" id="AdressPacketD" onchange="fixSelectsPacket()">
                </div>
                <div class="PayCustom">
                    <div class="PayRow">
                        <label class="SelectLabel">Kod pocztowy</label>
                        <input class="input" id="PostCodePacketD" onchange="fixSelectsPacket()">
                    </div>
                    <div class="PayRow">
                        <label class="SelectLabel">Miasto</label>
                        <input class="input" id="CityPacketD" onchange="fixSelectsPacket()">
                    </div>
                </div>
                <div class="PayCustom">
                    <label class="SelectLabel">NIP (opcjonalnie)</label>
                    <input class="input" id="NIPPacketD" onchange="fixSelectsPacket()">
                </div>
            </div>
            <div class="PaymentButtons">
                <button id="PacketbackButton1" onClick="closeModal('MPacketLessons')" class="btn LL-button LL-button-secondary">Wróć</button>
                <button id="PacketbackButton2" style="display: none" data="PacketS" class="PacketLink btn LL-button LL-button-secondary">Wróć</button>
                <button id="PacketnextButton1" data="PacketD" class="PacketLink btn LL-button LL-button-primary">Dalej</button>
                <button id="PacketnextButton2" style="display: none" class="btn LL-button LL-button-primary">Przejdź do płatności</button>
            </div>
        </div>
    </div>
    <div class='mobile mobileFlex' style="width: 100%;">
        <div class="DivHead">
            <span class="HeadText">Szczegóły rezerwacji</span>
            <button class="btn XButton" onClick="closeModal('MPacketLessons')">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.362686 11.4335L4.68772 7L0.362686 2.56647C0.108271 2.30567 0.108271 1.87892 0.362686 1.61812L1.7504 0.195597C2.00481 -0.065199 2.42113 -0.065199 2.67554 0.195597L7.00058 4.62913L11.3256 0.195597C11.58 -0.065199 12.0195 -0.065199 12.2739 0.195597L13.6385 1.61812C13.8929 1.87892 13.8929 2.30567 13.6385 2.56647L9.31343 7L13.6385 11.4335C13.8929 11.6943 13.8929 12.1448 13.6385 12.4056L12.2739 13.8044C12.0195 14.0652 11.58 14.0652 11.3256 13.8044L7.00058 9.37087L2.67554 13.8044C2.42113 14.0652 2.00481 14.0652 1.7504 13.8044L0.362686 12.4056C0.108271 12.1448 0.108271 11.6943 0.362686 11.4335Z" fill="#2B2B33"/>
                </svg>
            </button>
        </div>
        <div class="d-flex" style="flex-flow: column">
                <div class="DivButtons">
                    <div class="PayTab PacketLinkM PayTabActive" data="PacketMS" id="PacketMS">Szczegóły zajęć</div>
                    <div class="PayTab PacketLinkM" data="PacketMP" id="PacketMP">Dane do płatności</div>
                </div>
                <div class="container">
                    <div id="ContainerPacketMS" class="PayCardM">
                        <div class="PayInfo">
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="{{asset('images/svg/cap.svg')}}"></div>
                                <div>Pakiet</div>
                            </div>    
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="{{asset('images/svg/calendar.svg')}}"></div>
                                <div><span id="PacketDataM">01.09.2023</span> (<span id="PacketDzienM">piątek</span>), <span id="PacketGodzM">09:00 - 9:55</span></div>
                            </div>    
                            <div class="PayLabel">
                                <div class="PayIcon"><img src="/images/lectors/{{$lector->photo}}" style='width:48px; height: 48px; object-fit: cover;'></div>
                                <div>{{$lector->name}}</div>
                            </div>     
                        </div>
                       <div>
                            <div>
                                <label class="SelectLabel">Rodzaj zajęć</label>
                                <select class="select" id="LessonTypePacketM" onChange="PriceCheckPacket()">
                                    <option value="1">Indywidualne</option>
                                    <option value="4">W parach</option>
                                </select>
                            </div>
                            <div>
                                <label class="SelectLabel">Długość trwania</label>
                                <select class="select" id="LessonDurationPacketM" onChange="PriceCheckPacket()">
                                    <option value="2" id="MC60">55 minut</option>
                                    <option value="3" id="MC90">85 minut</option>
                                </select>
                            </div>
                            <div>
                                <label class="SelectLabel">Język</label>
                                <select class="select" id="LessonLanguagePacketM" onchange="fixSelectsPacket()" >
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="SelectLabel">Przygotowanie do egzaminu</label>
                                <select class="select" id="LessonCertyficatePacketM" onChange="PriceCheckPacket()">
                                    <option value="0">Nie</option>
                                    <option value="1">Tak</option>
                                </select>
                            </div>
                            <div>
                                <label class="SelectLabel">Ilość zajęć</label>
                                <div class="NumberDiv">
                                    <button class="NumberType" id="minusM" onClick="addLessons('-')" disabled><img src="{{asset('images/svg/minus.svg')}}"></button>
                                        <input class="number" value="2" id="LessonAmountPacketM" onChange="PriceCheckPacket()" readonly >
                                    <button class="NumberType" onClick="addLessons('+')"><img src="{{asset('images/svg/plus.svg')}}"></button>
                                </div>
                            </div>
                        </div>
                        <div class="AmountDiv">
                            Cena: <span id="cenaPacketM">99</span> zł
                        </div>
                    </div>
                </div>
            </div>
            <div id="ContainerPacketMP" class="PayCardM">
                <div>
                    <label class="SelectLabel">Imię i nazwisko</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="NamePacketM" onchange="fixSelectsPacket()" required>
                </div>
                <div>
                    <label class="SelectLabel">Ulica i nr domu</label>
                    <input class="input" id="AdressPacketM" onchange="fixSelectsPacket()">
                </div>
                <div>
                    <label class="SelectLabel">Kod pocztowy</label>
                    <input class="input" id="PostCodePacketM" onchange="fixSelectsPacket()">
                </div>
                <div>
                    <label class="SelectLabel">Miasto</label>
                    <input class="input" id="CityPacketM" onchange="fixSelectsPacket()">
                </div>
                <div>
                    <label class="SelectLabel">NIP (opcjonalnie)</label>
                    <input class="input" id="NIPPacketM" onchange="fixSelectsPacket()">
                </div>
                
                
            </div>
            <div class="d-flex" style="gap: 12px; flex-flow: column">
                <button id="PacketbackButtonM1" onClick="closeModal('MPacketLessons')" class="btn LL-button LL-button-secondary W-100">Wróć</button>
                <button id="PacketbackButtonM2" style="display: none" data="PacketMS" class="PacketLinkM btn LL-button LL-button-secondary W-100">Wróć</button>
                <button id="PacketnextButtonM1" data="PacketMD" class="PacketLinkM btn LL-button LL-button-primary w-100">Dalej</button>
                <button id="PacketnextButtonM2" style="display: none" class="btn LL-button LL-button-primary w-100">Przejdź do płatności</button>
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
    let Savedhour,less60,less90,dzienNazwa,ZajeciaData,ScreenType;
    let PaymentType = '';
    // console.log(Languages);
    let kwota = 0;
    let ok = true;
    $(document).ready(function () {

        $(".Paymentcard").each(function(index, value){
            $('.Paymentcard').hide();
        });
        $('#1').show();
        $(".page-link").on('click', function(){
            
            $(".page-link").each(function(index, value){
                $(value).parent().removeClass("active");
            });

            //Hide all cards
            $(".Paymentcard").each(function(index, value){
                $('.Paymentcard').hide();
            })

            $(this).parent().addClass("active");
            var cardId = "#" + $(this)[0].attributes.data.value;
            // e.target.attributes.data.value
            $(cardId).show();
        });
        // 
            $(".PayCard").each(function(index, value){
                $('.PayCard').hide();
            });
            $(".PayCardM").each(function(index, value){
                $('.PayCardM').hide();
            });
            $('#ContainerIndS').show();
            $('#ContainerIndMS').show();
            $(".IndLink").on('click', function(){
                
                $(".IndLink").each(function(index, value){
                    $(value).removeClass("PayTabActive");
                });

                //Hide all cards
                $(".PayCard").each(function(index, value){
                    $('.PayCard').hide();
                })
                if($(this)[0].attributes.data.value =='IndD'){
                   document.getElementById('nextButton1').style.display = 'none';
                   document.getElementById('backButton1').style.display = 'none';
                   document.getElementById('nextButton2').style.display = 'block';
                   document.getElementById('backButton2').style.display = 'block';
                //    button.setAttribute( "onClick", "javascript: Boo();" ); //tutaj koniec
                }
                else{
                    document.getElementById('nextButton1').style.display = 'block';
                   document.getElementById('backButton1').style.display = 'block';
                   document.getElementById('nextButton2').style.display = 'none';
                   document.getElementById('backButton2').style.display = 'none';
                }
                
                let id = "#"+$(this)[0].attributes.data.value;
                $(id).addClass("PayTabActive");
                var cardId = "#" +'Container'+ $(this)[0].attributes.data.value;
                // e.target.attributes.data.value
                $(cardId).show();
            });
            $(".IndLinkM").on('click', function(){
                
                $(".IndLinkM").each(function(index, value){
                    $(value).removeClass("PayTabActive");
                });

                //Hide all cards
                $(".PayCardM").each(function(index, value){
                    $('.PayCardM').hide();
                })
                if($(this)[0].attributes.data.value =='IndMD'){
                   document.getElementById('nextButtonM1').style.display = 'none';
                   document.getElementById('backButtonM1').style.display = 'none';
                   document.getElementById('nextButtonM2').style.display = 'block';
                   document.getElementById('backButtonM2').style.display = 'block';
                //    button.setAttribute( "onClick", "javascript: Boo();" ); //tutaj koniec
                }
                else{
                    document.getElementById('nextButtonM1').style.display = 'block';
                   document.getElementById('backButtonM1').style.display = 'block';
                   document.getElementById('nextButtonM2').style.display = 'none';
                   document.getElementById('backButtonM2').style.display = 'none';
                }
                
                let id = "#"+$(this)[0].attributes.data.value;
                $(id).addClass("PayTabActive");
                var cardId = "#" +'Container'+ $(this)[0].attributes.data.value;
                // e.target.attributes.data.value
                $(cardId).show();
            });
        // 
        // cykliczne
            $('#ContainerCyklS').show();
            $('#ContainerCyklMS').show();

            $(".CyklLink").on('click', function(){
                
                $(".CyklLink").each(function(index, value){
                    $(value).removeClass("PayTabActive");
                });

                //Hide all cards
                $(".PayCard").each(function(index, value){
                    $('.PayCard').hide();
                })
                if($(this)[0].attributes.data.value =='CyklD'){
                   document.getElementById('CyklnextButton1').style.display = 'none';
                   document.getElementById('CyklbackButton1').style.display = 'none';
                   document.getElementById('CyklnextButton2').style.display = 'block';
                   document.getElementById('CyklbackButton2').style.display = 'block';
                //    button.setAttribute( "onClick", "javascript: Boo();" ); //tutaj koniec
                }
                else{
                    document.getElementById('CyklnextButton1').style.display = 'block';
                   document.getElementById('CyklbackButton1').style.display = 'block';
                   document.getElementById('CyklnextButton2').style.display = 'none';
                   document.getElementById('CyklbackButton2').style.display = 'none';
                }
                
                let id = "#"+$(this)[0].attributes.data.value;
                $(id).addClass("PayTabActive");
                var cardId = "#" +'Container'+ $(this)[0].attributes.data.value;
                // e.target.attributes.data.value
                $(cardId).show();
            });


            $(".CyklLinkM").on('click', function(){
                
                $(".CyklLinkM").each(function(index, value){
                    $(value).removeClass("PayTabActive");
                });

                //Hide all cards
                $(".PayCardM").each(function(index, value){
                    $('.PayCardM').hide();
                })
                if($(this)[0].attributes.data.value =='CyklMD'){
                   document.getElementById('CyklnextButtonM1').style.display = 'none';
                   document.getElementById('CyklbackButtonM1').style.display = 'none';
                   document.getElementById('CyklnextButtonM2').style.display = 'block';
                   document.getElementById('CyklbackButtonM2').style.display = 'block';
                //    button.setAttribute( "onClick", "javascript: Boo();" ); //tutaj koniec
                }
                else{
                    document.getElementById('CyklnextButtonM1').style.display = 'block';
                   document.getElementById('CyklbackButtonM1').style.display = 'block';
                   document.getElementById('CyklnextButtonM2').style.display = 'none';
                   document.getElementById('CyklbackButtonM2').style.display = 'none';
                }
                
                let id = "#"+$(this)[0].attributes.data.value;
                $(id).addClass("PayTabActive");
                var cardId = "#" +'Container'+ $(this)[0].attributes.data.value;
                // e.target.attributes.data.value
                $(cardId).show();
            });
            // pakiety
            $('#ContainerPacketS').show();
            $('#ContainerPacketMS').show();

            $(".PacketLink").on('click', function(){
                
                $(".PacketLink").each(function(index, value){
                    $(value).removeClass("PayTabActive");
                });

                //Hide all cards
                $(".PayCard").each(function(index, value){
                    $('.PayCard').hide();
                })
                if($(this)[0].attributes.data.value =='PacketD'){
                   document.getElementById('PacketnextButton1').style.display = 'none';
                   document.getElementById('PacketbackButton1').style.display = 'none';
                   document.getElementById('PacketnextButton2').style.display = 'block';
                   document.getElementById('PacketbackButton2').style.display = 'block';
                //    button.setAttribute( "onClick", "javascript: Boo();" ); //tutaj koniec
                }
                else{
                    document.getElementById('PacketnextButton1').style.display = 'block';
                   document.getElementById('PacketbackButton1').style.display = 'block';
                   document.getElementById('PacketnextButton2').style.display = 'none';
                   document.getElementById('PacketbackButton2').style.display = 'none';
                }
                
                let id = "#"+$(this)[0].attributes.data.value;
                $(id).addClass("PayTabActive");
                var cardId = "#" +'Container'+ $(this)[0].attributes.data.value;
                // e.target.attributes.data.value
                $(cardId).show();
            });


            $(".PacketLinkM").on('click', function(){
                
                $(".PacketLinkM").each(function(index, value){
                    $(value).removeClass("PayTabActive");
                });

                //Hide all cards
                $(".PayCardM").each(function(index, value){
                    $('.PayCardM').hide();
                })
                if($(this)[0].attributes.data.value =='PacketMD'){
                   document.getElementById('PacketnextButtonM1').style.display = 'none';
                   document.getElementById('PacketbackButtonM1').style.display = 'none';
                   document.getElementById('PacketnextButtonM2').style.display = 'block';
                   document.getElementById('PacketbackButtonM2').style.display = 'block';
                //    button.setAttribute( "onClick", "javascript: Boo();" ); //tutaj koniec
                }
                else{
                    document.getElementById('PacketnextButtonM1').style.display = 'block';
                   document.getElementById('PacketbackButtonM1').style.display = 'block';
                   document.getElementById('PacketnextButtonM2').style.display = 'none';
                   document.getElementById('PacketbackButtonM2').style.display = 'none';
                }
                
                let id = "#"+$(this)[0].attributes.data.value;
                $(id).addClass("PayTabActive");
                var cardId = "#" +'Container'+ $(this)[0].attributes.data.value;
                // e.target.attributes.data.value
                $(cardId).show();
            });

        let touchstartX = 0
        let touchendX = 0
        let roznica = touchstartX - touchendX;
        function checkDirection() {
            let active = document.getElementsByClassName("active");
            let now = active[0].childNodes[0].attributes.data.value;
            let cardId;
            let id;
            if (touchendX < touchstartX && Math.abs(roznica)>20){
                if(now != 3){
                    cardId = "#" + (parseInt(now) + 1);
                    id = parseInt(now) + 1;
                }
                else {
                    cardId =  "#" +1;
                    id = 1;
                }
            } 
            if (touchendX > touchstartX && Math.abs(roznica)>20) {
                if(now != 1){
                    cardId = "#" + (parseInt(now) - 1);
                    id = parseInt(now)- 1;
                }
                else {
                    cardId =  "#" +3;
                    id = 3;
                }
            }
            $(".page-link").each(function(index, value){
                $(value).parent().removeClass("active");
            });
            $(".Paymentcard").each(function(index, value){
                $('.Paymentcard').hide();
            });
            // document.getElementById(id).addClass("active");
            $(cardId).show();
            $(cardId+'B').parent().addClass("active");
        }

        document.addEventListener('touchstart', e => {
            touchstartX = e.changedTouches[0].screenX;
            roznica = touchstartX - touchendX;
        });

        document.addEventListener('touchend', e => {
            touchendX = e.changedTouches[0].screenX;
            roznica = touchstartX - touchendX;
        checkDirection();
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
    function openInd(){
        $('#ContainerIndS').show();
        $('#ContainerIndMS').show();
        PaymentType = 'Indywidualne';
        closeModal('PaymentTable');
        document.getElementById('container').style.filter = 'blur(15px)';
        window.scrollTo(0, 0);
        PriceCheck();
        document.getElementById('IndData').innerText = ZajeciaData;
        document.getElementById('IndDzien').innerText = dzienNazwa;
        document.getElementById('IndGodz').innerText = Savedhour;
        document.getElementById('IndDataM').innerText = ZajeciaData;
        document.getElementById('IndDzienM').innerText = dzienNazwa;
        document.getElementById('IndGodzM').innerText = Savedhour;
        let test = new Date('2024-01-01 '+Savedhour);
        let test2 = new Date(test);
        test2.setMinutes ( test.getMinutes() + 30 );
            document.getElementById('MIndLessons').style.display = 'block';
            if(less60 == 0){
                document.getElementById('M60').disabled = true;
                document.getElementById('D60').disabled = true;
            }
            else{
                document.getElementById('M60').disabled = false;
                document.getElementById('D60').disabled = false; 
            }
            if(less90 == 0){
                document.getElementById('M90').disabled = true;
                document.getElementById('D90').disabled = true;
            }
            else{
                document.getElementById('M90').disabled = false;
                document.getElementById('D90').disabled = false; 
            }
            // tu selecty
        }
    function MCyklLessons(){
        $('#ContainerCyklS').show();
        $('#ContainerCyklMS').show();
        PaymentType = 'Cykliczne';
        closeModal('PaymentTable');
        document.getElementById('container').style.filter = 'blur(15px)';
        window.scrollTo(0, 0);
        PriceCheckCykl();
        document.getElementById('CyklData').innerText = ZajeciaData;
        document.getElementById('CyklDzien').innerText = dzienNazwa;
        document.getElementById('CyklGodz').innerText = Savedhour;
        document.getElementById('CyklDataM').innerText = ZajeciaData;
        document.getElementById('CyklDzienM').innerText = dzienNazwa;
        document.getElementById('CyklGodzM').innerText = Savedhour;
        let test = new Date('2024-01-01 '+Savedhour);
        let test2 = new Date(test);
        test2.setMinutes ( test.getMinutes() + 30 );
            document.getElementById('MCyklLessons').style.display = 'block';
            if(less60 == 0){
                document.getElementById('MC60').disabled = true;
                document.getElementById('DC60').disabled = true;
            }
            else{
                document.getElementById('MC60').disabled = false;
                document.getElementById('DC60').disabled = false; 
            }
            if(less90 == 0){
                document.getElementById('MC90').disabled = true;
                document.getElementById('DC90').disabled = true;
            }
            else{
                document.getElementById('MC90').disabled = false;
                document.getElementById('DC90').disabled = false; 
            }
            // tu selecty
        }
        function MPacketLessons(){
        $('#ContainerPacketS').show();
        $('#ContainerPacketMS').show();
        PaymentType = 'Pakiet';
        closeModal('PaymentTable');
        document.getElementById('container').style.filter = 'blur(15px)';
        window.scrollTo(0, 0);
        PriceCheckPacket();
        document.getElementById('PacketData').innerText = ZajeciaData;
        document.getElementById('PacketDzien').innerText = dzienNazwa;
        document.getElementById('PacketGodz').innerText = Savedhour;
        document.getElementById('PacketDataM').innerText = ZajeciaData;
        document.getElementById('PacketDzienM').innerText = dzienNazwa;
        document.getElementById('PacketGodzM').innerText = Savedhour;
        let test = new Date('2024-01-01 '+Savedhour);
        let test2 = new Date(test);
        test2.setMinutes ( test.getMinutes() + 30 );
            document.getElementById('MPacketLessons').style.display = 'block';
            if(less60 == 0){
                document.getElementById('MC60').disabled = true;
                document.getElementById('DC60').disabled = true;
            }
            else{
                document.getElementById('MC60').disabled = false;
                document.getElementById('DC60').disabled = false; 
            }
            if(less90 == 0){
                document.getElementById('MC90').disabled = true;
                document.getElementById('DC90').disabled = true;
            }
            else{
                document.getElementById('MC90').disabled = false;
                document.getElementById('DC90').disabled = false; 
            }
            // tu selecty
        }
    function OpenHour(hour,dataZ,dzien,l60,l90){
            Savedhour = hour;
            less60 = l60;
            less90 = l90;
            dzienNazwa = dzien;
            ZajeciaData = dataZ;
            OpenPaymentTable();
        }
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
        function PriceCheck(){
            $.ajax({
            type: "POST",
            url: '../api/Paymentprice',
            data: {
                lector_type_id: '{{$lector->lector_type_id}}', 
                duration: document.getElementById('LessonDuration'+ScreenType).value, 
                cert: document.getElementById('LessonCertyficate'+ScreenType).value,
                rodzaj: document.getElementById('LessonType'+ScreenType).value
                },
            })
            .done(function( data) {
                kwota = data;
                document.getElementById('cenaM').innerText = kwota;
                document.getElementById('cenaD').innerText = kwota;
                fixSelects();
            })
            .fail(function() {
                alert( "error" );
            });
        }
        function PriceCheckCykl(){
            $.ajax({
            type: "POST",
            url: '../api/Paymentprice',
            data: {
                lector_type_id: '{{$lector->lector_type_id}}', 
                duration: document.getElementById('LessonDurationCykl'+ScreenType).value, 
                cert: document.getElementById('LessonCertyficateCykl'+ScreenType).value,
                rodzaj: document.getElementById('LessonTypeCykl'+ScreenType).value
                },
            })
            .done(function(data) {
                kwota = data * document.getElementById('LessonAmountCykl'+ScreenType).value;
                document.getElementById('cenaCyklM').innerText = kwota;
                document.getElementById('cenaCyklD').innerText = kwota;
                fixSelectsCykl();
            })
            .fail(function() {
                alert( "error" );
            });
        }
        function PriceCheckPacket(){
            $.ajax({
            type: "POST",
            url: '../api/Paymentprice',
            data: {
                lector_type_id: '{{$lector->lector_type_id}}', 
                duration: document.getElementById('LessonDurationPacket'+ScreenType).value, 
                cert: document.getElementById('LessonCertyficatePacket'+ScreenType).value,
                rodzaj: document.getElementById('LessonTypePacket'+ScreenType).value
                },
            })
            .done(function(data) {
                kwota = data * document.getElementById('LessonAmountPacket'+ScreenType).value;
                document.getElementById('cenaPacketM').innerText = kwota;
                document.getElementById('cenaPacketD').innerText = kwota;
                fixSelectsPacket();
            })
            .fail(function() {
                alert( "error" );
            });
        }
        function fixSelects(){
            if(ScreenType == 'M'){
                type2 = 'D';
            }else{
                type2 = 'M';
            }
            document.getElementById('LessonDuration'+type2).value = document.getElementById('LessonDuration'+ScreenType).value ;
            document.getElementById('LessonCertyficate'+type2).value = document.getElementById('LessonCertyficate'+ScreenType).value;
            document.getElementById('LessonType'+type2).value = document.getElementById('LessonType'+ScreenType).value;
            document.getElementById('LessonLanguage'+type2).value = document.getElementById('LessonLanguage'+ScreenType).value;
            
            document.getElementById('NameInd'+type2).value = document.getElementById('NameInd'+ScreenType).value;
            document.getElementById('AdressInd'+type2).value = document.getElementById('AdressInd'+ScreenType).value;
            document.getElementById('PostCodeInd'+type2).value = document.getElementById('PostCodeInd'+ScreenType).value;
            document.getElementById('CityInd'+type2).value = document.getElementById('CityInd'+ScreenType).value;
            document.getElementById('NIPInd'+type2).value = document.getElementById('NIPInd'+ScreenType).value;
        }
        function fixSelectsCykl(){
            go();
            if(ScreenType == 'M'){
                type2 = 'D';
            }else{
                type2 = 'M';
            }
            document.getElementById('LessonDurationCykl'+type2).value = document.getElementById('LessonDurationCykl'+ScreenType).value ;
            document.getElementById('LessonCertyficateCykl'+type2).value = document.getElementById('LessonCertyficateCykl'+ScreenType).value;
            document.getElementById('LessonTypeCykl'+type2).value = document.getElementById('LessonTypeCykl'+ScreenType).value;
            document.getElementById('LessonLanguageCykl'+type2).value = document.getElementById('LessonLanguageCykl'+ScreenType).value;
            document.getElementById('LessonAmountCykl'+type2).value = document.getElementById('LessonAmountCykl'+ScreenType).value;

            document.getElementById('NameCykl'+type2).value = document.getElementById('NameCykl'+ScreenType).value;
            document.getElementById('AdressCykl'+type2).value = document.getElementById('AdressCykl'+ScreenType).value;
            document.getElementById('PostCodeCykl'+type2).value = document.getElementById('PostCodeCykl'+ScreenType).value;
            document.getElementById('CityCykl'+type2).value = document.getElementById('CityCykl'+ScreenType).value;
            document.getElementById('NIPCykl'+type2).value = document.getElementById('NIPCykl'+ScreenType).value;
        }
        function fixSelectsPacket(){
            go();
            if(ScreenType == 'M'){
                type2 = 'D';
            }else{
                type2 = 'M';
            }
            document.getElementById('LessonDurationPacket'+type2).value = document.getElementById('LessonDurationPacket'+ScreenType).value ;
            document.getElementById('LessonCertyficatePacket'+type2).value = document.getElementById('LessonCertyficatePacket'+ScreenType).value;
            document.getElementById('LessonTypePacket'+type2).value = document.getElementById('LessonTypePacket'+ScreenType).value;
            document.getElementById('LessonLanguagePacket'+type2).value = document.getElementById('LessonLanguagePacket'+ScreenType).value;
            document.getElementById('LessonAmountPacket'+type2).value = document.getElementById('LessonAmountPacket'+ScreenType).value;

            document.getElementById('NamePacket'+type2).value = document.getElementById('NamePacket'+ScreenType).value;
            document.getElementById('AdressPacket'+type2).value = document.getElementById('AdressPacket'+ScreenType).value;
            document.getElementById('PostCodePacket'+type2).value = document.getElementById('PostCodePacket'+ScreenType).value;
            document.getElementById('CityPacket'+type2).value = document.getElementById('CityPacket'+ScreenType).value;
            document.getElementById('NIPPacket'+type2).value = document.getElementById('NIPPacket'+ScreenType).value;
        }
        function addLessons(type){
            go();
            let ile = document.getElementById('LessonAmountCykl'+ScreenType).value;
            if(type == '+'){
                ile++;
            }else{
                ile--;
            }
            if(ile > 2){
                document.getElementById('minusM').disabled = false;
                document.getElementById('minusD').disabled = false;
            }else{
                document.getElementById('minusM').disabled = true;
                document.getElementById('minusD').disabled = true;
            }
            document.getElementById('LessonAmountCyklM').value = ile;
            document.getElementById('LessonAmountCyklD').value = ile;
            PriceCheckCykl();
        }
go();
window.addEventListener('resize', go());
function go(){
    if(document.documentElement.clientWidth > 800){
        ScreenType = 'D';
    }
    else{
        ScreenType = 'M';
    }
}
</script>