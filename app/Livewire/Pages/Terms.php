<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Terms extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.pages.terms')
            ->title('Terms & Conditions - Global Info');
    }
}
