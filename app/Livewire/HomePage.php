<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News;
use App\Models\Category;
use Livewire\Attributes\Layout;

class HomePage extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        $query = request('search');

        if ($query) {
            $searchResults = News::where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->where('status', 'published')
                ->latest()
                ->get();

            return view('livewire.home-page', [
                'searchResults' => $searchResults,
                'searchQuery' => $query,
                'categories' => Category::withCount('news')->get(),
            ]);
        }

        return view('livewire.home-page', [
            'featuredPosts' => \App\Models\News::where('is_featured', true)->where('status', 'published')->take(5)->get(),
            'trendingPosts' => \App\Models\News::where('is_breaking', true)->where('status', 'published')->latest()->take(10)->get(), 
            'latestPosts' => \App\Models\News::where('status', 'published')->latest()->take(25)->get(),
            'editorPicks' => \App\Models\News::where('is_featured', true)->where('status', 'published')->skip(5)->take(10)->get(),
            'sportsPosts' => \App\Models\News::where('category_id', 5)->where('status', 'published')->latest()->take(10)->get(),
            'categories' => Category::withCount('news')->get(),
            'headlines' => \App\Models\News::where('status', 'published')->latest()->take(5)->get(),
        ]);
    }
}
