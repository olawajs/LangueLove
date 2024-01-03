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
            <div class="d-flex flex-column LectorColumn" style="gap:20px;">
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
                           
                            <div id="Week{{$loop->index}}" @if( $loop->index > 0)style="display: none" @endif>
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
                                                        <div class="emptyHour">{{$k2}}</div>
                                                    @endif
                                                    
                                                @endif
                                            @endforeach
                                           
                                        </div>
                                    </div>
                                    @endforeach
                                   
                                </div> 
                            </div> 
                            @if($lector->id == 15 && $loop->index==9)
                                @php dd('Strona chwilowo niedostępna2');  @endphp
                            @endif
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
                @if($lector->yt != '')
                    <iframe class="YTVideo" width="560" height="315" src="{{$lector->yt}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                @else
                    <iframe class="YTVideo" width="560" height="315" src="https://www.youtube.com/embed/jFLFeucqPh0?si=EuO7aroigvszu_c_" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                @endif
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
                <div class="PaymentColumn" style="padding: 12px;"> 
                    <div class="PayHead">
                        <div>
                            <span class="HeadText2">Zajęcia cykliczne</span>
                        </div>
                        <div style="min-height: 40px">
                            <span class="UnderText">dowolna ilość zajęć co tydzień o stałej porze</span>
                        </div>  
                    </div>
                    <div class="PaymentList">
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                            <span>możliwość przełożenia i odwołania zajęć</span>
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
                            <span class="ListImage"><img src="{{asset('images/svg/cross.svg')}}"></span>
                            <span class="CrossLine">promocyjna cena</span>
                        </div>
                    </div>
                    <div>
                        <buton class="LL-button LL-button-primary w-100"  onclick="MCyklLessons()">Rezerwuj</buton>
                    </div>
                </div>
                <div class="PaymentColumn" style="padding: 12px;
                            border: 1px solid var(--langue-love-purple);
                            border-radius: 13px;">
                    <div class="PayHead">
                        <div style="display: flex;  justify-content: space-between;">
                            <span class="HeadText2">Pakiet</span><span class="navPinkButton">Najczęściej wybierany!</span>
                        </div>
                        <div style="min-height: 40px">
                            <span class="UnderText">5, 10 lub 30 zajęć do wykorzystania odpowiednio w ciągu 5, 10 lub 30 tygodni</span> 
                        </div>
                    </div>
                    <div class="PaymentList">
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                            <span>możliwość przełożenia i odwołania zajęć</span>
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
                            <span>promocyjna cena</span>
                        </div>
                    </div>
                    <div>
                        <buton class="LL-button LL-button-primary w-100" onclick="MPacketLessons()">Rezerwuj</buton>
                    </div>
                </div>
                <div class="PaymentColumn" style="padding: 12px;">
                    <div class="PayHead">
                        <div>
                            <span class="HeadText2">Pojedyncze zajęcia</span>
                        </div>
                        <div style="min-height: 40px">
                            <span class="UnderText">pojedyncze zajęcia o wybranej godzinie</span>
                        </div>   
                    </div>
                    <div class="PaymentList">
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                            <span>możliwość przełożenia i odwołania zajęć</span>
                        </div>
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/check.svg')}}"></span>
                            <span class="">rezerwacja najlepszego dla Ciebie terminu</span>
                        </div>
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/cross.svg')}}"></span>
                            <span class="CrossLine">regularne zajęcia</span>
                        </div>
                        <div class="ListArgument">
                            <span class="ListImage"><img src="{{asset('images/svg/cross.svg')}}"></span>
                            <span class="CrossLine">promocyjna cena</span>
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
                    <label class="SelectLabel">Ulica i nr domu</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="AdressIndD" onchange="fixSelects()">
                </div>
                <div class="PayCustom">
                    <div class="PayRow">
                        <label class="SelectLabel">Kod pocztowy</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                        <input class="input" id="PostCodeIndD" onchange="fixSelects()">
                    </div>
                    <div class="PayRow">
                        <label class="SelectLabel">Miasto</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
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
                <button id="nextButton2" style="display: none" class="btn LL-button LL-button-primary"  onClick ="BuyLesson()">Przejdź do płatności</button>
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
                    <label class="SelectLabel">Ulica i nr domu</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="AdressIndM" onchange="fixSelects()">
                </div>
                <div>
                    <label class="SelectLabel">Kod pocztowy</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="PostCodeIndM" onchange="fixSelects()">
                </div>
                <div>
                    <label class="SelectLabel">Miasto</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="CityIndM" onchange="fixSelects()">
                </div>
                <div>
                    <label class="SelectLabel">NIP (opcjonalnie)</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="NIPIndM" onchange="fixSelects()">
                </div>
                
                
            </div>
            <div class="d-flex" style="gap: 12px; flex-flow: column">
                <button id="backButtonM1" onClick="closeModal('MIndLessons')" class="btn LL-button LL-button-secondary W-100">Wróć</button>
                <button id="backButtonM2" style="display: none" data="IndMS" class="IndLinkM btn LL-button LL-button-secondary W-100">Wróć</button>
                <button id="nextButtonM1" data="IndMD" class="IndLinkM btn LL-button LL-button-primary w-100">Dalej</button>
                <button id="nextButtonM2" style="display: none" class="btn LL-button LL-button-primary w-100" onClick ="BuyLesson()">Przejdź do płatności</button>
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
                    <label class="SelectLabel">Ulica i nr domu</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="AdressCyklD" onchange="fixSelectsCykl()">
                </div>
                <div class="PayCustom">
                    <div class="PayRow">
                        <label class="SelectLabel">Kod pocztowy</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                        <input class="input" id="PostCodeCyklD" onchange="fixSelectsCykl()">
                    </div>
                    <div class="PayRow">
                        <label class="SelectLabel">Miasto</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                        <input class="input" id="CityCyklD" onchange="fixSelectsCykl()">
                    </div>
                </div>
                <div class="PayCustom">
                    <label class="SelectLabel">NIP (opcjonalnie)</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="NIPCyklD" onchange="fixSelectsCykl()">
                </div>
            </div>
            <div class="PaymentButtons">
                <button id="CyklbackButton1" onClick="closeModal('MCyklLessons')" class="btn LL-button LL-button-secondary">Wróć</button>
                <button id="CyklbackButton2" style="display: none" data="CyklS" class="CyklLink btn LL-button LL-button-secondary">Wróć</button>
                <button id="CyklnextButton1" data="CyklD" class="CyklLink btn LL-button LL-button-primary">Dalej</button>
                <button id="CyklnextButton2" style="display: none" class="btn LL-button LL-button-primary" onClick ="BuyCyklLesson()">Przejdź do płatności</button>
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
                    <div class="PayTab CyklLinkM" data="CyklMD" id="CyklMP">Dane do płatności</div>
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
            <div id="ContainerCyklMD" class="PayCardM">
                <div>
                    <label class="SelectLabel">Imię i nazwisko</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="NameCyklM" onchange="fixSelectsCykl()" required>
                </div>
                <div>
                    <label class="SelectLabel">Ulica i nr domu</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="AdressCyklM" onchange="fixSelectsCykl()">
                </div>
                <div>
                    <label class="SelectLabel">Kod pocztowy</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="PostCodeCyklM" onchange="fixSelectsCykl()">
                </div>
                <div>
                    <label class="SelectLabel">Miasto</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="CityCyklM" onchange="fixSelectsCykl()">
                </div>
                <div>
                    <label class="SelectLabel">NIP (opcjonalnie)</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="NIPCyklM" onchange="fixSelectsCykl()">
                </div>
                
                
            </div>
            <div class="d-flex" style="gap: 12px; flex-flow: column">
                <button id="CyklbackButtonM1" onClick="closeModal('MCyklLessons')" class="btn LL-button LL-button-secondary W-100">Wróć</button>
                <button id="CyklbackButtonM2" style="display: none" data="CyklMS" class="CyklLinkM btn LL-button LL-button-secondary W-100">Wróć</button>
                <button id="CyklnextButtonM1" data="CyklMD" class="CyklLinkM btn LL-button LL-button-primary w-100">Dalej</button>
                <button id="CyklnextButtonM2" style="display: none" class="btn LL-button LL-button-primary w-100" onClick ="BuyCyklLesson()">Przejdź do płatności</button>
            </div>
    </div> 
