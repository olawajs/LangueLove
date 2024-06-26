 <nav class="navbar navbar-expand-md">
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
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('priceList') }}">Cennik</a>
                            </li> -->
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