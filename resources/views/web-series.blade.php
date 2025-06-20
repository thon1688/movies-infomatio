<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Series</title>
        <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')

    @section('title', 'Web Series')

    @section('content')
    <div class="container mt-5">
        <!-- Web Series Banner -->
        <div class="mb-4 p-4 bg-dark rounded shadow">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-white mb-0">Popular Web Series</h2>
                <div class="btn-group">
                    <a href="{{ route('web-series', ['filter' => 'latest']) }}" 
                       class="btn btn-{{ $activeFilter === 'latest' ? 'danger' : 'outline-light' }}">
                       Latest Release
                    </a>
                    <a href="{{ route('web-series', ['filter' => 'rating']) }}" 
                       class="btn btn-{{ $activeFilter === 'rating' ? 'danger' : 'outline-light' }}">
                       Top Rated
                    </a>
                    <a href="{{ route('web-series', ['filter' => 'views']) }}" 
                       class="btn btn-{{ $activeFilter === 'views' ? 'danger' : 'outline-light' }}">
                       Most Viewed
                    </a>
                </div>
            </div>
        </div>

        <!-- Web Series Grid -->
        <div class="row g-4">
            @foreach($series as $show)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('web-series.show', $show['id']) }}" class="text-decoration-none">
                        <div class="card bg-dark text-white border-0 h-100 hover-effect">
                            <img src="{{ asset($show['poster']) }}" class="card-img-top" alt="{{ $show['title'] }}">
                            <div class="card-body">
                                <h5 class="card-title text-white">{{ $show['title'] }}</h5>
                                <span class="badge bg-danger mb-2">{{ $show['platform'] }}</span>
                                <p class="card-text">
                                    <small class="text-muted">{{ $show['year'] }} • {{ $show['seasons'] }} Seasons</small>
                                    <span class="float-end">
                                        <i class="fas fa-star text-warning"></i>
                                        {{ $show['rating'] }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <style>
    .hover-effect {
        transition: transform 0.3s ease-in-out;
    }
    .hover-effect:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(135, 119, 226, 0.2);
    }
    .card-img-top {
        height: 400px;
        object-fit: cover;
    }
    .btn-group .btn {
        border-radius: 0;
    }
    .btn-group .btn:first-child {
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    .btn-group .btn:last-child {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }
    </style>
    @endsection
</body>
</html>