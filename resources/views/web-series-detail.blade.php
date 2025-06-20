<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
</head>
<body>
@extends('layouts.app')

@section('title', $series->title)

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Web Series Poster -->
        <div class="col-md-4">
            <div class="card bg-dark border-0">
                <img src="{{ asset($series->poster) }}" class="card-img-top" alt="{{ $series->title }}">
                <div class="card-body">
                    <span class="badge bg-danger mb-2">{{ $series->platform }}</span>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ number_format($series->views) }} views</small>
                        <div>
                            <i class="fas fa-star text-warning"></i>
                            <span class="text-white">{{ $series->rating }}/10</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Web Series Details -->
        <div class="col-md-8">
            <div class="bg-dark text-white p-4 rounded">
                <h1 class="mb-3">{{ $series->title }}</h1>
                
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <span class="badge bg-secondary">{{ $series->year }}</span>
                    <span class="badge bg-secondary">{{ $series->seasons }} Seasons</span>
                    <span class="badge bg-secondary">{{ $series->language }}</span>
                </div>

                <div class="mb-4">
                    <h5 class="text-light">Description</h5>
                    <p>{{ $series->description }}</p>
                </div>

                <div class="mb-4">
                    <h5 class="text-light">Storyline</h5>
                    <p>{{ $series->storyline }}</p>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="text-light">Genre</h5>
                        <p>{{ $series->genre }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-light">Creator</h5>
                        <p>{{ $series->creator }}</p>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="text-light">Cast</h5>
                    <p>{{ $series->cast }}</p>
                </div>

                <div class="mb-4">
                    <h5 class="text-light">Release Date</h5>
                    <p>{{ \Carbon\Carbon::parse($series->release_date)->format('F d, Y') }}</p>
                </div>

                @if($series->trailer_embed_url)
                <div class="mb-4">
                    <h5 class="text-light">Trailer</h5>
                    <div class="ratio ratio-16x9">
                        <iframe 
                            src="{{ $series->trailer_embed_url }}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Suggested Web Series -->
    @if($suggestedSeries->isNotEmpty())
    <div class="mt-5">
        <h3 class="text-white mb-4">You May Also Like</h3>
        <div class="row g-4">
            @foreach($suggestedSeries as $suggested)
            <div class="col-md-3">
                <a href="{{ route('web-series.show', $suggested->id) }}" class="text-decoration-none">
                    <div class="card bg-dark text-white border-0 hover-effect">
                        <img src="{{ asset($suggested->poster) }}" class="card-img-top" alt="{{ $suggested->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $suggested->title }}</h5>
                            <span class="badge bg-danger mb-2">{{ $suggested->platform }}</span>
                            <p class="card-text">
                                <small class="text-muted">{{ $suggested->year }} • {{ $suggested->seasons }} Seasons</small>
                                <span class="float-end">
                                    <i class="fas fa-star text-warning"></i>
                                    {{ $suggested->rating }}
                                </span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
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
.badge {
    font-size: 0.9rem;
}
</style>
@endsection
</body>
</html>