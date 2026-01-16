<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('components.layouts.admin', ['title' => 'Manage Post'])]
class PostForm extends Component
{
    use WithFileUploads;

    public ?Post $post = null;

    #[Rule('required|min:3')]
    public $title = '';

    #[Rule('required|unique:posts,slug,except,id')]
    public $slug = '';

    #[Rule('required')]
    public $content = '';

    #[Rule('required|exists:categories,id')]
    public $category_id;

    #[Rule('nullable|image|max:2048')]
    public $newImage;

    public $image; // Existing image path

    public $is_featured = false;
    public $is_trending = false;

    public function mount(Post $post = null)
    {
        if ($post->exists) {
            $this->post = $post;
            $this->title = $post->title;
            $this->slug = $post->slug;
            $this->content = $post->content;
            $this->category_id = $post->category_id;
            $this->image = $post->image;
            $this->is_featured = (bool) $post->is_featured;
            $this->is_trending = (bool) $post->is_trending;
        } else {
            // Default first category if exists
            $this->category_id = Category::first()->id ?? null;
        }
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'is_featured' => $this->is_featured,
            'is_trending' => $this->is_trending,
        ];

        if ($this->newImage) {
            $originalName = pathinfo($this->newImage->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $this->newImage->getClientOriginalExtension();
            // Sanitize filename and append unique ID
            $fileName = Str::slug($originalName) . '-' . uniqid() . '.' . $extension;
            
            $data['image'] = $this->newImage->storeAs('posts', $fileName, 'public');
        }

        if ($this->post && $this->post->exists) {
            $this->post->update($data);
            session()->flash('message', 'Post updated successfully.');
        } else {
            $data['user_id'] = auth()->id();
            $data['published_at'] = now();
            Post::create($data);
            session()->flash('message', 'Post created successfully.');
        }

        return redirect()->route('admin.posts.index');
    }

    public function render()
    {
        return view('livewire.admin.posts.post-form', [
            'categories' => Category::all()
        ]);
    }
}
