<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use App\Models\Category;

class Header extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', 1)->inRandomOrder()->take(5)->get();
        return view('livewire.partials.header', [
            'categories' => $categories
        ]);
    }
}
