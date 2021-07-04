<?php

namespace App\Models\Show;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Show\Episode
 *
 * @property int $id
 * @property int $season_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $aired
 * @property int|null $plays
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Show\Season $season
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\User[] $userPlays
 * @property-read int|null $user_plays_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Episode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Episode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Episode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Episode whereAired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Episode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Episode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Episode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Episode wherePlays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Episode whereSeasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Show\Episode whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Episode extends Model
{
    protected $table = 'episodes';

    protected $dates = [
        'aired',
    ];

    public function userPlays(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'episode_plays');
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function hasAired(): bool
    {
        if ($this->aired === null) {
            return false;
        }

        return $this->aired->isPast();
    }

    public function hasUserWatched(User $user): bool
    {
        return $this->userPlays->contains('id', $user->id);
    }

    public function countUserPlays(): self
    {
        $this->plays = $this->userPlays->count();

        return $this;
    }
}
