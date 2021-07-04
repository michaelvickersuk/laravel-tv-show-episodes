<?php

namespace App\Http\Controllers\Watchlist;

use App\Models\Watchlist\Watchlist;
use Illuminate\Http\RedirectResponse;

class ChangeWatchlistVisibilityController
{
    public function __invoke(Watchlist $watchlist): RedirectResponse
    {
        $watchlist->togglePrivate()->save();

        return redirect()->back();
    }
}
