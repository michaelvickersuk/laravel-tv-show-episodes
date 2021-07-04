<?php /** @var \App\Models\Show\Episode $mostWatchedEpisodes */ ?>
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">Most watched episodes</h2>
                <div class="list-group">
                    @each('shows._episodeRow', $mostWatchedEpisodes, 'episode')
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">What's on next</h2>
                <div class="list-group">
                    @each('shows._episodeRow', $upcomingEpisodes, 'episode')
                </div>
            </div>
        </div>
    </div>
@endsection