</div>
<!-- Pakiet -->
<div class="StickDiv" id="MPacketLessons" style="display: none; top: calc(50% + 200px);">
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
                                        <input type="radio" value="5" id="5D"  name="PacketAmountD" checked=""  onchange="PriceCheckPacket()">
                                        <span>5 zajęć</span>
                                    </label>
                                    <label>
                                        <input type="radio" value="10" id="10D"  name="PacketAmountD"  onchange="PriceCheckPacket()">
                                        <span>10 zajęć</span>
                                    </label>
                                    <label>
                                        <input type="radio" value="30" id="30D"  name="PacketAmountD"  onchange="PriceCheckPacket()">
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
                    <label class="SelectLabel">Ulica i nr domu</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="AdressPacketD" onchange="fixSelectsPacket()">
                </div>
                <div class="PayCustom">
                    <div class="PayRow">
                        <label class="SelectLabel">Kod pocztowy</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                        <input class="input" id="PostCodePacketD" onchange="fixSelectsPacket()">
                    </div>
                    <div class="PayRow">
                        <label class="SelectLabel">Miasto</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
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
                <button id="PacketnextButton2" style="display: none" class="btn LL-button LL-button-primary"  onClick ="BuyPacket()">Przejdź do płatności</button>
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
                    <div class="PayTab PacketLinkM" data="PacketMD" id="PacketMD">Dane do płatności</div>
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
                            <div class="flex-column" style="margin-top: 32px">
                                <label class="SelectLabel">Wybierz pakiet:</label>
                                <div class="radio-input">
                                    <label>
                                        <input type="radio" name="PacketAmountM" value="5" id="5M" checked=""  onchange="PriceCheckPacket()">
                                        <span>5 zajęć</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="PacketAmountM" value="10" id="10M"  onchange="PriceCheckPacket()">
                                        <span>10 zajęć</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="PacketAmountM" value='30' id="30M"  onchange="PriceCheckPacket()">
                                        <span>30 zajęć</span>
                                    </label>
                                </div>  
                            </div>
                        </div>
                        <div class="AmountDiv">
                            Cena: <span id="cenaPacketM">99</span> zł
                        </div>
                    </div>
                </div>
            </div>
            <div id="ContainerPacketMD" class="PayCardM">
                <div>
                    <label class="SelectLabel">Imię i nazwisko</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="NamePacketM" onchange="fixSelectsPacket()" required>
                </div>
                <div>
                    <label class="SelectLabel">Ulica i nr domu</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="AdressPacketM" onchange="fixSelectsPacket()">
                </div>
                <div>
                    <label class="SelectLabel">Kod pocztowy</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="PostCodePacketM" onchange="fixSelectsPacket()">
                </div>
                <div>
                    <label class="SelectLabel">Miasto</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="CityPacketM" onchange="fixSelectsPacket()">
                </div>
                <div>
                    <label class="SelectLabel">NIP (opcjonalnie)</label><span style="color: var(--langue-love-purple, #3C0079);">*</span>
                    <input class="input" id="NIPPacketM" onchange="fixSelectsPacket()">
                </div>
                
                
            </div>
            <div class="d-flex" style="gap: 12px; flex-flow: column">
                <button id="PacketbackButtonM1" onClick="closeModal('MPacketLessons')" class="btn LL-button LL-button-secondary W-100">Wróć</button>
                <button id="PacketbackButtonM2" style="display: none" data="PacketMS" class="PacketLinkM btn LL-button LL-button-secondary W-100">Wróć</button>
                <button id="PacketnextButtonM1" data="PacketMD" class="PacketLinkM btn LL-button LL-button-primary w-100">Dalej</button>
                <button id="PacketnextButtonM2" style="display: none" class="btn LL-button LL-button-primary w-100" onClick ="BuyPacket()">Przejdź do płatności</button>
            </div>
    </div> 
