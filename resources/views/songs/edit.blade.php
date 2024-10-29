<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Song</title>
    @vite(['resources/js/app.js']) <!-- Use Vite to include your JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is included -->
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
       .conters{
        background-color: #363647;
            padding: 20px;
            border-radius: 25px;
            margin-left: 20px;
       }
       .d1,
        .d2,
        .d3,
        .d4,
        .d5 {
            margin: 10px;
        }
        label {
            color: white;
            font: bold;
            font-size: x-large;
            margin-right: 10px;
        }

        input {
            border-radius: 5px;
        }

        select {
            border-radius: 5px;
            height: 30px;
            width: 200px;
        }
        .bn32 {
            border-color: #ffffff;
            padding: 0.6em 2.3em;
            cursor: pointer;
            font-size: 1em;
            color: #ffffff;
            background-image: linear-gradient(45deg, transparent 50%, #000000 50%);
            background-position: 25%;
            background-size: 400%;
            -webkit-transition: background 500ms ease-in-out, color 500ms ease-in-out;
            transition: background 500ms ease-in-out, color 500ms ease-in-out;
            color: #000000;
            border-radius: 20px;
        }

        .bn32:hover {
            color: #ffffff;
            background-position: 100%;
        }


    </style>
</head>
<body>
<nav class="navbar">
  <div class="container-fluid d-flex justify-content-center align-items-center">
    @if (Route::has('song.index'))   
      <a href="{{ route('song.index') }}" class="btn btn-outline-danger btn-bac btn-lg">Atpakaļ</a>
    @endif
    <h1 class="mx-auto">Rediģēt dziesmu</h1>
  </div>
</nav>
<div class="container d-flex justify-content-center">
    <div class="container d-flex justify-content-center conters">
    <div id="error-messages"></div> 

@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p style="color: red;">{{ $error }}</p>
        @endforeach
    </div>
@endif

<form id="edit-song-form" method="post" action="{{ route('song.update', ['song' => $song]) }}">
    @csrf
    @method('put')
    <div class="d1">
        <label for="">Song Name</label>
        <input type="text" name="songName" placeholder="name" value="{{ $song->songName }}" required />
    </div>
    <div class="d2">
        <label for="">Author</label>
        <input type="text" name="author" placeholder="author" value="{{ $song->author }}" required />
    </div>
    <div class="d3">
        <label for="">Song Description</label>
        <input type="text" name="description" placeholder="description" value="{{ $song->description }}" />
    </div>
    <div class="d4">
        <label for="">Genre</label>
        <select name="genre_id" required>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ $song->genre_id == $genre->id ? 'selected' : '' }}>
                    {{ $genre->genreName }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="d5">
    <a href="/"><button class="bn-32 bn32" type="submit">Update</button></a>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#edit-song-form').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            $.ajax({
                url: $(this).attr('action'), // Get the action URL
                method: $(this).attr('method'), // Get the form method
                data: $(this).serialize(), // Serialize the form data
                success: function(response) {
                    alert('Song updated successfully: ' + response.songName);
                    window.location.href = "{{ route('song.index') }}"; // Redirect to index after success
                },
                error: function(xhr) {
                    $('#error-messages').empty(); // Clear previous error messages
                    if (xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#error-messages').append('<p style="color: red;">' + value + '</p>');
                        });
                    } else {
                        $('#error-messages').append('<p style="color: red;">An unexpected error occurred.</p>');
                    }
                }
            });
        });
    });
</script>
    </div>
</div>


<!--    <h1>Edit Song</h1>

    <div id="error-messages"></div> 

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color: red;">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form id="edit-song-form" method="post" action="{{ route('song.update', ['song' => $song]) }}">
        @csrf
        @method('put')
        <div>
            <label for="">Song Name</label>
            <input type="text" name="songName" placeholder="name" value="{{ $song->songName }}" required />
        </div>
        <div>
            <label for="">Author</label>
            <input type="text" name="author" placeholder="author" value="{{ $song->author }}" required />
        </div>
        <div>
            <label for="">Song Description</label>
            <input type="text" name="description" placeholder="description" value="{{ $song->description }}" />
        </div>
        <div>
            <label for="">Genre</label>
            <select name="genre_id" required>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $song->genre_id == $genre->id ? 'selected' : '' }}>
                        {{ $genre->genreName }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <input type="submit" value="Update"/>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#edit-song-form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: $(this).attr('action'), // Get the action URL
                    method: $(this).attr('method'), // Get the form method
                    data: $(this).serialize(), // Serialize the form data
                    success: function(response) {
                        alert('Song updated successfully: ' + response.songName);
                        window.location.href = "{{ route('song.index') }}"; // Redirect to index after success
                    },
                    error: function(xhr) {
                        $('#error-messages').empty(); // Clear previous error messages
                        if (xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('#error-messages').append('<p style="color: red;">' + value + '</p>');
                            });
                        } else {
                            $('#error-messages').append('<p style="color: red;">An unexpected error occurred.</p>');
                        }
                    }
                });
            });
        });
    </script> -->
</body>
</html>
