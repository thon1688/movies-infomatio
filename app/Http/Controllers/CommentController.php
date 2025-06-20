<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Movie  $movie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Movie $movie)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $comment = new Comment([
            'comment' => $request->get('comment'),
            'user_id' => Auth::id(), // Assuming users are authenticated
            'movie_id' => $movie->id,
        ]);

        $movie->comments()->save($comment);

        return back()->with('success', 'Comment added successfully!');
    }
}

class MovieController extends Controller
{
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }
}