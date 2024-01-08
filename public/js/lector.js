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
    go();
    console.log(ScreenType);
    $(document).ready(function () {
        
        $(".Paymentcard").each(function(index, value){
            $('.Paymentcard').hide();
        });
         
         console.log('?');
        $(".page-link").on('click', function(){
            
            $(".page-link").each(function(index, value){
                $(value).parent().removeClass("active");
            });

            //Hide all cards
            $(".Paymentcard").each(function(index, value){
                $('.Paymentcard').hide();
            });

            $(this).parent().addClass("active");

            var cardId = "#P" + $(this)[0].attributes.data.value;

            // e.target.attributes.data.value
            console.log(cardId);
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
                    cardId = "#P" + (parseInt(now) + 1);
                    id = parseInt(now) + 1;
                }
                else {
                    cardId =  "#P" +1;
                    id = 1;
                }
            } 
            if (touchendX > touchstartX && Math.abs(roznica)>20) {
                if(now != 1){
                    cardId = "#P" + (parseInt(now) - 1);
                    id = parseInt(now)- 1;
                }
                else {
                    cardId =  "#P" +3;
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
            // let cardId2 =  "#P"+parseInt(now);
            // $(cardId2).hide();
            $('#P'+id).show();
            $('#'+id+'B').parent().addClass("active");
        }
        document.addEventListener('touchstart', e => {
            touchstartX = e.changedTouches[0].screenX;
            roznica = touchstartX - touchendX;
        });

        document.addEventListener('touchend', e => {
            touchendX = e.changedTouches[0].screenX;
            roznica = touchstartX - touchendX;
            if(Math.abs(roznica)>20){
                checkDirection();
            }
            
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
        $('#P1').show();
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

            console.log("Lekcji: "+dw);
        })
        .fail(function() {
            console.log( "błąd bądź brak lekcji " );
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