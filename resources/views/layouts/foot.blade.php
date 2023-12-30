<footer class="footer Desktop">

<div class="footNewsletter">
    <div class="footHalf">
        <h2 class="whiteH2">Zostań z nami na dłużej!</h2>
        <p class="footText">Zapisz się do naszego newslettera, aby otrzymać 10% zniżki na zajęcia grupowe i zacznij uczyć się już dziś! Dla subskrybentów przygotowaliśmy także darmowe porady językowe i priorytetowy dostęp do webinarów!</p>
    </div>
    <div class="footHalf" >
        <div class="footInput">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Adres email" id="newsMail" aria-label="Adres email" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-black" type="button" onclick="SignInN()">Zapisz się</button>
                </div>
            
            </div>
        </div>
         <span style="line-height: 20px;font-size: 11px;">Rejestrując się do newslettera akceptujesz <a target="_blank" style="color: white;font-weight: 600;" href="{{ route('polityka') }}">Politykę prywatności.</a></span>
    </div>
</div>
<div class="footLinks">
    <div class="footColumn">
            <span class="listTitle"><b>Pomoc</b></span>
            <a class="footLink" href="{{ route('contact') }}">Kontakt</a>
            <a class="footLink" href="{{ route('FAQ') }}">FAQ</a>
            <a class="footLink" href="{{ route('regulamin') }}">Regulamin</a>
    </div>
    <div class="footColumn">
            <span class="listTitle"><b>LangueLove</b></span>
            <a class="footLink" href="{{ route('about') }}">O nas</a>
            <a class="footLink" href="{{ route('forCompanies') }}">Oferta dla firm</a>
            <a class="footLink" href="{{ route('consultation') }}">Bezpłatne konsultacje</a>
    </div>
    <div class="footColumn">
            <span class="listTitle"><b>Social media</b></span>
            <div class="SocialList">
                <a href="https://www.instagram.com/languelove"><img src="{{asset('images/svg/ig.svg')}}"></a>
                <a href="https://www.facebook.com/LangueLove.szkola"><img src="{{asset('images/svg/fb.svg')}}"></a>
                <a href="https://www.tiktok.com/@languelove_"><img src="{{asset('images/svg/tiktok.svg')}}"></a>
            </div>
    </div>
</div>
<div class="footCE">
   © Langue Love Spółka Cywilna &emsp; | &emsp; <a class="footLink" href="{{ route('polityka') }}">Polityka prywatności</a>
</div>
</footer>
<footer class="footer mobileFoot">
    <div class="MobileCol">
        <div>
            <h2 class="whiteH2">Zostań z nami na dłużej!</h2>
        </div>
        <div>
            <p class="footText">Zapisz się do naszego newslettera, aby otrzymać 10% zniżki na zajęcia grupowe i zacznij uczyć się już dziś! Dla subskrybentów przygotowaliśmy także darmowe porady językowe i priorytetowy dostęp do webinarów!</p>
        </div>
        <div>
            <h2 class="whiteH2">
                <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Adres email" id="newsMail" aria-label="Adres email" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-black" type="button" onclick="SignInN()"><img src="{{asset('images/svg/send.svg')}}"></button>
                </div>
            </div></h2>
        </div>
        <div style="font-size: 11px;">
            Rejestrując się do newslettera akceptujesz <a target="_blank" style="color: white;font-weight: 600;" href="{{ route('polityka') }}">Politykę prywatności.</a>
        </div>
    </div>
    <div class="footLinks" style="padding: 32px 16px">
        <div class="footColumn" style="width: 50%">
                <span class="listTitle"><b>Pomoc</b></span>
                <a class="footLink" href="{{ route('contact') }}">Kontakt</a>
                <a class="footLink" href="{{ route('FAQ') }}">FAQ</a>
                <a class="footLink" href="{{ route('regulamin') }}">Regulamin</a>
        </div>
        <div class="footColumn" style="width: 50%">
                <span class="listTitle"><b>LangueLove</b></span>
                <a class="footLink" href="{{ route('about') }}">O nas</a>
                <a class="footLink" href="{{ route('forCompanies') }}">Oferta dla firm</a>
                <a class="footLink" href="{{ route('consultation') }}">Bezpłatne konsultacje</a>
        </div>
        <div class="footColumn" style="width: 50%; margin-top: 24px">
                <span class="listTitle"><b>Social media</b></span>
                <div class="SocialList">
                    <a href="https://www.instagram.com/languelove"><img src="{{asset('images/svg/ig.svg')}}"></a>
                    <a href="https://www.facebook.com/LangueLove.szkola"><img src="{{asset('images/svg/fb.svg')}}"></a>
                    <a href="https://www.tiktok.com/@languelove_"><img src="{{asset('images/svg/tiktok.svg')}}"></a>
                </div>
        </div>
    </div>
    <div class="footCE" style="padding: 0 16px">
     © Langue Love Spółka Cywilna &emsp; | &emsp; <a class="footLink" href="{{ route('polityka') }}">Polityka prywatności</a>
    </div>

</footer>