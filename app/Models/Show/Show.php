<?php

namespace App\Models\Show;

use App\Models\Genre\Genre;
use App\Models\User\User;
use App\Models\Watchlist\Watchlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * App\Models\Show\Show
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genre\Genre[] $genres
 * @property-read int|null $genres_count
 * @property-read \App\Models\Show\Episode|null $nextEpisode
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Watchlist\Watchlist[] $publicWatchlists
 * @property-read int|null $public_watchlists_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Show\Season[] $seasons
 * @property-read int|null $seasons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Watchlist\Watchlist[] $watchlists
 * @property-read int|null $watchlists_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Show newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Show newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Show query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Show whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Show whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Show whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Show whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Show extends Model
{
    protected $table = 'shows';

    public function nextEpisode(): HasOneThrough
    {
        return $this->hasOneThrough(Episode::class, Season::class)
            ->where('aired', '>', now())
            ->orderBy('aired', 'asc');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'show_genres');
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class);
    }

    public function watchlists(): BelongsToMany
    {
        return $this->belongsToMany(Watchlist::class, 'watchlist_shows');
    }

    public function publicWatchlists(): BelongsToMany
    {
        return $this->watchlists()->where('private', '<>', true);
    }

    public function isOnUsersWatchlist(User $user): bool
    {
        return $this->watchlists->contains('user_id', $user->id);
    }
}
