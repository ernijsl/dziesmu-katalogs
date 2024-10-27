<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'songName',
        'author',
        'description',
        'genre_id', // Add genre_id to the fillable array
    ];

    // Define the relationship with the Genre model
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
