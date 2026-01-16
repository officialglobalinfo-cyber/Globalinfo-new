<?php

namespace App\Livewire;

use Livewire\Component;

class CricketScore extends Component
{
    public $runs = 245;
    public $wickets = 3;
    public $overs = 38.2;
    public $strikerScore = 87;
    public $nonStrikerScore = 32;
    public $lastBall = '';

    public function updateScore()
    {
        // Simulate ball
        $events = [0, 1, 0, 1, 2, 4, 0, 1, 6, 'W'];
        $outcome = $events[array_rand($events)];

        $this->lastBall = $outcome;

        if ($outcome === 'W') {
            $this->wickets++;
            $this->strikerScore = 0; // New batsman
        } else {
            $this->runs += $outcome;
            $this->strikerScore += $outcome;
        }

        // Increment overs
        $balls = round(($this->overs - floor($this->overs)) * 10);
        $balls++;
        if ($balls >= 6) {
            $this->overs = floor($this->overs) + 1;
        } else {
            $this->overs = floor($this->overs) + ($balls / 10);
        }
    }

    public function render()
    {
        return view('livewire.cricket-score');
    }
}
