<?php

namespace App\Livewire\Widgets;

use Livewire\Component;
use App\Models\Stock;

class MarketTicker extends Component
{
    public function render()
    {
        return view('livewire.widgets.market-ticker', [
            'stocks' => Stock::where('is_active', true)->with('latestPrice')->get()
        ]);
    }
}
