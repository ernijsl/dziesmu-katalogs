<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create songs</h1>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color: red;">{{ $error }}</p>
            @endforeach
        </div>
    @endif


    <form method="post" action="{{route('song.store')}}">
        @csrf
        @method('post')
        <div>
            <label for="">Song name</label>
            <input type="text" name="songName" placeholder="name" />
        </div>
        <div>
            <label for="">Author</label>
            <input type="text" name="author" placeholder="author" />
        </div>
        <div>
            <label for="">Song description</label>
            <input type="text" name="description" placeholder="description" />
        </div>
        <div>
            <input type="submit" value="Save new song"/>
        </div>
    </form>
</body>
</html>