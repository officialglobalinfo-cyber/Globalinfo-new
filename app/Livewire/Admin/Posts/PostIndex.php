<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin', ['title' => 'Posts'])]
class PostIndex extends Component
{
    use WithPagination;

    public function delete($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            session()->flash('message', 'Post deleted successfully.');
        }
    }

    public function render()
    {
        return view('livewire.admin.posts.post-index', [
            'posts' => Post::with('category')->latest()->paginate(10)
        ]);
    }
}
