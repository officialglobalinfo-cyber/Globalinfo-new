<?php

namespace App\Livewire;

use Livewire\Component;

class MarketTicker extends Component
{
    public $sensex;
    public $nifty;
    public $gold;
    public $sensexChange;
    public $niftyChange;

    public function mount()
    {
        $this->sensex = 74500.00;
        $this->nifty = 22600.00;
        $this->gold = 72000;
        $this->sensexChange = 120.50;
        $this->niftyChange = 45.20;
    }

    public function updateMarket()
    {
        // Simulate live fluctuations
        $fluctuation = rand(-50, 80) / 10;
        $this->sensex += $fluctuation;
        $this->sensexChange += $fluctuation;

        $fluctuationNifty = rand(-20, 30) / 10;
        $this->nifty += $fluctuationNifty;
        $this->niftyChange += $fluctuationNifty;
        
        // Random Gold fluctuation
        if(rand(0,5) > 3) {
            $this->gold += rand(-10, 20);
        }
    }

    public function render()
    {
        return view('livewire.market-ticker');
    }
}
