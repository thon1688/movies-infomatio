<?php
// app/Models/Movie.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'release_year',
        'duration',
        'rating',
        'is_tv_show',
        'cover_image',
        'trailer_url',
        'rating_quality', // Added this field as per migration
    ];

    // Define relationships
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'movie_category', 'movie_id', 'category_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function watchHistories()
    {
        return $this->hasMany(WatchHistory::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}