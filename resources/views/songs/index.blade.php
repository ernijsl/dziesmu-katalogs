<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Songs List</title>
    @vite(['resources/js/app.js']) <!-- Use Vite to include your JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is included -->
</head>
<body>
    <h1>Songs</h1>
    <div>
        @if(session()->has('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{ route('song.create') }}">Create a song</a>
        </div>
        <table border="1">
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
                    <td>{{ $song->description }}</td>
                    <td>
                        {{ isset($song->genre) ? $song->genre->genreName : 'No genre assigned' }}
                    </td>

                    <td><a href="{{ route('song.edit', ['song' => $song]) }}">Edit</a></td>
                    <td>
                        <form class="delete-song-form" method="post" action="{{ route('song.destroy', ['song' => $song]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit">Delete</button>
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
</body>
</html>
