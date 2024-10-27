<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit song</h1>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color: red;">{{ $error }}</p>
            @endforeach
        </div>
    @endif


    <form method="post" action="{{route('song.update',['song' => $song])}}">
        @csrf
        @method('put')
        <div>
            <label for="">Song name</label>
            <input type="text" name="songName" placeholder="name" value="{{$song->songName}}" />
        </div>
        <div>
            <label for="">Author</label>
            <input type="text" name="author" placeholder="author" value="{{$song->author}}" />
        </div>
        <div>
            <label for="">Song description</label>
            <input type="text" name="description" placeholder="description" value="{{$song->description}}" />
        </div>
        <div>
            <input type="submit" value="Update"/>
        </div>
    </form>
</body>
</html>