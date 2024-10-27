<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::all();
        return view('songs.index', ['songs' => $songs]);
    }

    public function create()
    {
        return view('songs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'songName' => 'required',
            'author' => 'required',
            'description' => 'nullable',
        ], [
            'songName.required' => 'You should write the song name.',
            'author.required' => 'You should write the author name.',
        ]);

        $newSong = Song::create($data);
        
        return response()->json($newSong); // Return the new song as JSON
    }

    public function edit(Song $song)
    {
        return view('songs.edit', ['song' => $song]);
    }

    public function update(Song $song, Request $request)
    {
        $data = $request->validate([
            'songName' => 'required',
            'author' => 'required',
            'description' => 'nullable',
        ], [
            'songName.required' => 'You should write the song name.',
            'author.required' => 'You should write the author name.',
        ]);

        $song->update($data);

        return response()->json($song); // Return the updated song as JSON
    }

    public function destroy(Song $song)
    {
        $song->delete();
        return response()->json(['message' => 'Song deleted successfully']); // Return success message as JSON
    }
}