</div>
<!-- Language modal -->

  <!-- end LM -->

<div id="FormDiv"></div>
  @endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 

<script>
    let LessonAmount = {!! json_encode($lessonAmount) !!};
    let Savedhour,less60,less90,dzienNazwa,ZajeciaData,ScreenType;
    let PaymentType = '';
    let packetAmount = 0;
    let nameType = '';
    let kwota = 0;
    let dw = 0;
    let ok = true;
    let User = {!! json_encode($User) !!};
    // console.log(User2['id']);
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
    });

    function openInd(){
        var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
        if(!AuthUser){
            window.location.href = "{{ route('login')}}";
        }
        $('#ContainerIndS').show();
        $('#ContainerIndMS').show();
        PaymentType = 'Indywidualne';
        nameType = 'Ind';
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
        var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
        if(!AuthUser){
            window.location.href = "{{ route('login')}}";
        }
        $('#ContainerCyklS').show();
        $('#ContainerCyklMS').show();
        PaymentType = 'Cykliczne';
        nameType = 'Cykl';
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
        var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
        if(!AuthUser){
            window.location.href = "{{ route('login')}}";
        }
        $('#ContainerPacketS').show();
        $('#ContainerPacketMS').show();
        PaymentType = 'Pakiet';
        nameType = 'Packet';
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
        url: '../api/Packetprice',
        data: {
            lector_type_id: '{{$lector->lector_type_id}}', 
            duration: document.getElementById('LessonDurationPacket'+ScreenType).value, 
            cert: document.getElementById('LessonCertyficatePacket'+ScreenType).value,
            rodzaj: document.getElementById('LessonTypePacket'+ScreenType).value,
            amount: $('input[name="PacketAmount'+ScreenType+'"]:checked').val()
            },
        })
        .done(function(data) {
            kwota = data ;
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
        checkLessonAmount(document.getElementById('LessonType'+ScreenType).value,'{{$lector->lector_type_id}}',document.getElementById('LessonCertyficate'+ScreenType).value);
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
        checkLessonAmount(document.getElementById('LessonTypeCykl'+ScreenType).value,'{{$lector->lector_type_id}}',document.getElementById('LessonCertyficateCykl'+ScreenType).value);
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

        let h = $('input[name="PacketAmount'+ScreenType+'"]:checked').val();
        document.getElementById(h+type2).checked = true;
        packetAmount = h;

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
    function BuyPacket(){
               // packetAmount
            let durationId = document.getElementById('LessonDurationPacket'+ScreenType).value ;
            let cert = document.getElementById('LessonCertyficatePacket'+ScreenType).value;
            let type = document.getElementById('LessonTypePacket'+ScreenType).value;
            let languageId = document.getElementById('LessonLanguagePacket'+ScreenType).value;
            let lName = '';
            let durat = '';
            let ce = '';

            let TypeDesc = '';
            if(type == 1){
                TypeDesc = 'indywidualnych';
            }
            else{
                TypeDesc = 'w parze';
            }
            let l = {!! json_encode($languages) !!};
            function iterate(item) {
                if(item.id == languageId){
                    lName = item.name;
                }
            }
            l.forEach(iterate);
            let d = {!! json_encode($durations) !!};
            function iterate2(item) {
                if(item.id == durationId){
                    durat = item.duration;
                }
            }
            d.forEach(iterate2);
            if(cert == 1){
                ce=', przygotowujących do certyfikatu';
            }
            let desc = 'pakiet '+packetAmount+' lekcji '+TypeDesc+' '+durat+'-minutowych z języka '+lName+'ego'+ce;

            let form = document.createElement('form');
                form.setAttribute('method','POST');
                form.setAttribute('action',"{{ route('transaction') }}");
            let price = document.createElement('input');
                price.setAttribute('name','price');
                price.setAttribute('type','hidden');
                price.value = kwota;
            let LectorType = document.createElement('input');
                LectorType.setAttribute('name','LectorType');
                LectorType.setAttribute('type','hidden');
                LectorType.value = '{{$lector->lector_type_id}}';
            let desc2 = document.createElement('input');
                desc2.setAttribute('name','desc');
                desc2.setAttribute('type','hidden');
                desc2.value = desc;
            let name = document.createElement('input');
                name.setAttribute('name','name');
                name.setAttribute('required','true');
                name.setAttribute('type','hidden');
                name.value = document.getElementById('NamePacket'+ScreenType).value;
            let nip = document.createElement('input');
                nip.setAttribute('name','nip');
                nip.setAttribute('type','hidden');
                nip.value = document.getElementById('NIPPacket'+ScreenType).value;
            let city = document.createElement('input');
                city.setAttribute('name','city');
                city.setAttribute('type','hidden');
                city.value = document.getElementById('CityPacket'+ScreenType).value;
            let postcode = document.createElement('input');
                postcode.setAttribute('name','postcode');
                postcode.setAttribute('type','hidden');
                postcode.value = document.getElementById('PostCodePacket'+ScreenType).value;
            let street = document.createElement('input');
                street.setAttribute('name','street');
                street.setAttribute('type','hidden');
                street.value = document.getElementById('AdressPacket'+ScreenType).value;
            let langDesc = document.createElement('input');
                langDesc.setAttribute('name','langDesc');
                langDesc.setAttribute('type','hidden');
                langDesc.value = languageId;
            let packet = document.createElement('input');
                packet.setAttribute('name','packet');
                packet.setAttribute('type','hidden');
                packet.value = packetAmount;
            let typeA = document.createElement('input');
                typeA.setAttribute('name','typeA');
                typeA.setAttribute('type','hidden');
                typeA.value = type;
            let certyficate = document.createElement('input');
                certyficate.setAttribute('name','certyficate');
                certyficate.setAttribute('type','hidden');
                certyficate.value = cert;
    
                form.innerHTML ='@csrf';
                form.appendChild(price);
                form.appendChild(desc2);
                form.appendChild(LectorType);
                form.appendChild(name);
                form.appendChild(nip);
                form.appendChild(city);
                form.appendChild(postcode);
                form.appendChild(street);
                form.appendChild(langDesc);
                form.appendChild(packet);
                form.appendChild(typeA);
                form.appendChild(certyficate);

                if(name.value == ''){
                    alert('Prosimy o wypełnienie pola imię');
                    document.getElementById('NamePacket'+ScreenType).focus();
                }
                else if(city.value == ''){
                    alert('Prosimy o wypełnienie pola miasto');
                    document.getElementById('CityPacket'+ScreenType).focus();
                }
                else if(postcode.value == ''){
                    alert('Prosimy o wypełnienie pola kod pocztowy');
                    document.getElementById('PostCodePacket'+ScreenType).focus();
                }
                else if(street.value == ''){
                    alert('Prosimy o wypełnienie pola ulica');
                    document.getElementById('AdressPacket'+ScreenType).focus();
                }
                else{
                    document.getElementById('FormDiv').appendChild(form);
                    form.submit();
                }
                
    }
    function BuyLesson(){

            let durationId = document.getElementById('LessonDuration'+ScreenType).value ;
            let cert = document.getElementById('LessonCertyficate'+ScreenType).value;
            let type = document.getElementById('LessonType'+ScreenType).value;
            let languageId = document.getElementById('LessonLanguage'+ScreenType).value;


            let form = document.createElement('form');
                form.setAttribute('method','POST');
                form.setAttribute('action',"{{ route('buyLesson') }}");
            let start = document.createElement('input');
                start.setAttribute('name','data');
                start.setAttribute('type','hidden');
                start.value = ZajeciaData;
            let godzina = document.createElement('input');
                godzina.setAttribute('name','godzina');
                godzina.setAttribute('type','hidden');
                godzina.value = Savedhour;
            let duration_id = document.createElement('input');
                duration_id.setAttribute('name','duration_id');
                duration_id.setAttribute('type','hidden');
                duration_id.value = durationId;
            let langDesc = document.createElement('input');
                langDesc.setAttribute('name','jezyk');
                langDesc.setAttribute('type','hidden');
                langDesc.value = languageId;
            let typeA = document.createElement('input');
                typeA.setAttribute('name','rodzaj');
                typeA.setAttribute('type','hidden');
                typeA.value = type;
            let lectorId = document.createElement('input');
                lectorId.setAttribute('name','lectorId');
                lectorId.setAttribute('type','hidden');
                lectorId.value = '{{$lector->id}}';
            let certyficate = document.createElement('input');
                certyficate.setAttribute('name','cert');
                certyficate.setAttribute('type','hidden');
                certyficate.value = cert;
            let price = document.createElement('input');
                price.setAttribute('name','price');
                price.setAttribute('type','hidden');
                price.value = kwota;
            let LectorType = document.createElement('input');
                LectorType.setAttribute('name','LectorType');
                LectorType.setAttribute('type','hidden');
                LectorType.value = '{{$lector->lector_type_id}}';
            let name = document.createElement('input');
                name.setAttribute('name','name');
                name.setAttribute('required','true');
                name.setAttribute('type','hidden');
                name.value = document.getElementById('NameInd'+ScreenType).value;
            let nip = document.createElement('input');
                nip.setAttribute('name','nip');
                nip.setAttribute('type','hidden');
                nip.value = document.getElementById('NIPInd'+ScreenType).value;
            let city = document.createElement('input');
                city.setAttribute('name','city');
                city.setAttribute('type','hidden');
                city.value = document.getElementById('CityInd'+ScreenType).value;
            let postcode = document.createElement('input');
                postcode.setAttribute('name','postcode');
                postcode.setAttribute('type','hidden');
                postcode.value = document.getElementById('PostCodeInd'+ScreenType).value;
            let street = document.createElement('input');
                street.setAttribute('name','street');
                street.setAttribute('type','hidden');
                street.value = document.getElementById('AdressInd'+ScreenType).value;
           
                form.innerHTML ='@csrf';

                form.appendChild(start);
                form.appendChild(godzina);
                form.appendChild(duration_id);
                form.appendChild(lectorId);
                form.appendChild(typeA);
                form.appendChild(langDesc);
                form.appendChild(certyficate);
                form.appendChild(LectorType);
                form.appendChild(price);

                
                form.appendChild(name);
                form.appendChild(nip);
                form.appendChild(city);
                form.appendChild(postcode);
                form.appendChild(street);
                // alert(dw);
                
                if(dw >= 1){
                    form.setAttribute('action',"{{ route('useLessons') }}");
                    document.getElementById('FormDiv').appendChild(form);
                    form.submit();
                }
                else{
                     if(name.value == ''){
                        alert('Prosimy o wypełnienie pola imię');
                        document.getElementById('NameInd'+ScreenType).focus();
                    }
                    else if(city.value == ''){
                        alert('Prosimy o wypełnienie pola miasto');
                        document.getElementById('CityInd'+ScreenType).focus();
                    }
                    else if(postcode.value == ''){
                        alert('Prosimy o wypełnienie pola kod pocztowy');
                        document.getElementById('PostCodeInd'+ScreenType).focus();
                    }
                    else if(street.value == ''){
                        alert('Prosimy o wypełnienie pola ulica');
                        document.getElementById('AdressInd'+ScreenType).focus();
                    }
                    else{
                        document.getElementById('FormDiv').appendChild(form);
                        form.submit();
                    }    
                }

               
    }
    function BuyCyklLesson(){
           
        // let Savedhour,less60,less90,dzienNazwa,ZajeciaData,ScreenType;
               // packetAmount
            let durationId = document.getElementById('LessonDurationCykl'+ScreenType).value ;
            let cert = document.getElementById('LessonCertyficateCykl'+ScreenType).value;
            let type = document.getElementById('LessonTypeCykl'+ScreenType).value;
            let languageId = document.getElementById('LessonLanguageCykl'+ScreenType).value;

            // let dostepneLekcje = checkLessonAmount(type,'{{$lector->lector_type_id}}',cert);

            let form = document.createElement('form');
                form.setAttribute('method','POST');
                form.setAttribute('action',"{{ route('buyLesson') }}");
            let start = document.createElement('input');
                start.setAttribute('name','data');
                start.setAttribute('type','hidden');
                start.value = ZajeciaData;
            let godzina = document.createElement('input');
                godzina.setAttribute('name','godzina');
                godzina.setAttribute('type','hidden');
                godzina.value = Savedhour;
            let duration_id = document.createElement('input');
                duration_id.setAttribute('name','duration_id');
                duration_id.setAttribute('type','hidden');
                duration_id.value = durationId;
            let langDesc = document.createElement('input');
                langDesc.setAttribute('name','jezyk');
                langDesc.setAttribute('type','hidden');
                langDesc.value = languageId;
            let typeA = document.createElement('input');
                typeA.setAttribute('name','rodzaj');
                typeA.setAttribute('type','hidden');
                typeA.value = type;
            let lectorId = document.createElement('input');
                lectorId.setAttribute('name','lectorId');
                lectorId.setAttribute('type','hidden');
                lectorId.value = '{{$lector->id}}';
            let ile = document.createElement('input');
                ile.setAttribute('name','ile');
                ile.setAttribute('type','hidden');
                ile.value = document.getElementById('LessonAmountCyklM').value;
            let certyficate = document.createElement('input');
                certyficate.setAttribute('name','cert');
                certyficate.setAttribute('type','hidden');
                certyficate.value = cert;
            let zajecia = document.createElement('input');
                zajecia.setAttribute('name','zajecia');
                zajecia.setAttribute('type','hidden');
                zajecia.value = 0;
            let cykliczne = document.createElement('input');
                cykliczne.setAttribute('name','cykliczne');
                cykliczne.setAttribute('type','hidden');
                cykliczne.value = 1;
            let price = document.createElement('input');
                price.setAttribute('name','price');
                price.setAttribute('type','hidden');
                price.value = kwota;

            let name = document.createElement('input');
                name.setAttribute('name','name');
                name.setAttribute('required','true');
                name.setAttribute('type','hidden');
                name.value = document.getElementById('NameCykl'+ScreenType).value;
            let nip = document.createElement('input');
                nip.setAttribute('name','nip');
                nip.setAttribute('type','hidden');
                nip.value = document.getElementById('NIPCykl'+ScreenType).value;
            let city = document.createElement('input');
                city.setAttribute('name','city');
                city.setAttribute('type','hidden');
                city.value = document.getElementById('CityCykl'+ScreenType).value;
            let postcode = document.createElement('input');
                postcode.setAttribute('name','postcode');
                postcode.setAttribute('type','hidden');
                postcode.value = document.getElementById('PostCodeCykl'+ScreenType).value;
            let street = document.createElement('input');
                street.setAttribute('name','street');
                street.setAttribute('type','hidden');
                street.value = document.getElementById('AdressCykl'+ScreenType).value;
           
                form.innerHTML ='@csrf';

                form.appendChild(start);
                form.appendChild(godzina);
                form.appendChild(duration_id);
                form.appendChild(lectorId);
                form.appendChild(typeA);
                form.appendChild(langDesc);
                form.appendChild(ile);
                form.appendChild(certyficate);
                // form.appendChild(zajecia);
                form.appendChild(cykliczne);
                form.appendChild(price);

                
                form.appendChild(name);
                form.appendChild(nip);
                form.appendChild(city);
                form.appendChild(postcode);
                form.appendChild(street);
                
                
                if(dw >= ile.value){
                    form.setAttribute('action',"{{ route('useLessons') }}");
                    document.getElementById('FormDiv').appendChild(form);
                    form.submit();
                }
                else{
                    if(name.value == ''){
                        alert('Prosimy o wypełnienie pola imię');
                        document.getElementById('NameCykl'+ScreenType).focus();
                    }
                    else if(city.value == ''){
                        alert('Prosimy o wypełnienie pola miasto');
                        document.getElementById('CityCykl'+ScreenType).focus();
                    }
                    else if(postcode.value == ''){
                        alert('Prosimy o wypełnienie pola kod pocztowy');
                        document.getElementById('PostCodeCykl'+ScreenType).focus();
                    }
                    else if(street.value == ''){
                        alert('Prosimy o wypełnienie pola ulica');
                        document.getElementById('AdressCykl'+ScreenType).focus();
                    }
                    else{
                        document.getElementById('FormDiv').appendChild(form);
                        form.submit();
                    }
                    
                }

      
    }
    function checkLessonAmount(type,priceType,cert){
        $.ajax({
        type: "POST",
        url: '../api/checkBank',
        data: {
            type: type, 
            priceType: priceType, 
            user: User,
            cert: cert,
            data: ZajeciaData
            },
        })
        .done(function(data) {
            dw = data;
        })
        .fail(function() {
            alert( "błąd bądź brak lekcji " );
        });
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