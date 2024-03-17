<style>
    .komunikat{
        width: 961px;
        height: 504px;
        border-radius: 16px;
        background: #3C0079;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
        position: absolute;
        top: 300px;
        /* left: 50px; */
        overflow: hidden;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        z-index: 30;
    }
    .komunikatBody{
        display: flex;
        width: 961px;
        height: 422px;
        padding: 10px;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
        gap: 24px;
        flex-shrink: 0;
        background: #F8FAFC;
        border-radius: 0px 0px 16px 16px;
    }
    .komunikatPasek{
        width: 961px;
        height: 82px;
        display: flex;
        justify-content: end;
        align-items: center;
    }
    .komunikatFlagi{
        display: flex;
        flex-flow: row;
        position: absolute;
        top: -40px;
        left: 6px;
    }
    .flags1{
        display: flex;
        flex-flow: column;
        gap: 10px;
    }
    .flagaK{
        width: 170px;   
    }
    .flags2{
        margin-top: -50px;
    }
    .violet{
        color: #3C0079;
        font-weight: bold;
    }
    .pink{
        color: #C75470;
        font-weight: bold;
    }
    .komB{
        margin-left: 405px;
        padding: 0 40px;
        display: flex;
        flex-flow: column;
        gap: 11px;
    }
    .komZam{
        background-color: white;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        margin-right: 10px;
        font-size: 24px;
    }
    .komHead{
            line-height: normal;
        }
        .lineDesktop{

        }
    @media (max-width:960px) { 
        .komunikatFlagi{
            display: none;
        }
        .lineDesktop{
            display: none;
        }
        .komunikat{
            width: 101%;
            height: fit-content;
            top: 500px;
        }
        .komunikatBody{
            width: 100%;
            align-items: center;
            height: fit-content;
        }
        .komunikatPasek{
            width: 100%;
        }
        .komB{
            margin-left: 0px;
            padding: 0;
            width: 275px;
        }
        
    }
</style>
<div class="komunikat" id="komunikatLL">
    <div class="komunikatFlagi">
        <div class="flags1">
            <img class="flagaK" src="{{asset('images/flags/tr.svg')}}">
            <img class="flagaK" src="{{asset('images/flags/es.svg')}}">
            <img class="flagaK" src="{{asset('images/flags/uk.svg')}}">
            <img class="flagaK" src="{{asset('images/flags/no.svg')}}">
        </div>
        <div class="flags1 flags2">
            <img class="flagaK" src="{{asset('images/flags/pt.svg')}}">
            <img class="flagaK" src="{{asset('images/flags/fr.svg')}}">
            <img class="flagaK" src="{{asset('images/flags/de.svg')}}">
            <img class="flagaK" src="{{asset('images/flags/it.svg')}}">
        </div>
    </div>
    <div class="komunikatPasek">
        <button class="btn komZam" onClick="CloseLF()">x</button>
    </div>
    <div class="komunikatBody">
        <div class="komB">
            <div style="font-size: 26px" class="KomHead">
            Zapisz się do naszego newslettera, 
aby             otrzymać <span class="pink">10% zniżki</span> na Twoje pierwsze zajęcia grupowe! Zapisy już ruszyły!</span>
            </div>
            <div style="font-size: 16px;">
                Dla subskrybentów przygotowaliśmy także <span class="violet">darmowe porady językowe i priorytetowy dostęp</span> do webinarów!
            </div>
            <div class="input-group mb-3" style="font-size: 16px;">
                <input type="text" style="border-radius: 15px 0 0 15px" class="form-control" placeholder="Twój email" id="newsKomMail" aria-label="Adres email" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn" style="background-color: #3C0079;border-radius: 0 15px 15px 0; color: white" type="button" onclick="SignInN2()">Zapisz się</button>
                </div>
            </div>
        </div>
       
    </div>
    
</div>
<script>
    checkKom();
    function checkKom(){
       let session = "{{Session::getId()}}";
       let kom = localStorage.getItem("komunikat");
       if(kom == session){
            document.getElementById('komunikatLL').style.display = 'none';
       }
    }
   function CloseLF(){
        document.getElementById('komunikatLL').style.display = 'none';
        let session = "{{Session::getId()}}";
        localStorage.setItem("komunikat", session);
        console.log(session);
    }
</script>