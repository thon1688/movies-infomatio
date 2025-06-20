<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebSeriesController extends Controller
{
    protected $dummyWebSeries = [
        [
            'id' => 1,
            'title' => 'Money Heist',
            'poster' => 'asset/images/webseries/money-heist.jpg',
            'year' => '2017',
            'rating' => '8.2',
            'seasons' => 5,
            'platform' => 'Netflix',
            'views' => 125000,
            'release_date' => '2017-05-02',
            'genre' => 'Crime, Drama, Thriller',
            'creator' => 'Álex Pina',
            'cast' => 'Úrsula Corberó, Álvaro Morte, Itziar Ituño',
            'language' => 'Spanish',
            'description' => 'A criminal mastermind who goes by "The Professor" has a plan to pull off the biggest heist in recorded history -- to print billions of euros in the Royal Mint of Spain.',
            'storyline' => 'Eight thieves take hostages and lock themselves in the Royal Mint of Spain as a criminal mastermind manipulates the police to carry out his plan.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/ZAXA1DV4dtI'
        ],
        [
            'id' => 2,
            'title' => 'Sacred Games',
            'poster' => 'asset/images/webseries/sacred-games.jpg',
            'year' => '2018',
            'rating' => '8.5',
            'seasons' => 2,
            'platform' => 'Netflix',
            'views' => 90000,
            'release_date' => '2018-01-06',
            'genre' => 'Crime, Drama, Thriller',
            'creator' => 'Álex Pina',
            'cast' => 'Úrsula Corberó, Álvaro Morte, Itziar Ituño',
            'language' => 'Spanish',
            'description' => 'A criminal mastermind who goes by "The Professor" has a plan to pull off the biggest heist in recorded history -- to print billions of euros in the Royal Mint of Spain.',
            'storyline' => 'Eight thieves take hostages and lock themselves in the Royal Mint of Spain as a criminal mastermind manipulates the police to carry out his plan.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/ZAXA1DV4dtI'
        ],
        [
            'id' => 3,
            'title' => 'Mirzapur',
            'poster' => 'asset/images/webseries/mirzapur.jpg',
            'year' => '2018',
            'rating' => '8.4',
            'seasons' => 2,
            'platform' => 'Prime Video',
            'views' => 75000,
            'release_date' => '2018-11-16',
            'genre' => 'Crime, Drama, Thriller',
            'creator' => 'Álex Pina',
            'cast' => 'Úrsula Corberó, Álvaro Morte, Itziar Ituño',
            'language' => 'Spanish',
            'description' => 'A criminal mastermind who goes by "The Professor" has a plan to pull off the biggest heist in recorded history -- to print billions of euros in the Royal Mint of Spain.',
            'storyline' => 'Eight thieves take hostages and lock themselves in the Royal Mint of Spain as a criminal mastermind manipulates the police to carry out his plan.',
            'trailer_embed_url' => 'https://www.youtube.com/embed/ZAXA1DV4dtI'
        ]
    ];

    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter', 'latest'); // default to latest
        
        $webSeries = collect($this->dummyWebSeries)
            ->when($search, function ($collection) use ($search) {
                return $collection->filter(function ($series) use ($search) {
                    return stripos($series['title'], $search) !== false;
                });
            });

        // Apply filtering
        switch ($filter) {
            case 'rating':
                $webSeries = $webSeries->sortByDesc('rating');
                break;
            case 'latest':
                $webSeries = $webSeries->sortByDesc('release_date');
                break;
            case 'views':
                $webSeries = $webSeries->sortByDesc('views');
                break;
        }

        return view('web-series', [
            'series' => $webSeries,
            'activeFilter' => $filter
        ]);
    }

    public function show($id)
    {
        $series = collect($this->dummyWebSeries)
            ->firstWhere('id', (int) $id);

        if (!$series) {
            abort(404);
        }

        // Convert array to object including nested arrays
        $seriesObject = json_decode(json_encode($series));

        // Get suggested series (excluding current one)
        $suggestedSeries = collect($this->dummyWebSeries)
            ->filter(function ($item) use ($id) {
                return $item['id'] != $id;
            })
            ->take(4)
            ->map(function($series) {
                return json_decode(json_encode($series));
            });

        return view('web-series-detail', [
            'series' => $seriesObject,
            'suggestedSeries' => $suggestedSeries
        ]);
    }

   public function getDummyWebSeries()
{
    return $this->dummyWebSeries;
}
}
