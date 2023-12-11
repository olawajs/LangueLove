<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/logo_Pasek.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js?v=1') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css?n=7') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <!-- Datatables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> 
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <meta property="og:image" content="{{ asset('images/logoSmall.png') }}" />
    <!-- Calendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-M6Z8GWFZ');</script>
    <!-- End Google Tag Manager -->

</head>
<body>
    <div class="wrapper">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('images/logoSmall.png') }}" height="40" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">  
                            <li class="nav-item consultation">
                                <a class="nav-link navPurpleButton"  href="{{ route('consultation') }}">Darmowa konsultacja</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('priceList') }}">Cennik</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('forCompanies') }}">Dla firm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">O nas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact') }}">Kontakt</a>
                            </li>
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Logowanie') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Rejestracja') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @if (Auth::user()->user_type == 1)
                                            <a class="dropdown-item" href="{{ route('languages') }}">
                                                {{ __('Języki') }}
                                            </a> 
                                            <a class="dropdown-item" href="{{ route('prices') }}">
                                                {{ __('Cennik i Pakiety') }}
                                            </a> 
                                            <a class="dropdown-item" href="{{ route('lessons') }}">
                                                {{ __('Zajęcia') }}
                                            </a> 
                                            <a class="dropdown-item" href="{{ route('lectors') }}">
                                                {{ __('Lektorzy') }}
                                            </a> 
                                            <a class="dropdown-item" href="{{ route('addLesson') }}">
                                                {{ __('Lekcje') }}
                                            </a> 
                                            <a class="dropdown-item" href="{{ route('database') }}">
                                                {{ __('Baza danych') }}
                                            </a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('myAccount') }}">
                                            {{ __('Moje konto') }}
                                        </a> 
                                        <a class="dropdown-item" href="{{ route('toAccept') }}">
                                            {{ __('Oczekujące zajęcia') }}
                                        </a> 
                                        <a class="dropdown-item disabled" disabled>
                                           Lekcji do wykorzystania:  {{App\Models\LessonsBank::where('user_id',Auth::user()->id)->whereNull('use_date')->where('overdue_date','>=',\Carbon\Carbon::today())->count()}}
                                        </a> 
                                        <a class="dropdown-item" href="{{ route('myCalendar') }}">
                                            {{ __('Mój kalendarz') }}
                                        </a> 
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Wyloguj się ') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="">
                @yield('content')
            </main>
        </div>
       
    </div>
    @include('layouts.blackfriday')
    @include('layouts.foot')
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M6Z8GWFZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>
