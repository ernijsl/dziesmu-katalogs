<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
        background-color: #000000;
        color: white;
       }
       .btn-reg{
        margin: 10px;
       }
       .btn-pies{
        margin: 10px;
    
       }
       .content{
        height: 100%;
        width: 100%;
        
       }
       .div-task{
        border-radius: 25px;
        margin-right: 5px;
        background-color: #363647;
    
        
        
       }
       .div-content{
        background-color:beige;
        border-radius: 25px;
        margin-left: 5px;
        background-color: #363647;
        
       }
       .btn-mansprofils{
        color: white;
        width: 100%;
        height: 50px;
        margin-top: 200px;
        font-size:xx-large;
        border: none;
        background: transparent;
        outline: none;
        cursor: pointer;
        border-radius: 15px;
       }
    
       
       .btn-fav{
        color: white;
        width: 100%;
        height: 50px;
        margin-top: 15px;
        font-size:xx-large;
        border: none;
        background: transparent;
        outline: none;
        cursor: pointer;
        border-radius: 15px;
       }
    
       
       .btn-sett{
        color: white;
        width: 100%;
        height: 50px;
        margin-top: 15px;
        font-size:xx-large;
        border: none;
        background: transparent;
        outline: none;
        cursor: pointer;
        border-radius: 15px;
       }
    
    
       
    
     </style>
</head>
<body>
<nav class="navbar">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <h1>Dziesmu katalogs</h1>
    <form action="{{ route('logout') }}" method="POST" class="ms-auto">
      @csrf
      <button type="submit" class="btn btn-outline-danger btn-reg btn-lg">Izrakstīties</button>
    </form>
  </div>
</nav>

<div class="row h-100 content">
    <div class="h-100 col-lg-2 div-task">
        <div class="container-fluid justify-content-center">
        <a href="{{ route('profile.edit') }}" class=" btn btn-mansprofils fw-bold">MANS PROFILS</a>
        </div>
        <div class="container-fluid justify-content-center">
        <a href="{{ route('song') }}" class=" btn btn-fav fw-bold">PIEVIENOT DZIESMAS</a>
        </div>
        <div class="container-fluid justify-content-center" style="margin-top: 50px">
        <a href="{{ route('zanri') }}" class=" btn btn-fav fw-bold">PIEVIENOT ŽANRU</a>
        </div>
    </div>
    <div class="h-100 col div-content"></div>
</div>
</body>
</html>