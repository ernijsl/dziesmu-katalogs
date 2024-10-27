<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #000000;
        }
        .container{
        height: 100%;
        }
        .welcome{
        position: fixed;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        border-radius: 25px;
        background-color: #363647;
        padding: 40px;
        }
        .btn-reg, .btn-pies {
        margin: 10px;
        }
       
       .formy{
        display: flex;
        justify-content: center;
       }

    </style>
</head>
<body>
@if (Route::has('register'))
    <div class="container justify-content-center h-100">
        <div class="welcome">
            <h1>DZIESMU KATALOGS</h1>
            <h4>Made by</h4>
            <h4>Jānis Cepurītis, Ernests Lejiņš, Raivo Nerets</h4>
            <h4>P2-4</h4>
                
            <div class="container-fluid">
                <form class="d-flex formy" role="search">
                    <a href="{{ route('register') }}" class="btn btn-outline-success btn-reg btn-lg">Reģistrēties</a>

                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-success btn-pies btn-lg">Pieslēgties</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endif
</body>
</html>