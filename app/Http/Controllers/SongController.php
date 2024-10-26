<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
class SongController extends Controller
{
    public function index(){
        return view('songs.index');
    }

    public function create(){
        return view ('songs.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'songName' => 'required',
            'author' => 'required',
            'description' => 'nullable',
        ], [
            'songName.required' => 'You should write song name.',
            'author.required' => 'You should write the author name.',
        ]);

        $newSong = Song::create($data);
        return redirect(route('song.index'));
    }
}
