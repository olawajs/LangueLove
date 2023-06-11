@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card classicDIV">
                <h3 class='logLabel'>{{ __('Rejestracja') }}</h3>
                <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Imię i nazwisko') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Hasło') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Potwierdż hasło') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                        <div class="col-md-3 "></div>
                            <div class="col-md-1 " style="display: flex; justify-content: end; align-items: center;">
                            <div class="con-like">
                                <input title="like" type="checkbox" class="like" required>
                                <div class="checkmark">
                                    <svg viewBox="0 0 24 24" class="outline" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path>
                                    </svg>
                                    <svg viewBox="0 0 24 24" class="filled" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"></path>
                                    </svg>
                                    <svg class="celebrate" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                                    <polygon points="10,10 20,20" class="poly"></polygon>
                                    <polygon points="10,50 20,50" class="poly"></polygon>
                                    <polygon points="20,80 30,70" class="poly"></polygon>
                                    <polygon points="90,10 80,20" class="poly"></polygon>
                                    <polygon points="90,50 80,50" class="poly"></polygon>
                                    <polygon points="80,80 70,70" class="poly"></polygon>
                                    </svg>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                Oświadczam że zapoznałem się z <a href="{{ asset('files/LangueLove Regulamin.pdf') }}" >Regulaminem</a> i <a  href="{{ asset('files/Polityka prywatności LangueLove.pdf') }}">Polityką prywatności</a>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-secondary" style="width: 100%;">
                                    {{ __('Zarejestruj się') }}
                                </button>
                            </div>
                        </div>
                        <!-- Google -->
                        <div class="form-group row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <a href="/login/google" class="btn btn-primary"style="width: 100%;" >
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAAABmJLR0QA/wD/AP+gvaeTAAAC6klEQVRIie2Sy0tUURzHv78zd0at7DFqqJM2VGCYhOCjBntMRKUuatPrDygqiNy0yI1YpESbwFYtqpUUuCoKpSATmikfYC8DZaDM0YnCZz5mnHPPr0VzdZxxdCojAr9w4d57vuf7+Z3vvcCy/ndR+MOL3NxtQtezFODa1d39/U+C+UVOsgwmlCiT/jlhT9cH470wbtxbt9YKpd6DqFEQedw5OaW/Cws2by+V0uIBcaNQoivYnHfVWCMAaMvLy5JS9mLuidliMlUVpKVdo+fPZVyncjo1/5nhS1qGuhKZpTFl0763XgEAUspNEQYAIJOgE77AhMu3c6d9MVifw2EbCEw8U6M4Pl+WZN4MhCqlaAMAQBBZGShWQm/vKyksjwXzOor2C8gOALuVn1LmNRHTDPBR7hGlhDYUBQSsAABGqlD0yOsoqmWnUzPW2enUvI6iWgKeAkgHAATIGpmjGIMPJ61qBlhfdF6cPXbf6knLGQw3MoHDZySg0qjYqJCASoQ3RKzCMwaUpe/0mH313WmrmAECwFjSOlSV3Ux5kHdyBIAOAErxSOS0DBQr0tsEZCeA3VHVmTFqWJsCa/wVYxuyhpTJHNZa2NGFCfcKT6+tOXh9UgptkIEoYEhpoStKIpGHg0wjNd8zp25NpiZKnvt7iPk2vcssSL5wtD5xeFV6fwxgTPlGLb5zYxsTOmTSinkHirVxaEXqylOH7/SA6DJCFS8iBqPu4paMnkFlSopligkEgCCZ2OZuq2YhDhDgW8D6jYBy26v2CqmRWsC3MNDQBldrsyBzPghPI9cYaNGFzM982d4UT1ZcQABId7u/ZtrsZWEVMxh1X6bVgWxX50C8OdrilllRQ4MOoLp/R6ELAGytHVEnXlKgod8BGYq70qWSAADFIvjXQeonQwDA1LT5DRi9fwvGwCf/qvHXQOgbfqteP26/8TFfD1j2ErNlZiqQ51fDBfFtXYmW2QxMa8Qtjw89mViK4Zf17/UDCt4UVR0zYY8AAAAASUVORK5CYII="> Zaloguj się z Google
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
