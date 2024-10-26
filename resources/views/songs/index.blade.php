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
        <table border="1">
            <tr>
                <th>Song name</th>
                <th>Author</th>
                <th>Description</th>
            </tr>
            @foreach($songs as $song)
                <tr>
                    <td>{{$song->songName}}</td>
                    <td>{{$song->author}}</td>
                    <td>{{$song->description}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>