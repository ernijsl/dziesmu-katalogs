<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Song</h1>
    <div>
        @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{route('song.create')}}">Create a product</a>
        </div>
        <table border="1">
            <tr>
                <th>Song name</th>
                <th>Author</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($songs as $song)
                <tr>
                    <td>{{$song->songName}}</td>
                    <td>{{$song->author}}</td>
                    <td>{{$song->description}}</td>
                    <td><a href="{{route('song.edit',['song' => $song])}}">Edit</a></td>
                    <td>
                        <form method="post" action="{{route('song.destroy',['song' => $song])}}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>