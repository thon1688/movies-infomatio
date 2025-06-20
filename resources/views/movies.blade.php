<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <!-- Tailwind CSS CDN -->
    <!-- Font Awesome for icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('asset/bootstrap-5.3.6/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
</head>
<body class="">
@extends('layouts.app')

@section('title', 'Movies')

@section('content')
<div class="container mt-5">
    <!-- Movies Banner -->
    <div class="mb-4 p-4 bg-dark rounded shadow">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-white mb-0">Movies</h2>
            <div class="btn-group">
                <a href="{{ route('movies', ['filter' => 'latest'] + request()->except('filter', 'page')) }}" 
                   class="btn btn-{{ $activeFilter === 'latest' ? 'danger' : 'outline-light' }}">
                   Latest Release
                </a>
                <a href="{{ route('movies', ['filter' => 'rating'] + request()->except('filter', 'page')) }}" 
                   class="btn btn-{{ $activeFilter === 'rating' ? 'danger' : 'outline-light' }}">
                   Top Rated
                </a>
                <a href="{{ route('movies', ['filter' => 'views'] + request()->except('filter', 'page')) }}" 
                   class="btn btn-{{ $activeFilter === 'views' ? 'danger' : 'outline-light' }}">
                   Most Viewed
                </a>
            </div>
        </div>
    </div>

    <!-- Movies Grid -->
    <div class="row g-4">
        @foreach($allMovies as $movie)
            <div class="col-md-3 mb-4">
                <a href="{{ route('movies.show', $movie->id) }}" class="text-decoration-none">
                    <div class="card bg-dark text-white border-0 h-100 hover-effect">
                        <img src="{{ asset($movie->poster) }}" class="card-img-top" alt="{{ $movie->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text">
                                <small class="text-muted">{{ $movie->year }} • {{ $movie->duration }}</small>
                                <span class="float-end">
                                    <i class="fas fa-star text-warning"></i>
                                    {{ $movie->rating }}
                                </span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $allMovies->links() }}
    </div>
</div>

<style>
.hover-effect {
    transition: transform 0.3s ease-in-out;
}
.hover-effect:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(53, 45, 116, 0.2);
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
