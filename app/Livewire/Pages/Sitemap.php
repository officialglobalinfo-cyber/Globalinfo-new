<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Sitemap extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.pages.sitemap')
            ->title('Sitemap - Global Info');
    }
}
