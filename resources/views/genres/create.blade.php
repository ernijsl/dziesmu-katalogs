<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Genre</title>
    @vite(['resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #000000;
        }

        .navbar {
            height: 100px;
            color: white;
        }

        .conter {
            background-color: #363647;
            padding: 20px;
            border-radius: 25px;
            margin-left: 20px;

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
            margin-top: 15px;
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
            <h1 class="mx-auto">Pievienot žanrus</h1>
        </div>
    </nav>
    <div class="container d-flex justify-content-center">
        <div class="container d-flex justify-content-center conter">
            <div id="error-messages"></div>

            @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                <p style="color: red;">{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form id="create-genre-form" method="post" action="{{ route('genre.store') }}">
                @csrf
                <div>
                    <label>Genre Name</label>
                    <input type="text" name="genreName" placeholder="name" required />
                </div>
                <div>
                    <a href="/"><button class="bn-32 bn32" type="submit">Save New Genre</button></a>
                </div>
            </form>

            <script>
                $(document).ready(function() {
                    $('#create-genre-form').on('submit', function(e) {
                        e.preventDefault(); // Prevent default form submission

                        const button = $(this).find('input[type="submit"]');
                        button.prop('disabled', true); // Disable the button

                        $.ajax({
                            url: $(this).attr('action'),
                            method: $(this).attr('method'),
                            data: $(this).serialize(),
                            success: function(response) {
                                alert('Genre created successfully: ' + response.genreName);
                                window.location.href = "{{ route('genre.index') }}";
                            },
                            error: function(xhr) {
                                $('#error-messages').empty();
                                if (xhr.responseJSON.errors) {
                                    $.each(xhr.responseJSON.errors, function(key, value) {
                                        $('#error-messages').append('<p style="color: red;">' + value + '</p>');
                                    });
                                } else {
                                    $('#error-messages').append('<p style="color: red;">An unexpected error occurred.</p>');
                                }
                                button.prop('disabled', false); // Re-enable the button on error
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
    
</body>

</html>