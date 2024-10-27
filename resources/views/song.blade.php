<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pievienot dziesmas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #000000;
        }
        .navbar{
        height: 100px;
        color: white;
       }


    </style>
</head>
<body>
<nav class="navbar">
  <div class="container-fluid d-flex justify-content-center align-items-center">
    @if (Route::has('home'))   
      <a href="{{ route('home') }}" class="btn btn-outline-danger btn-bac btn-lg">Atpakaļ</a>
    @endif
    <h1 class="mx-auto">Pievienot dziesmas</h1>
  </div>
</nav>
<div class="container justify-content-center">
    
</div>
</body>
</html>