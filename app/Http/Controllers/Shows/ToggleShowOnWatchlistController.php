<?php

namespace App\Http\Controllers\Shows;

use App\Models\Show\Show;
use App\Models\Watchlist\Watchlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ToggleShowOnWatchlistController
{
    public function __invoke(Show $show): RedirectResponse
    {
        $watchlist = Watchlist::firstOrCreate(
            ['user_id' => Auth::user()->id],
            ['private' => false]
        );

        $watchlist->shows()->toggle([$show->id]);

        return redirect()->back();
    }
}
