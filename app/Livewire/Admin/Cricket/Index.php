<?php

namespace App\Livewire\Admin\Cricket;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CricketMatch;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin', ['title' => 'Cricket Management'])]
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.cricket.index', [
            'matches' => CricketMatch::latest('match_time')->paginate(10)
        ]);
    }
}
