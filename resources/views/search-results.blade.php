<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="container mt-5">
    <h2 class="text-white mb-4">Search Results for "{{ $query }}"</h2>

    @if($movies->isEmpty() && $tvShows->isEmpty() && $webSeries->isEmpty())
        <div class="alert alert-dark">
            No results found for your search.
        </div>
    @else
        @if(!$movies->isEmpty())
            <h3 class="text-white-50 mb-3">Movies</h3>
            <div class="row g-4 mb-5">
                @foreach($movies as $movie)
                    <div class="col-md-3 mb-4">
                        <div class="card bg-dark text-white border-0 h-100 hover-effect">
                            <img src="{{ asset($movie['poster']) }}" class="card-img-top" alt="{{ $movie['title'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie['title'] }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">{{ $movie['year'] }}</small>
                                    <span class="float-end">
                                        <i class="fas fa-star text-warning"></i>
                                        {{ $movie['rating'] }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if(!$tvShows->isEmpty())
            <h3 class="text-white-50 mb-3">TV Shows</h3>
            <div class="row g-4 mb-5">
                @foreach($tvShows as $show)
                    <div class="col-md-3 mb-4">
                        <div class="card bg-dark text-white border-0 h-100 hover-effect">
                            <img src="{{ asset($show['poster']) }}" class="card-img-top" alt="{{ $show['title'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $show['title'] }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">{{ $show['year'] }} • {{ $show['seasons'] }} Seasons</small>
                                    <span class="float-end">
                                        <i class="fas fa-star text-warning"></i>
                                        {{ $show['rating'] }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if(!$webSeries->isEmpty())
            <h3 class="text-white-50 mb-3">Web Series</h3>
            <div class="row g-4">
                @foreach($webSeries as $series)
                    <div class="col-md-3 mb-4">
                        <div class="card bg-dark text-white border-0 h-100 hover-effect">
                            <img src="{{ asset($series['poster']) }}" class="card-img-top" alt="{{ $series['title'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $series['title'] }}</h5>
                                <p class="card-text">
                                    <small class="text-light">{{ $series['platform'] }}</small>
                                    <small class="text-muted d-block">{{ $series['year'] }} • {{ $series['seasons'] }} Seasons</small>
                                    <span class="float-end">
                                        <i class="fas fa-star text-warning"></i>
                                        {{ $series['rating'] }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>

<style>
.hover-effect {
    transition: transform 0.3s ease-in-out;
}
.hover-effect:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(189, 65, 65, 0.2);
}
.card-img-top {
    height: 400px;
    object-fit: cover;
}
</style>
@endsection
</body>
</html>