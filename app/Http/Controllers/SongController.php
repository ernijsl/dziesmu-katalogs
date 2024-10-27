<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Genre;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::with('genre')->get(); // Fetch all songs with their genres
        $genres = Genre::all(); // Fetch all genres
        return view('songs.index', ['songs' => $songs, 'genres' => $genres]); // Pass songs and genres to the view
    }

    public function create()
    {
        $genres = Genre::all(); // Fetch all genres
        return view('songs.create', compact('genres')); // Pass genres to the view
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'songName' => 'required|unique:songs,songName', // Unique validation
            'author' => 'required',
            'description' => 'nullable',
            'genre_id' => 'required|exists:genres,id', // Validate genre_id
        ], [
            'songName.required' => 'You should write the song name.',
            'songName.unique' => 'This song name already exists.', // Message for duplicate name
            'author.required' => 'You should write the author name.',
            'genre_id.required' => 'You should select a genre.',
            'genre_id.exists' => 'The selected genre is invalid.',
        ]);

        // Create a new song with the genre_id
        $newSong = Song::create($data);
        
        return response()->json($newSong); // Return the new song as JSON
    }

    public function edit(Song $song)
    {
        $genres = Genre::all(); // Fetch all genres
        return view('songs.edit', compact('song', 'genres')); // Pass song and genres to the view
    }

    public function update(Song $song, Request $request)
    {
        $data = $request->validate([
            'songName' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'genre_id' => 'required|exists:genres,id', // Validate genre_id
        ], [
            'songName.required' => 'You should write the song name.',
            'author.required' => 'You should write the author name.',
            'genre_id.required' => 'You should select a genre.',
            'genre_id.exists' => 'The selected genre is invalid.',
        ]);

        $song->update($data); // Update the song with the provided data

        return response()->json($song); // Return the updated song as JSON
    }

    public function destroy(Song $song)
    {
        $song->delete();
        return response()->json(['message' => 'Song deleted successfully']); // Return success message as JSON
    }
}
