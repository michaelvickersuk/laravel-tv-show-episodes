<?php

namespace App\Http\Controllers\Shows;

use App\Models\Show\Show;
use Illuminate\View\View;

class ShowController
{
    public function __invoke(Show $show): View
    {
        $show->load([
            'genres',
            'seasons',
            'publicWatchlists.user',
        ]);

        return view('shows.show', [
            'show' => $show,
            'nextEpisode' => $show->nextEpisode,
        ]);
    }
}
