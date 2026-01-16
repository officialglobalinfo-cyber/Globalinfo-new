<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News;
use App\Models\Category;
use Livewire\Attributes\Layout;

class SinglePost extends Component
{
    public $post; // Keeping variable name $post for view compatibility

    public function mount($slug)
    {
        $this->post = News::where('slug', $slug)
            ->with(['author.role', 'category'])
            ->withCount('comments')
            ->firstOrFail();
        
        // Increment views
        $this->post->increment('views');
    }


    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.single-post', [
            'relatedPosts' => News::where('category_id', $this->post->category_id)
                ->where('id', '!=', $this->post->id)
                ->take(3)
                ->get(),
            'categories' => Category::withCount('news')->get(),
            'latest' => News::latest()->take(5)->get()
        ]);
    }
}
