<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\News;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class CommentSection extends Component
{
    use WithPagination;

    public $newsId;
    public $content;

    public function mount($newsId)
    {
        $this->newsId = $newsId;
    }

    protected $rules = [
        'content' => 'required|min:3|max:500',
    ];

    public function postComment()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate();

        Comment::create([
            'user_id' => Auth::id(),
            'news_id' => $this->newsId,
            'content' => $this->content,
            'status' => 'approved', // Auto-approving for now as per user request flow, or pending if preferred.
        ]);

        $this->reset('content');
        $this->dispatch('comment-added'); // Optional: for notifications
    }

    public function render()
    {
        return view('livewire.post.comment-section', [
            'comments' => Comment::where('news_id', $this->newsId)
                ->where('status', 'approved')
                ->latest()
                ->paginate(5)
        ]);
    }
}
