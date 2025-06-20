<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');
        
        // Get the instances of other controllers
        $movieController = new MovieController();
        $tvShowController = new TVShowController();
        $webSeriesController = new WebSeriesController();
        
        // Get all content and filter
        $movies = collect($movieController->getDummyMovies() ?? [])
            ->filter(function ($movie) use ($query) {
                return stripos($movie['title'], $query) !== false;
            });
            
        $tvShows = collect($tvShowController->getDummyTVShows() ?? [])
            ->filter(function ($show) use ($query) {
                return stripos($show['title'], $query) !== false;
            });
            
        $webSeries = collect($webSeriesController->getDummyWebSeries() ?? [])
            ->filter(function ($series) use ($query) {
                return stripos($series['title'], $query) !== false;
            });

        return view('search-results', [
            'query' => $query,
            'movies' => $movies,
            'tvShows' => $tvShows,
            'webSeries' => $webSeries
        ]);
    }
}