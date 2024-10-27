<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
class SongController extends Controller
{
    public function index(){
        $songs = Song::all();
        return view ('songs.index', ['songs' => $songs]);
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
    public function edit(Song $song){
        return view ('songs.edit',['song' => $song]);
    }

    public function update(Song $song, Request $request){
        $data = $request->validate([
            'songName' => 'required',
            'author' => 'required',
            'description' => 'nullable',
        ], [
            'songName.required' => 'You should write song name.',
            'author.required' => 'You should write the author name.',
        ]);

        $song->update($data);

        return redirect(route('song.index'))->with('success','Song updated successfully');
    }
    public function destroy(Song $song){
        $song->delete();
        return redirect(route('song.index'))->with('success','Song deleted successfully');
    }
}
