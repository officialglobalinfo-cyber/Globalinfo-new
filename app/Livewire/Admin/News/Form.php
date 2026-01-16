<?php

namespace App\Livewire\Admin\News;

use Livewire\Component;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin', ['title' => 'News Editor'])]
class Form extends Component
{
    use WithFileUploads;

    public ?News $news = null;
    public $title;
    public $slug;
    public $content;
    public $category_id;
    public $image;
    public $existingImage;
    public $status = 'draft';
    public $is_breaking = false;

    // SEO Fields
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $canonical_url;
    public $robots = 'index, follow';
    public $og_title;
    public $og_description;
    public $og_image;
    public $twitter_title;
    public $twitter_description;

    public function mount(?News $news = null)
    {
        if ($news && $news->exists) {
            $this->news = $news;
            $this->title = $news->title;
            $this->slug = $news->slug;
            $this->content = $news->content;
            $this->category_id = $news->category_id;
            $this->existingImage = $news->image;
            $this->status = $news->status;
            $this->status = $news->status;
            $this->is_breaking = $news->is_breaking;
            
            // Load SEO
            $this->meta_title = $news->meta_title;
            $this->meta_description = $news->meta_description;
            $this->meta_keywords = $news->meta_keywords;
            $this->canonical_url = $news->canonical_url;
            $this->robots = $news->robots;
            $this->og_title = $news->og_title;
            $this->og_description = $news->og_description;
            $this->og_image = $news->og_image;
            $this->twitter_title = $news->twitter_title;
            $this->twitter_description = $news->twitter_description;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required|unique:news,slug,' . ($this->news->id ?? 'NULL'),
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:10240', // 10MB Max
        ]);

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'is_breaking' => $this->is_breaking,
            
            // Save SEO
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'canonical_url' => $this->canonical_url,
            'robots' => $this->robots,
            'og_title' => $this->og_title,
            'og_description' => $this->og_description,
            'og_image' => $this->og_image,
            'twitter_title' => $this->twitter_title,
            'twitter_description' => $this->twitter_description,
        ];

        if ($this->image) {
            // Delete old image if exists
            // Since we are moving to direct public, we check if it starts with 'images/' or old path
            if ($this->news && $this->news->image) {
                if(Str::startsWith($this->news->image, 'images/')) {
                     $oldPath = public_path($this->news->image);
                     if(file_exists($oldPath)) {
                         unlink($oldPath);
                     }
                } else {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($this->news->image);
                }
            }
            
            // Generate a clean filename
            $filename = Str::slug(pathinfo($this->image->getClientOriginalName(), PATHINFO_FILENAME)) 
                . '-' . time() 
                . '.' . $this->image->getClientOriginalExtension();
            
            // Store directly to public/images/news
            $destinationPath = public_path('images/news');
            if(!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            // Move the file manually from the temporary Livewire path to our public folder
            file_put_contents($destinationPath . '/' . $filename, file_get_contents($this->image->getRealPath()));
            
            $data['image'] = 'images/news/' . $filename;
        }

        if ($this->news) {
            $this->news->update($data);
        } else {
            $data['user_id'] = auth()->id() ?? 1; // Default to admin
            News::create($data);
        }

        return redirect()->route('admin.news.index');
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function render()
    {
        return view('livewire.admin.news.form', [
            'categories' => Category::all()
        ]);
    }
}
