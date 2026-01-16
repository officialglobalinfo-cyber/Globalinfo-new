<?php

namespace App\Livewire\Widgets;

use Livewire\Component;
use App\Models\CricketMatch;

class LiveCricketScore extends Component
{
    public function render()
    {
        // Get live matches or upcoming
        $match = CricketMatch::where('status', 'live')->with('latestScore')->first();
        
        if (!$match) {
            $match = CricketMatch::where('status', 'upcoming')->orderBy('match_time')->first();
        }

        return view('livewire.widgets.live-cricket-score', [
            'match' => $match
        ]);
    }
}
