<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title ?? 'Movie Details' }} - Your Movie Streaming App</title>
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">

</head>
<body>
    @extends('layouts.app')

    @section('title', $movie->title)

    @section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Movie Poster -->
            <div class="col-md-4">
                <div class="card bg-dark border-0">
                    <img src="{{ asset($movie->poster) }}" class="card-img-top" alt="{{ $movie->title }}">
                </div>
            </div>

            <!-- Movie Details -->
            <div class="col-md-8">
                <div class="bg-dark text-white p-4 rounded">
                    <h1 class="mb-3">{{ $movie->title }}</h1>
                    
                    <div class="d-flex align-items-center mb-3">
                        <span class="me-3">
                            <i class="fas fa-star text-warning"></i>
                            {{ $movie->rating }} Rating
                        </span>
                        <span class="me-3">
                            <i class="fas fa-clock text-muted"></i>
                            {{ $movie->duration }}
                        </span>
                        <span class="me-3">
                            <i class="fas fa-calendar-alt text-muted"></i>
                            {{ $movie->year }}
                        </span>
                        <span>
                            <i class="fas fa-eye text-muted"></i>
                            {{ number_format($movie->views) }} views
                        </span>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-light">Description</h5>
                        <p>{{ $movie->description }}</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-light">Genre</h5>
                            <p>{{ $movie->genre }}</p>

                            <h5 class="text-light">Director</h5>
                            <p>{{ $movie->director }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-light">Language</h5>
                            <p>{{ $movie->language }}</p>

                            <h5 class="text-light">IMDb Rating</h5>
                            <p><i class="fab fa-imdb text-warning"></i> {{ $movie->imdb_rating }}/10</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-light">Cast</h5>
                        <p>{{ $movie->cast }}</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-light">Storyline</h5>
                        <p>{{ $movie->storyline }}</p>
                    </div>

                    @if($movie->trailer_embed_url)
                    <div class="mb-4">
                        <h5 class="text-light">Trailer</h5>
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $movie->trailer_embed_url }}" allowfullscreen></iframe>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Suggested Movies -->
        @if($suggestedMovies->isNotEmpty())
        <div class="mt-5">
            <h3 class="text-white mb-4">You May Also Like</h3>
            <div class="row g-4">
                @foreach($suggestedMovies as $suggested)
                <div class="col-md-3">
                    <a href="{{ route('movies.show', $suggested->id) }}" class="text-decoration-none">
                        <div class="card bg-dark text-white border-0 hover-effect">
                            <img src="{{ asset($suggested->poster) }}" class="card-img-top" alt="{{ $suggested->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $suggested->title }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">{{ $suggested->year }}</small>
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
        object-fit: cover;
    }
    </style>
    @endsection
</body>
</html>