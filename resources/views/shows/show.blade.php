<?php /** @var \App\Models\Show\Show $show */ ?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex mb-3 justify-content-between">
            <div>
                <h1>{{ $show->name }}</h1>
                <div>
                    <p class="mb-1">
                        @include('shows._genres', ['show' => $show])
                    </p>
                </div>
            </div>
            <div>
                <form action="{{ route('show.watchlist', $show) }}" method="post">
                    @csrf
                    @if($show->isOnUsersWatchlist(auth()->user()))
                        <button class="btn btn-primary">
                            Add to Watchlist
                        </button>
                    @else
                        <button class="btn btn-primary">
                            Remove from Watchlist
                        </button>
                    @endif
                </form>
            </div>
        </div>

        @if ($nextEpisode)
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">Next Episode</h2>
                    <div class="list-group">
                        @each('shows._episodeRow', [$nextEpisode], 'episode')
                    </div>
                </div>
            </div>
        @endif

        @if($show->seasons)
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">Seasons</h2>
                    <div class="list-group">
                        @each('shows._seasonRow', $show->seasons, 'season')
                    </div>
                </div>
            </div>
        @endif

        @if($show->publicWatchlists)
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">Watchlists</h2>
                    <p class="card-text text-muted">
                        This show is currently on {{ $show->publicWatchlists->count() }} public watchlists
                    </p>
                    <div class="list-group">
                        @each('user._watchlistRow', $show->publicWatchlists, 'watchlist')
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
