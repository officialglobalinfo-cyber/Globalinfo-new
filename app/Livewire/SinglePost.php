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
        // Parse content to extract headings and add IDs
        $content = $this->post->content;
        $toc = [];

        // Match h1 through h5 tags
        // This pattern matches the opening tag, content, and closing tag
        $pattern = '/<(h[1-5])\b[^>]*>(.*?)<\/\1>/is';
        
        $content = preg_replace_callback($pattern, function ($matches) use (&$toc) {
            $tagName = strtolower($matches[1]);
            $title = strip_tags($matches[2]);
            
            // Skip empty titles
            if (trim($title) === '') {
                return $matches[0];
            }

            $slug = \Illuminate\Support\Str::slug($title);
            
            // Ensure unique slug
            $originalSlug = $slug;
            $count = 1;
            while (collect($toc)->contains('id', $slug)) {
                $slug = $originalSlug . '-' . $count++;
            }

            // Determine level for indentation & styling
            // We strip the 'h' and use the number directly
            $level = (int) substr($tagName, 1);

            $toc[] = [
                'id' => $slug,
                'title' => $title,
                'level' => $level
            ];

            // Reconstruct tag with ID. 
            return "<$tagName id=\"$slug\">{$matches[2]}</$tagName>";
            
        }, $content);

        // Update post content in memory for this request (not saving to DB)
        $this->post->content = $content;

        return view('livewire.single-post', [
            'toc' => $toc,
            'relatedPosts' => News::where('category_id', $this->post->category_id)
                ->where('id', '!=', $this->post->id)
                ->take(3)
                ->get(),
            'categories' => Category::withCount('news')->get(),
            'latest' => News::latest()->take(5)->get()
        ]);
    }
}
