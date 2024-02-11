<div class="cookies" id="cookies">
    <div class="Desktop">
        <div class="cookieClose">
            <button class="btn XButton closeB" onClick="closeModal('cookies')">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.362686 11.4335L4.68772 7L0.362686 2.56647C0.108271 2.30567 0.108271 1.87892 0.362686 1.61812L1.7504 0.195597C2.00481 -0.065199 2.42113 -0.065199 2.67554 0.195597L7.00058 4.62913L11.3256 0.195597C11.58 -0.065199 12.0195 -0.065199 12.2739 0.195597L13.6385 1.61812C13.8929 1.87892 13.8929 2.30567 13.6385 2.56647L9.31343 7L13.6385 11.4335C13.8929 11.6943 13.8929 12.1448 13.6385 12.4056L12.2739 13.8044C12.0195 14.0652 11.58 14.0652 11.3256 13.8044L7.00058 9.37087L2.67554 13.8044C2.42113 14.0652 2.00481 14.0652 1.7504 13.8044L0.362686 12.4056C0.108271 12.1448 0.108271 11.6943 0.362686 11.4335Z" fill="#2B2B33"/>
                </svg>
            </button>
        </div>
        <div class="cookieBody">
            <img src="{{asset('images/svg/cookie.svg')}}" style="width: 80px;">
            <div style="color: #3C0079; font-weight: bold;">Nasza strona używa plików cookie</div>
            <div class="cookieText">
                My i nasi partnerzy cyfrowi korzystamy z plików cookie na tej stronie internetowej w celu: 
                ulepszania funkcjonalności strony, zapisania Twoich preferencji, analizy ruchu oraz wykorzystywania w celach marketingowych i wyświetlania spersonalizowanych reklam.
                Więcej informacji na temat plików cookies znajdziesz w naszej  <a style="color: #3C0079; font-weight: bold;text-decoration: none;" href="{{ route('polityka') }}">Polityce Prywatności</a>.
            </div>
        </div>
        <div class="cookieBottom">
            <div><button class="btn LL-button LL-button-secondary" style="color: #3C0079;" onClick="saveCookie(0)">Nie zezwalaj</button></div>
            <div><button class="btn LL-button LL-button-primary" onClick="saveCookie(1)"><img src="{{asset('images/svg/cookie.svg')}}" style="width: 16px;" >Akceptuj cookies</button></div>
        </div>
    </div>  
    <div class="mobile">
        <div class="cookieClose">
            <button class="btn XButton closeB" onClick="closeModal('cookies')">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.362686 11.4335L4.68772 7L0.362686 2.56647C0.108271 2.30567 0.108271 1.87892 0.362686 1.61812L1.7504 0.195597C2.00481 -0.065199 2.42113 -0.065199 2.67554 0.195597L7.00058 4.62913L11.3256 0.195597C11.58 -0.065199 12.0195 -0.065199 12.2739 0.195597L13.6385 1.61812C13.8929 1.87892 13.8929 2.30567 13.6385 2.56647L9.31343 7L13.6385 11.4335C13.8929 11.6943 13.8929 12.1448 13.6385 12.4056L12.2739 13.8044C12.0195 14.0652 11.58 14.0652 11.3256 13.8044L7.00058 9.37087L2.67554 13.8044C2.42113 14.0652 2.00481 14.0652 1.7504 13.8044L0.362686 12.4056C0.108271 12.1448 0.108271 11.6943 0.362686 11.4335Z" fill="#2B2B33"/>
                </svg>
            </button>
        </div>
        <div class="cookieBody">
            <img src="{{asset('images/svg/cookie.svg')}}" style="width: 80px;">
            <div style="color: #3C0079; font-weight: bold;">Używamy plików cookie</div>
            <div class="cookieText">
                My i nasi partnerzy cyfrowi korzystamy z plików cookie na tej stronie internetowej w celu: 
                ulepszania funkcjonalności strony, zapisania Twoich preferencji, analizy ruchu oraz wykorzystywania w celach marketingowych i wyświetlania spersonalizowanych reklam.
                Więcej informacji na temat plików cookies znajdziesz w naszej  <a style="color: #3C0079; font-weight: bold;text-decoration: none;" href="{{ route('polityka') }}">Polityce Prywatności</a>.
            </div>
        </div>
        <div class="cookieBottom">
            <div class="w-100"><button class="btn LL-button LL-button-primary w-100" style="height: 30px;" onClick="saveCookie(1)"><img src="{{asset('images/svg/cookie.svg')}}" style="width: 16px;" >Akceptuj cookies</button></div>
            <div class="w-100"><button class="btn LL-button LL-button-secondary w-100" style="color: #3C0079; height: 30px;" onClick="saveCookie(0)">Nie zezwalaj</button></div>
        </div>
    </div> 
</div>
