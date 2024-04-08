<head>
    <link href="{{ asset('css/app.css?n=1.8') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;800&display=swap" rel="stylesheet"> 
</head>
<style>
    .body{
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
    }
    h1{
        color: #3C0079;
        text-align: center;
        font-family: Montserrat;
        font-size: 96px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }
</style>
<div>
 <img src="{{ $message->embed(public_path('images/mail/tlo1.png')) }}" alt="Image 1">
 <img src="{{ $message->embed(public_path('images/mail/flag.png')) }}" alt="Image 2" style="position: absolute; top: 0; left:0 ">
 <h1 style="margin-top: -200px">TEKST 1</h1>
</div>
<!-- <div>
 <img src="{{ asset('images/mail/tlo1.png') }}" alt="Image 1">
 <img src="{{ asset('images/mail/flag.png') }}" alt="Image 2" style="position: absolute; top: 0; left:0">
</div> -->
