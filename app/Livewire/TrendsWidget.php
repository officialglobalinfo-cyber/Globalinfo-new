<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\LiveDataService;

class TrendsWidget extends Component
{
    public function render(LiveDataService $service)
    {
        return view('livewire.trends-widget', [
            'trends' => $service->getTrendingSearches()
        ]);
    }
}
