<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\LiveDataService;

class CricketWidget extends Component
{
    public function render(LiveDataService $service)
    {
        return view('livewire.cricket-widget', [
            'matches' => $service->getCricketMatches()
        ]);
    }
}
