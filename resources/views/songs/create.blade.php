<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Song</title>
    @vite(['resources/js/app.js']) <!-- Use Vite to include your JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is included -->
</head>
<body>
    <h1>Create Song</h1>

    <div id="error-messages"></div> <!-- Div to display error messages -->

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color: red;">{{ $error }}</p>
            @endforeach
        </div>
    @endif

<form id="create-song-form" method="post" action="{{ route('song.store') }}">
    @csrf
    <div>
        <label>Song Name</label>
        <input type="text" name="songName" placeholder="name" required />
    </div>
    <div>
        <label>Author</label>
        <input type="text" name="author" placeholder="author" required />
    </div>
    <div>
        <label>Song Description</label>
        <input type="text" name="description" placeholder="description" />
    </div>
    <div>
        <label>Genre</label>
        <select name="genre_id" required>
            <option value="">Select a genre</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ isset($song) && $song->genre_id == $genre->id ? 'selected' : '' }}>
                    {{ $genre->genreName }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <input type="submit" value="Save New Song"/>
    </div>
</form>


    <script>
        $(document).ready(function() {
            $('#create-song-form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: $(this).attr('action'), // Get the form action URL
                    method: $(this).attr('method'), // Get the form method
                    data: $(this).serialize(), // Serialize the form data
                    success: function(response) {
                        alert('Song created successfully: ' + response.songName);
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
</body>
</html>
