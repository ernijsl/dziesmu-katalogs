<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Genre</title>
    @vite(['resources/js/app.js']) <!-- Use Vite to include your JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is included -->
</head>
<body>
    <h1>Edit Genre</h1>

    <div id="error-messages"></div> <!-- For displaying error messages -->

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color: red;">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form id="edit-genre-form" method="post" action="{{ route('genre.update', ['genre' => $genre]) }}">
        @csrf
        @method('put')
        <div>
            <label for="">Genre Name</label>
            <input type="text" name="genreName" placeholder="name" value="{{ $genre->genreName }}" required />
        </div>
        <div>
            <input type="submit" value="Update"/>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#edit-genre-form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: $(this).attr('action'), // Get the action URL
                    method: $(this).attr('method'), // Get the form method
                    data: $(this).serialize(), // Serialize the form data
                    success: function(response) {
                        alert('Genre updated successfully: ' + response.genreName);
                        window.location.href = "{{ route('genre.index') }}"; // Redirect to index after success
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
