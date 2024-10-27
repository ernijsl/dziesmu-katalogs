<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', ['genres' => $genres]);
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'genreName' => 'required|unique:genres,genreName', // Pievienots unikālais ierobežojums
        ], [
            'genreName.required' => 'You should write the genre name.',
            'genreName.unique' => 'This genre name already exists.', // Paziņojums par unikālu nosaukumu
        ]);
    
        $newGenre = Genre::create($data);
        
        return response()->json($newGenre);
    }
    

    public function edit(Genre $genre)
    {
        return view('genres.edit', ['genre' => $genre]);
    }

    public function update(Genre $genre, Request $request)
    {
        $data = $request->validate([
            'genreName' => 'required',

        ], [
            'genreName.required' => 'You should write the genre name.',
        ]);

        $genre->update($data);

        return response()->json($genre); // Return the updated song as JSON
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return response()->json(['message' => 'Genre deleted successfully']); // Return success message as JSON
    }
}
