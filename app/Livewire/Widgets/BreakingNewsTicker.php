<?php

namespace App\Livewire\Widgets;

use Livewire\Component;
use App\Models\News;

class BreakingNewsTicker extends Component
{
    public function render()
    {
        return view('livewire.widgets.breaking-news-ticker', [
            'breakingNews' => News::where('is_breaking', true)->latest()->take(5)->get()
        ]);
    }
}
