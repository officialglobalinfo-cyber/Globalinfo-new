<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class CategoryPage extends Component
{
    use WithPagination;

    public Category $category;

    public function mount($slug)
    {
        $this->category = Category::where('slug', $slug)->firstOrFail();
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.category-page', [
            'posts' => $this->category->news()->latest()->paginate(9),
            'categories' => Category::withCount('news')->get(),
            'popularPosts' => \App\Models\News::orderBy('views', 'desc')->take(4)->get()
        ]);
    }
}
