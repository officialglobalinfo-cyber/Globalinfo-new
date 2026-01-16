<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\LiveDataService;

class MarketWidget extends Component
{
    public function render(LiveDataService $service)
    {
        return view('livewire.market-widget', [
            'markets' => $service->getMarketData()
        ]);
    }
}
