<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin', ['title' => 'Dashboard'])]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalNews' => \App\Models\News::count(),
            'totalCategories' => Category::count(),
            'breakingNews' => \App\Models\News::where('is_breaking', true)->count(),
            'recentNews' => \App\Models\News::latest()->take(5)->get()
        ]);
    }
}
