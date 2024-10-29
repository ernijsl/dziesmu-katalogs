<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Songs List</title>
    @vite(['resources/js/app.js']) <!-- Use Vite to include your JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is included -->
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
            background-color: #000000;
            color: white;
        }

        .btn-reg {
            margin: 10px;
        }

        .btn-pies {
            margin: 10px;

        }

        .content {
            height: 100%;
            width: 100%;

        }

        .div-task {
            border-radius: 25px;
            margin-right: 5px;
            background-color: #363647;



        }

        .div-content {
            background-color: beige;
            border-radius: 25px;
            margin-left: 5px;
            background-color: #363647;

        }

        .btn-mansprofils {
            color: white;
            width: 100%;
            height: 50px;
            margin-top: 200px;
            font-size: 30px !important;
            border: none;
            background: transparent;
            outline: none;
            cursor: pointer;
            border-radius: 15px;
        }


        .btn-fav {
            color: white;
            width: 100%;
            height: 50px;
            margin-top: 15px;
            font-size: 30px !important;
            border: none;
            background: transparent;
            outline: none;
            cursor: pointer;
            border-radius: 15px;
        }


        .btn-sett {
            color: white;
            width: 100%;
            height: 70px;
            margin-top: 15px;
            font-size: 30px !important;
            border: none;
            background: transparent;
            outline: none;
            cursor: pointer;
            border-radius: 15px;
        }



        .div-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background-color: #363647;
            color: #ffffff;
            padding: 10px; /* Remove padding to allow table full width */
            overflow-y: auto;
            border-radius: 25px 0 0 25px;
        }

        /* Table styling */
        .playlist-table {
            width: 100%;
            
            border-collapse: collapse;
        }

        /* Removing all borders */
        .playlist-table, .playlist-table th, .playlist-table td {
            border: none;
        }

        .playlist-table th, .playlist-table td {
            padding: 15px;
            text-align: left;
        }

        .playlist-table th {
            background-color: #1f1f1f;
            color: #b3b3b3;
            font-weight: normal;
            
        }

        .playlist-table tr:hover {
            background-color: #2a2a2a;
        }

        .playlist-table td {
            background-color: #363647;
            color: #ffffff;
        }

        .edit, .delete {
            text-align: center;
            color: #ff4c4c;
            cursor: pointer;
        }

        .edit:hover {
            color: #4caf50;
        }

        .delete:hover {
            color: #e53935;
        }

        /* Button styling */
        .btn {
            border: none;
            background: none;
            font-size: 16px;
            cursor: pointer;
        }

        .description, .genre {
            color: #b3b3b3;
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
                <a href="{{ route('song.create') }}" class=" btn btn-fav fw-bold">PIEVIENOT DZIESMAS</a>
            </div>
            <div class="container-fluid justify-content-center">
                <a href="{{ route('genre.create') }}" class=" btn btn-sett fw-bold">PIEVIENOT ŽANRU</a>
            </div>
        </div>
        <div class="h-100 col div-content">
            <div>
                @if(session()->has('success'))
                <div>
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <div>
                <table border="1" class="playlist-table">
                    <tr>
                        <th>Song Name</th>
                        <th>Author</th>
                        <th>Description</th>
                        <th>Genre</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($songs as $song)
                    <tr data-song-id="{{ $song->id }}">
                        <td>{{ $song->songName }}</td>
                        <td>{{ $song->author }}</td>
                        <td class="description">{{ $song->description }}</td>
                        <td class="genre">
                            {{ isset($song->genre) ? $song->genre->genreName : 'No genre assigned' }}
                        </td>

                        <td class="edit">
                            <a class="btn" href="{{ route('song.edit', ['song' => $song]) }}">Edit</a></td>
                        </td>
                        <td>
                            <form class=" delete delete-song-form" method="post" action="{{ route('song.destroy', ['song' => $song]) }}">
                                @csrf
                                @method('delete')
                                <button class="btn" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <script>
                $(document).ready(function() {
                    $('.delete-song-form').on('submit', function(e) {
                        e.preventDefault(); // Prevent default form submission

                        if (confirm('Are you sure you want to delete this song?')) {
                            const form = $(this);

                            $.ajax({
                                url: form.attr('action'), // Get the action URL
                                method: form.attr('method'), // Get the form method
                                data: form.serialize(), // Serialize the form data
                                success: function(response) {
                                    // Remove the corresponding row from the table
                                    const songId = form.closest('tr').data('song-id');
                                    $('tr[data-song-id="' + songId + '"]').fadeOut(); // Fade out the row
                                    alert(response.message); // Show success message
                                },
                                error: function(xhr) {
                                    // Handle errors (optional)
                                    alert('Error deleting song: ' + (xhr.responseJSON.message || 'Unknown error.'));
                                }
                            });
                        }
                    });
                });

                function updateGenre(songId, genreId) {
                    $.ajax({
                        url: '/songs/' + songId + '/genre', // Your route to update genre
                        method: 'PUT',
                        data: {
                            genre_id: genreId,
                            _token: '{{ csrf_token() }}' // Include CSRF token
                        },
                        success: function(response) {
                            alert('Genre updated successfully: ' + response.genreName);
                        },
                        error: function(xhr) {
                            alert('Error updating genre: ' + (xhr.responseJSON.message || 'Unknown error.'));
                        }
                    });
                }
            </script>

        </div>
    

</body>

</html>