<div class="list-group-item d-flex justify-content-between align-items-center">
    <div>
        <p class="small mb-1">
            <a href="{{ route('show', $episode->season->show) }}" class="text-muted">{{ $episode->season->show->name }}</a>
            &gt;
            <a href="{{ route('show.season', $episode->season) }}" class="text-muted">{{ $episode->season->name }}</a>
        </p>
        <p class="mb-1">
            <a href="{{ route('show.episode', $episode) }}">{{ $episode->name }}</a>
        </p>
        <p class="mb-0">
            <span class="text-muted small">Aired: {{ $episode->aired->format('j M Y') }}</span>
        </p>
    </div>
    <div>
        {{ $episode->plays ?? 0 }} plays
    </div>
</div>
