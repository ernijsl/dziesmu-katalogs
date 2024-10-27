<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Genre</title>
    @vite(['resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Create Genre</h1>

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
            <input type="submit" value="Save New Genre"/>
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
</body>
</html>
