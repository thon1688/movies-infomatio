<?php
// app/Models/Genre.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'genre_movie', 'genre_id', 'movie_id');
    }
}