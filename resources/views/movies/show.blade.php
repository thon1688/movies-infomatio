<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

@section('id', $movie['id']) {{-- Use $movie['title'] for dummy array --}}

@push('styles')
<link rel="stylesheet" href="{{ asset('asset/css/movie.css') }}"> {{-- Keep specific movie CSS --}}
@endpush

@section('content')
<section class="movie-detail-section py-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                {{-- Ensure the image path is correct relative to the public directory --}}
                <img src="{{ asset('images/' . $movie['poster']) }}" class="img-fluid rounded shadow" alt="{{ $movie['title'] }}">
            </div>
            <div class="col-md-8">
                <h1 class="display-4 mb-3">{{ $movie['title'] }}</h1>
                <p class="lead text-white-50">{{ $movie['description'] }}</p>

                <div class="mb-3">
                    <span class="badge bg-warning text-dark me-2">
                        <i class="fas fa-star"></i> {{ $movie['rating'] ?? 'N/A' }} / 10
                    </span>
                    <span class="badge bg-info me-2">{{ $movie['rating_quality'] ?? 'HD' }}</span> {{-- Added default for rating_quality --}}
                    {{-- @if(!$movie['is_tv_show']) --}} {{-- Uncomment if you add 'is_tv_show' to dummy data --}}
                    <span class="badge bg-secondary me-2"><i class="fas fa-clock"></i> {{ $movie['duration'] }}</span>
                    {{-- @endif --}}
                    <span class="badge bg-dark me-2"><i class="fas fa-calendar-alt"></i> {{ $movie['year'] }}</span>
                </div>

                <div class="mb-4">
                    {{-- For dummy data, if 'genre' is a string --}}
                    @if(isset($movie['genre']))
                        @php
                            $genres = explode(', ', $movie['genre']);
                        @endphp
                        @foreach($genres as $genre)
                            <span class="badge bg-primary me-1">{{ trim($genre) }}</span>
                        @endforeach
                    @else
                        <span class="text-white-50">No genres available.</span>
                    @endif

                    {{-- If you switch to database and have $movie->genres (Eloquent relationship):
                    @forelse($movie->genres as $genre)
                        <span class="badge bg-primary me-1">{{ $genre->name }}</span>
                    @empty
                        <span class="text-white-50">No genres available.</span>
                    @endforelse
                    --}}
                </div>

                <ul class="nav nav-tabs mb-4" id="movieTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Overview</button>
                    </li>
                    @if(isset($movie['trailer_embed_url'])) {{-- Check if trailer_embed_url exists for dummy --}}
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="trailer-tab" data-bs-toggle="tab" data-bs-target="#trailer" type="button" role="tab" aria-controls="trailer" aria-selected="false">Trailer</button>
                    </li>
                    @endif
                    {{-- @if($movie->is_tv_show && $movie->episodes->count() > 0) --}} {{-- Uncomment if TV show logic needed --}}
                    {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="episodes-tab" data-bs-toggle="tab" data-bs-target="#episodes" type="button" role="tab" aria-controls="episodes" aria-selected="false">Episodes</button>
                    </li> --}}
                    {{-- @endif --}}
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments" type="button" role="tab" aria-controls="comments" aria-selected="false">Comments</button>
                    </li>
                </ul>

                <div class="tab-content" id="movieTabsContent">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                        <p>{{ $movie['description'] }}</p>
                        <p><strong>Director:</strong> {{ $movie['director'] ?? 'N/A' }}</p>
                        <p><strong>Cast:</strong> {{ $movie['cast'] ?? 'N/A' }}</p>
                        <p><strong>Language:</strong> {{ $movie['language'] ?? 'N/A' }}</p>
                        <p><strong>Storyline:</strong> {{ $movie['storyline'] ?? 'N/A' }}</p>
                    </div>
                    @if(isset($movie['trailer_embed_url']))
                    <div class="tab-pane fade" id="trailer" role="tabpanel" aria-labelledby="trailer-tab">
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $movie['trailer_embed_url'] }}" title="Movie Trailer" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    @endif
                    {{-- @if($movie->is_tv_show && $movie->episodes->count() > 0) --}}
                    {{-- <div class="tab-pane fade" id="episodes" role="tabpanel" aria-labelledby="episodes-tab">
                        <h5>Episodes</h5>
                        <div class="accordion accordion-flush" id="episodesAccordion">
                            @php
                                $groupedEpisodes = $movie->episodes->groupBy('season_number');
                            @endphp
                            @foreach($groupedEpisodes as $seasonNumber => $episodesInSeason)
                                <div class="accordion-item bg-secondary text-white border-bottom border-dark">
                                    <h2 class="accordion-header" id="headingSeason{{ $seasonNumber }}">
                                        <button class="accordion-button collapsed bg-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeason{{ $seasonNumber }}" aria-expanded="false" aria-controls="collapseSeason{{ $seasonNumber }}">
                                            Season {{ $seasonNumber }}
                                        </button>
                                    </h2>
                                    <div id="collapseSeason{{ $seasonNumber }}" class="accordion-collapse collapse" aria-labelledby="headingSeason{{ $seasonNumber }}" data-bs-parent="#episodesAccordion">
                                        <div class="accordion-body">
                                            <ul class="list-group list-group-flush">
                                                @foreach($episodesInSeason->sortBy('episode_number') as $episode)
                                                    <li class="list-group-item bg-dark text-white border-bottom border-secondary d-flex justify-content-between align-items-center">
                                                        Episode {{ $episode->episode_number }}: {{ $episode->title }}
                                                        <a href="{{ $episode->video_url }}" target="_blank" class="btn btn-sm btn-outline-info">Watch <i class="fas fa-play"></i></a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}
                    {{-- @endif --}}
                    <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                        <h5>Comments</h5>
                        <form action="{{ route('comments.store') }}" method="POST" class="mb-4"> {{-- Changed action to use route helper --}}
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                            <div class="mb-3">
                                <textarea class="form-control bg-secondary text-white border-0" name="comment" rows="3" placeholder="Add your comment here..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Comment</button>
                        </form>

                        <div class="comment-list">
                            @forelse($movie['comments'] ?? [] as $comment) {{-- Assuming comments would be nested in dummy data --}}
                                <div class="card bg-secondary text-white mb-3 border-0">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-white-50">
                                            <i class="fas fa-user-circle"></i> {{ $comment['user_name'] ?? 'Guest User' }} {{-- Accessing dummy comment data --}}
                                            <small class="float-end">{{ $comment['created_at'] ?? 'Just now' }}</small>
                                        </h6>
                                        <p class="card-text">{{ $comment['comment_text'] }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-white-50">No comments yet. Be the first to comment!</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Movies Section --}}
<section class="related-movies-section py-5 bg-dark text-white">
    <div class="container">
        <h2 class="mb-4 text-center">Related Movies</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @forelse($relatedMovies as $relatedMovie)
                <div class="col">
                    <a href="{{ route('movies.show', ['movie' => $relatedMovie['id']]) }}" class="movie-card-link">
                        <div class="card bg-transparent border-0 movie-card-custom">
                            <img src="{{ asset('images/' . $relatedMovie['poster']) }}" class="card-img-top rounded" alt="{{ $relatedMovie['title'] }}">
                            <div class="card-body px-0 py-2 text-start">
                                <h5 class="card-title text-white mb-1">{{ $relatedMovie['title'] }}</h5>
                                <div class="movie-meta-icons text-muted small">
                                    <span class="me-2"><i class="far fa-eye"></i> {{ $relatedMovie['views'] }}</span>
                                    <span class="me-2"><i class="far fa-star"></i> {{ $relatedMovie['rating'] }}</span>
                                    <span class="imdb-rating">IMDb {{ $relatedMovie['imdb_rating'] }}</span>
                                    <span>{{ $relatedMovie['year'] }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-white-50">No related movies found.</div>
            @endforelse
        </div>
    </div>
</section>

@endsection
</body>
</html>