<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\LiveDataService;

class WeatherWidget extends Component
{
    public $city = 'New Delhi';

    public function render(LiveDataService $service)
    {
        return view('livewire.weather-widget', [
            'weather' => $service->getWeather($this->city)
        ]);
    }
}
