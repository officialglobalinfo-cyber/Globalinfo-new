<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Privacy extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.pages.privacy')
            ->title('Privacy Policy - Global Info');
    }
}
