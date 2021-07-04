<?php

namespace App\Models\Watchlist;

use App\Models\Show\Show;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Watchlist\Watchlist
 *
 * @property int $id
 * @property int $user_id
 * @property bool $private
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Show\Show[] $shows
 * @property-read int|null $shows_count
 * @property-read \App\Models\User\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Watchlist\Watchlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Watchlist\Watchlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Watchlist\Watchlist query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Watchlist\Watchlist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Watchlist\Watchlist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Watchlist\Watchlist wherePrivate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Watchlist\Watchlist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Watchlist\Watchlist whereUserId($value)
 * @mixin \Eloquent
 */
class Watchlist extends Model
{
    protected $table = 'watchlists';

    protected $casts = [
        'private' => 'boolean',
    ];

    protected $fillable = [
        'user_id',
        'private',
    ];

    public function shows(): BelongsToMany
    {
        return $this->belongsToMany(Show::class, 'watchlist_shows');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function togglePrivate(): self
    {
        $this->private = ! $this->private;

        return $this;
    }
}
