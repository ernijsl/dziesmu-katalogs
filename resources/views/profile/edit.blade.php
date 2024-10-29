<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mans Profils</title>
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
       .container{
        background-color: #000000;
       }
       .test{
        border-radius: 25px;
        background-color: #363647;
       }
       


    </style>
</head>
<body>
<nav class="navbar">
  <div class="container-fluid d-flex justify-content-center align-items-center">
    @if (Route::has('song.index'))   
      <a href="{{ route('song.index') }}" class="btn btn-outline-danger btn-bac btn-lg">Atpakaļ</a>
    @endif
    <h1 class="mx-auto">Mans Profils</h1>
  </div>
</nav>
<div class="container justify-content-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 test text-white">
            <div class="p-4 sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</body>
</html>