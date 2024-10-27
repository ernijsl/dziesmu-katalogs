<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genres List</title>
    @vite(['resources/js/app.js']) <!-- Use Vite to include your JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is included -->
</head>
<body>
    <h1>Genres</h1>
    <div>
        @if(session()->has('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{ route('genre.create') }}">Create a genre</a>
        </div>
        <table border="1">
            <tr>
                <th>Genre Name</th>

                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($genres as $genre)
                <tr data-genre-id="{{ $genre->id }}">
                    <td>{{ $genre->genreName }}</td>
                    <td><a href="{{ route('genre.edit', ['genre' => $genre]) }}">Edit</a></td>
                    <td>
                        <form class="delete-genre-form" method="post" action="{{ route('genre.destroy', ['genre' => $genre]) }}">
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
            $('.delete-genre-form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                if (confirm('Are you sure you want to delete this genre?')) {
                    const form = $(this);

                    $.ajax({
                        url: form.attr('action'), // Get the action URL
                        method: form.attr('method'), // Get the form method
                        data: form.serialize(), // Serialize the form data
                        success: function(response) {
                            // Remove the corresponding row from the table
                            const genreId = form.closest('tr').data('genre-id');
                            $('tr[data-genre-id="' + genreId + '"]').fadeOut(); // Fade out the row
                            alert(response.message); // Show success message
                        },
                        error: function(xhr) {
                            // Handle errors (optional)
                            alert('Error deleting genre: ' + (xhr.responseJSON.message || 'Unknown error.'));
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
