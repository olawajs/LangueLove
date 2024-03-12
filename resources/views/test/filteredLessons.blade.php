@extends('layouts.app')
@section('content')
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
    nav{
        background-color:var(--langue-love-beige);
    }
    .text-container {
        overflow: hidden;
        transition: max-height 0.3s ease-in-out;
    }

.text-container.expanded {
  max-height: none;
}

.toggleButton {
    color: var(--LangueLove-purple, #3C0079);
    font-family: Montserrat;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: 24px;
    cursor: pointer;
}
.expanded > .LectorDesc{
    height: fit-content;
}
</style>
<div id="container" class=" Desktop">
    <div class="container" style = "position: sticky;  top: 0;">
    <div class="row justify-content-center">
        <div class="filteredInputs" style="padding: 20px 120px;">
                <div class="SearchBox" style="matgin-bottom: 0px">
                    <div>
                        <h1 class="BoldText">Ucz się języków i <span class="underlinePink">odkrywaj świat!</span></h1>
                    </div>
                    <div>
                        <h3 style="font-size: 16px;">Gdzie chcesz i kiedy chcesz! Zacznij już dziś!</h3>
                    </div>
                </div>
                <div class="col-md-8 m-3"> 
                    <form method="POST" action="{{ route('search') }}">
                        @csrf
                        <div style="display: flex;  align-items: flex-start;  gap: 32px;">
                            <div class="SearchContainer">
                                <div class="SearchButton">
                                    <button class="btn" type="button" id="language" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;  text-align: left;">
                                                <span class="SearchCat">Język</span><br>
                                                <div style="display: flex;  justify-content: space-between;"><span class="SearchChosen" id="langTextD">Dowolny</span><img src="{{asset('images/svg/arrowDown.svg')}}"></div>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="language" style="width: min-content">
                                        <div class="row checkRow">
                                            <div class="inputDiv">
                                                <input type="checkbox" class="inputs langInpD" id="lang0D" name="lang[]" value="0" checked> <label for="lang0D">Dowolny</label>
                                            </div>
                                            @foreach ($languages as $language)
                                                <div class="inputDiv">
                                                    <input type="checkbox" class="inputs langInpD" name="lang[]" id="lD{{$language->id}}" value="{{$language->id}}"> <label for="lD{{$language->id}}">{{$language->name}}</label>
                                                </div>
                                            @endforeach
                                        </div>                        
                                    </ul>
                                </div>
                                <div style="border-left: 1px solid #CDCDCD;  width: 1px;  height: 38px;"></div>
                                <div class="SearchButton">
                                    <button class="btn" type="button" id="course" data-bs-toggle="dropdown"  aria-expanded="false"  style="width: 100%;  text-align: left;">
                                                <span class="SearchCat">Rodzaj kursu</span><br>
                                                <div style="display: flex;  justify-content: space-between;"><span class="SearchChosen" id="typeTextD">Dowolny </span><img src="{{asset('images/svg/arrowDown.svg')}}"></div>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="course" style="width: min-content">
                                        <div class="row checkRow">
                                            <div class="inputDiv">
                                                <input type="checkbox" class="inputs typeInpD" id="type0D" name="type[]" value="0" checked> Dowolny
                                            </div>
                                            @foreach ($types as $type)
                                                <div class="inputDiv">
                                                    <input type="checkbox" class="inputs typeInpD" id="tD{{$type->id}}"  name="type[]" value="{{$type->id}}"> <label for="tD{{$type->id}}">{{$type->name}}</label>
                                                </div>
                                            @endforeach
                                        </div>      
                                    </ul>
                                </div>
                            </div>
                             <div class="" style="position: relative">
                                <button class="btn LL-button LL-button-primary" type="submit" style="width: 100%;white-space: nowrap;">Szukaj zajęć</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
        
            <!-- <div class="card">
                <div class="card-body">
                    
                </div>
            </div> -->
        
    </div>
    <div class="content" style="padding: 0 120px;display: flex;flex-flow: column;gap: 32px;">
        <h2>Wybierz spośród {{$lectors->count()}} @if($lessons->count() == 1) lektora @else lektorów @endif i {{$lessons->count()}} @if($lessons->count() == 1) kursu @else kursów @endif</h2>
        @foreach ($lessons as $lesson)

            <div class="SearchLesson">
                <div class="SearchLesson2">
                    <div style="display: flex;flex-flow: column;gap: 6px; width: 75%;justify-content: space-between;">
                        <div>
                            <h2>{{$lesson->title}}<span style="font-size: 14px; font-weight: 400; margin-left: 16px;white-space: nowrap;"> <img src="{{asset('images/flags/'.App\Models\Language::find($lesson->language_id)->short.'.svg')}}" style="height: 20px;">  język {{App\Models\Language::find($lesson->language_id)->name}}</span></h2>
                        </div>
                        <div>
                           <b>Czas trwania: </b>    
                            @foreach (App\Models\CalendarEvent::where('lesson_id',$lesson->id)->orderBy('start', 'desc')->take(1)->get() as $date)
                                {{ \Carbon\Carbon::parse($date->start)->format('d.m')}}
                            @endforeach 
                             - 
                             @foreach (App\Models\CalendarEvent::where('lesson_id',$lesson->id)->orderBy('start', 'asc')->take(1)->get() as $date)
                               {{ \Carbon\Carbon::parse($date->start)->format('d.m')}}
                            @endforeach 
                        </div>
                        <div>
                           <b>Ilość spotkań: </b> {{$lesson->amount_of_lessons}}
                        </div>
                        <div>
                           <b>Ilość osób w grupie: </b> {{$lesson->amount_of_students}}
                        </div>
                        <div>
                        <img src="{{asset('images/lectors/'.App\Models\Lector::find($lesson->lector_id)->photo)}}" style="width: 48px; height: 48px; margin-right: 16px"> {{ App\Models\Lector::find($lesson->lector_id)->name}}
                        </div>
                    </div>
                    <div style="width: 25%;display: flex;flex-flow: column;gap: 16px;justify-content: space-evenly;  align-items: end;">
                        <div class="textSearchV"> 
                            <img src="{{asset('images/svg/calendar-clock.svg')}}">
                            
                            @foreach (App\Models\CalendarEvent::where('lesson_id',$lesson->id)->orderBy('start', 'asc')->take(1)->get() as $date)
                               {{ \Carbon\Carbon::parse($date->start)->locale('pl')->dayName}} {{ \Carbon\Carbon::parse($date->start)->format('H:i')}}
                            @endforeach 
                        </div>
                        <div class="piggySearch">
                           <img src="{{asset('images/svg/piggy.svg')}}"> {{$lesson->price * $lesson->amount_of_lessons}} pln
                        </div>
                        <a class="LL-button LL-button-primary" href="{{ route('showLesson',$lesson->id) }}">@if($lesson->type_id == 3) Zobacz webinar @else Zobacz kurs @endif</a>
                    </div>  
                </div>
                
                <div style="width: 25%; display: flex;  justify-content: end;">
                    <img src="https://languelove.pl/images/lessons/{{$lesson->photo}}" onerror="this.onerror=null;this.src='https://languelove.pl/images/lectors/{{ App\Models\Lector::find($lesson->lector_id)->photo}}';" style='height: 324px; object-fit: cover;width: 100%; border-radius: 0 16px 16px 0;'>
                </div>
            </div>
          
        @endforeach
        @foreach ($lectors as $l)
            <div class="SearchLektor">
                <div style="width: 25%">
                    <img src="/images/lectors/{{$l->photo}}" style='max-width:238px; max-height: 238px; object-fit: cover;'>
                </div>
                <div style="flex-grow: 2;display: flex;flex-flow: column;gap: 16px; width: 50%">
                    <div>
                        <h2>{{$l->name}}</h2>
                    </div>
                    <div class="bubbleInfo">
                        @foreach (App\Models\LanguageLevel::where('lector_id',$l->id)
                                        ->where('level', 'like', '%-%')
                                        ->get() as $d)
                            <span class=""><img src="{{asset('images/flags/'.App\Models\Language::find($d->language_id)->short.'.svg')}}"> język {{App\Models\Language::find($d->language_id)->name}} <span style="color: #969696; font-weight: bold;">{{ $d->level}}</span></span>
                        @endforeach
                    </div>
                    <div class="bubbleInfo">
                        @foreach (App\Models\LanguageLevel::select('level')->where('lector_id',$l->id)
                                        ->where('level', 'not like', '%-%')
                                        ->distinct()
                                        ->get() as $d)
                                <span class="TopicBubble">{{$d->level}}</span>
                        @endforeach
                    </div>
                    <div>
                        <div class="text-container" id="container{{$l->id}}">
                            <div class="LectorDesc textTest">
                                {!!$l->description!!}
                            </div>
                            <span class="toggleButton">czytaj więcej</button>
                        </div>
                            
                    </div>
                </div>
                <div style="width: 25%;display: flex;flex-flow: column;gap: 16px;margin-top: 52px;">
                    <a class="LL-button LL-button-primary" href="{{ route('showLector',$l->id) }}">Zobacz kalendarz</a>
                    <a class="LL-button LL-button-primary3" onClick="OpenPriceTableId(event,{{$l->id}})">Zobacz cennik</a>
                </div>
            </div>
              <!-- Cennik  -->
          

        @endforeach
    </div>
    
</div>
</div>

<div id="container" class="mobile">
    <div class="container" style = "position: sticky;  top: 0;">
    <div class="row justify-content-center">
        <div class="filteredInputs" style="padding: 20px 16px;">
            <div class="SearchBox">
                    <div>
                        <h1 class="BoldText">Ucz się języków i <span class="underlinePink">odkrywaj świat!</span></h1>
                    </div>
                    <div>
                        <h3 style="font-size: 16px;">Gdzie chcesz i kiedy chcesz! Zacznij już dziś!</h3>
                    </div>
                </div>
                <div class="col-md-8"> 
                    <form method="POST" action="{{ route('search') }}">
                        @csrf
                        <div style="display: flex;  align-items: flex-start;  gap: 12px;flex-flow: column;">
                            <div class="SearchContainer">
                            <div class="SearchButton">
                                    <button class="btn" type="button" id="language" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;  text-align: left;">
                                                <span class="SearchCat">Język</span><br>
                                                <div style="display: flex;  justify-content: space-between;"><span class="SearchChosen" id="langTextM">Dowolny</span><img src="{{asset('images/svg/arrowDown.svg')}}"></div>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="language" style="width: min-content">
                                        <div class="row checkRow">
                                            <div class="inputDiv">
                                                <input type="checkbox" class="inputs langInpM" id="lang0M" name="lang[]" value="0" checked> <label for="lang0M">Dowolny</label>
                                            </div>
                                            @foreach ($languages as $language)
                                                <div class="inputDiv">
                                                    <input type="checkbox" class="inputs langInpM" id="tlM{{$language->id}}" name="lang[]" value="{{$language->id}}"> <label for="tlM{{$language->id}}">{{$language->name}}</label>
                                                </div>
                                            @endforeach
                                        </div>                        
                                    </ul>
                                </div>
                            </div>
                            <div class="SearchContainer">
                            <div class="SearchButton">
                                    <button class="btn" type="button" id="course" data-bs-toggle="dropdown"  aria-expanded="false"  style="width: 100%;  text-align: left;">
                                                <span class="SearchCat">Rodzaj kursu</span><br>
                                                <div style="display: flex;  justify-content: space-between;"><span class="SearchChosen" id="typeTextM">Dowolny </span><img src="{{asset('images/svg/arrowDown.svg')}}"></div>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="course" style="width: min-content">
                                        <div class="row checkRow">
                                            <div class="inputDiv">
                                                <input type="checkbox" class="inputs typeInpM" id="type0M" name="type[]" value="0" checked> <label for="type0M">Dowolny </label>
                                            </div>
                                            @foreach ($types as $type)
                                                <div class="inputDiv">
                                                    <input type="checkbox" class="inputs typeInpM" name="type[]" id="ttM{{$type->id}}" value="{{$type->id}}"> <label for="ttM{{$type->id}}">{{$type->name}} </label>
                                                </div>
                                            @endforeach
                                        </div>      
                                    </ul>
                                </div>
                            </div>
                             <div class="" style="position: relative;width: 100%;">
                                <button class="btn btn-black" type="submit" style="width: 100%;white-space: nowrap;">Szukaj zajęć</button>
                                <!-- <img style="position: absolute;  top: 13px;  width: 100%;  left: 26px;" src="{{asset('images/svg/arrowZigZag.svg')}}"> -->
                            </div>
                        </div>
                        
                        
                    </form>
                   
                </div>
            </div>
        </div> 
        
    </div>
    <div class="content" style="padding: 0 16px; display: flex;flex-flow: column;gap: 32px;">
        <h2>Wybierz spośród {{$lectors->count()}} @if($lessons->count() == 1) lektora @else lektorów @endif i {{$lessons->count()}} @if($lessons->count() == 1) kursu @else kursów @endif</h2>
        @foreach ($lessons as $lesson)
            <div class="MobileCard">
                <div>
                    <img src="https://languelove.pl/images/lessons/{{$lesson->photo}}" onerror="this.onerror=null;this.src='https://languelove.pl/images/lectors/{{ App\Models\Lector::find($lesson->lector_id)->photo}}';" style='height: 238px; object-fit: cover;width: 100%; border-radius: 16px 16px 0 0;'>
                </div>
                <div style="padding: 24px;display: flex;flex-flow: column;gap: 16px;">
                    <div>
                        <h2>{{$lesson->title}}</h2>
                    </div>
                    <div>
                        <span style="font-size: 14px;"> <img src="{{asset('images/flags/'.App\Models\Language::find($lesson->language_id)->short.'.svg')}}" style="height: 20px;">  język {{App\Models\Language::find($lesson->language_id)->name}}</span>
                    </div>
                    <div>
                        <div>
                            <b>Czas trwania: </b>    
                                @foreach (App\Models\CalendarEvent::where('lesson_id',$lesson->id)->orderBy('start', 'asc')->take(1)->get() as $date)
                                    {{ \Carbon\Carbon::parse($date->start)->format('d.m')}}
                                @endforeach 
                                - 
                                @foreach (App\Models\CalendarEvent::where('lesson_id',$lesson->id)->orderBy('start', 'desc')->take(1)->get() as $date)
                                {{ \Carbon\Carbon::parse($date->start)->format('d.m')}}
                                @endforeach 
                        </div>
                        <div> 
                            <b>Ilość spotkań: </b> {{$lesson->amount_of_lessons}}
                        </div>
                        <div>
                            <b>Ilość osób w grupie: </b> {{$lesson->amount_of_students}}
                        </div>
                    </div>
                    
                    <div>
                        <img src="{{asset('images/lectors/'.App\Models\Lector::find($lesson->lector_id)->photo)}}" style="width: 48px; height: 48px; margin-right: 16px"> {{ App\Models\Lector::find($lesson->lector_id)->name}}
                    </div>
                    <div class="textSearchV"> 
                        <img src="{{asset('images/svg/calendar-clock.svg')}}">
                        
                        @foreach (App\Models\CalendarEvent::where('lesson_id',$lesson->id)->orderBy('start', 'asc')->take(1)->get() as $date)
                            {{ \Carbon\Carbon::parse($date->start)->locale('pl')->dayName}} {{ \Carbon\Carbon::parse($date->start)->format('H:i')}}
                        @endforeach 
                    </div>
                    <div class="piggySearch" style="width: 100%;">
                        <img src="{{asset('images/svg/piggy.svg')}}"> {{$lesson->price * $lesson->amount_of_lessons}} pln
                    </div>
                    <a class="LL-button LL-button-primary" href="{{ route('showLesson',$lesson->id) }}">@if($lesson->type_id == 3) Zobacz webinar @else Zobacz kurs @endif </a>

                </div>
                
            </div>
        @endforeach
        @foreach ($lectors as $l)
            <div class="SearchLektor">
                <div>
                    <img src="/images/lectors/{{$l->photo}}" style='max-width:238px; max-height: 238px; object-fit: cover;'>
                </div>
                <div style=";display: flex;flex-flow: column;gap: 16px;">
                    <div>
                        <h2>{{$l->name}}</h2>
                    </div>
                    <div class="bubbleInfo">
                        @foreach (App\Models\LanguageLevel::where('lector_id',$l->id)
                                        ->where('level', 'like', '%-%')
                                        ->get() as $d)
                            <span class=""><img src="{{asset('images/flags/'.App\Models\Language::find($d->language_id)->short.'.svg')}}"> język {{App\Models\Language::find($d->language_id)->name}} <span style="color: #969696; font-weight: bold;">{{ $d->level}}</span></span>
                        @endforeach
                    </div>
                    <div class="bubbleInfo">
                        @foreach (App\Models\LanguageLevel::select('level')->where('lector_id',$l->id)
                                        ->where('level', 'not like', '%-%')
                                        ->distinct()
                                        ->get() as $d)
                                <span class="TopicBubble">{{$d->level}}</span>
                        @endforeach
                    </div>
                    <div>
                        <div class="text-container" id="container{{$l->id}}">
                            <div class="LectorDesc textTest">
                                {!!$l->description!!}
                            </div>
                            <span class="toggleButton">czytaj więcej</button>
                        </div>
                            
                    </div>
                </div>
                <div style="display: flex;flex-flow: column;gap: 16px; width: 100%">
                    <a class="LL-button LL-button-primary" href="{{ route('showLector',$l->id) }}">Zobacz kalendarz</a>
                    <a class="LL-button LL-button-primary3" onClick="OpenPriceTableId(event,{{$l->id}})">Zobacz cennik</a>
                </div>
            </div>
              <!-- Cennik  -->
          

        @endforeach
    </div>
    
</div>
</div>


@foreach($lectors as $l)

<div class="PriceTable" id="PriceTable{{$l->id}}">
                    <div class='desktop'>
                        <div class="DivHead">
                            <span class="HeadText">Cennik</span>
                            <button class="btn XButton" onClick="closePriceTableId({{$l->id}})">
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
                                    <div class="PriceBubble purpleBubble">{{App\Models\LectorPrices::where('type_id',1)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certification',0)->first()->price}} zł</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                                </div>  
                            @endforeach
                            @foreach($durations as $d)
                                <div class="PriceColumn" style="display: none" id="Par1">
                                    <div class="priceText">{{($d->duration)-5}} min</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\LectorPrices::where('type_id',4)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certification',0)->first()->price}} zł</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                                </div>  
                            @endforeach
                            
                            
                            @foreach($durations as $d)
                                <div class="PriceColumn" id="Ind2">
                                    <div class="priceText"><img src="{{asset('images/svg/badge 1.svg')}}">{{($d->duration)-5}} min</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\LectorPrices::where('type_id',1)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certification',1)->first()->price}} zł</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                                </div>
                            @endforeach
                            @foreach($durations as $d)
                                <div class="PriceColumn" style="display: none"  id="Par2">
                                    <div class="priceText"><img src="{{asset('images/svg/badge 1.svg')}}">{{($d->duration)-5}} min</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\LectorPrices::where('type_id',4)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certification',1)->first()->price}} zł</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',4)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',4)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',4)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class='mobile mobileFlex' style="width: 100%;">
                        <div class="DivHead">
                            <span class="HeadText">Cennik</span>
                            <button class="btn XButton" onClick="closePriceTableId({{$l->id}})">
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
                                    <div class="PriceBubble purpleBubble">{{App\Models\LectorPrices::where('type_id',1)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certification',0)->first()->price}} zł</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',1)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
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
                                    <div class="PriceBubble purpleBubble">{{App\Models\LectorPrices::where('type_id',4)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certification',0)->first()->price}} zł</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
                                    <div class="PriceBubble purpleBubble">{{App\Models\Packet::where('type_id',4)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',0)->first()->price}} zł</div>
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
                                    <div class="PriceBubble pinkBubble">{{App\Models\LectorPrices::where('type_id',1)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certification',1)->first()->price}} zł</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',1)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
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
                                    <div class="PriceBubble pinkBubble">{{App\Models\LectorPrices::where('type_id',4)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certification',1)->first()->price}} zł</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',4)->where('amount',5)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',4)->where('amount',10)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                                    <div class="PriceBubble pinkBubble">{{App\Models\Packet::where('type_id',4)->where('amount',30)->where('duration_id',$d->id)->where('lector_type_id',$l->lector_type_id)->where('certyficate',1)->first()->price}} zł</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
@endforeach
@endsection



<script src="https://code.jquery.com/jquery-3.5.1.js"></script> 

<script>
document.addEventListener('DOMContentLoaded', function () {
  const textContainers = document.querySelectorAll('.text-container');

  textContainers.forEach(function (container) {
    const toggleButton = container.querySelector('.toggleButton');

    toggleButton.addEventListener('click', function () {
      container.classList.toggle('expanded');
      
      if (container.classList.contains('expanded')) {
        toggleButton.textContent = 'Pokaż mniej';
      } else {
        toggleButton.textContent = 'Pokaż więcej';
      }
    });
  });
});
    $(document).ready(function () {
        
        $('.langInpD').click(function() {
            check(event,1);
        });
        $('.typeInpD').click(function() {
            check(event,2);
        });
        $('.langInpM').click(function() {
            check(event,1);
        });
        $('.typeInpM').click(function() {
            check(event,2);
        });

        function check(e,type) {
            let id ='';
            let class1 = '';
            let text = '';
            if(type == 1){
                id='lang0'+ScreenType;
                class1 = 'langInp'+ScreenType;
                text = 'langText'+ScreenType;
            }
            if(type == 2){
                id='type0'+ScreenType;
                class1 = 'typeInp'+ScreenType;
                text = 'typeText'+ScreenType;
            }
            console.log(text);
            let textSpan = document.getElementById(text);
            if(e.target.value == '0'){
                var anchors = document.getElementsByClassName(class1);
                for(var i = 0; i < anchors.length; i++) {
                    var anchor = anchors[i];
                    anchor.checked = false;
                }
                e.target.checked = true;
                textSpan.innerText = 'Dowolny';
            }
            else{
                document.getElementById(id).checked = false;
                if(textSpan.innerText == 'Dowolny'){
                    textSpan.innerText =  e.target.parentElement.innerText;
                }else{
                    if(!textSpan.innerText.includes("i więcej")){
                        textSpan.innerText += ' i więcej';
                    }
                    
                }
                   
            }

        }
    })
    function OpenPriceTableId(e,id){
        // console.log(event.target.offsetTop)
        document.getElementById('PriceTable'+id).style.display = 'inline-flex';
        document.getElementById('PriceTable'+id).style.top = event.target.offsetTop+'px';

        document.getElementById('container').style.filter = 'blur(15px)';
        // window.scrollTo(0, 0);
    // 
    }
    function closePriceTableId(id){
        document.getElementById('PriceTable'+id).style.display = 'none';
        document.getElementById('container').style.filter = 'blur(0px)';
    // 
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