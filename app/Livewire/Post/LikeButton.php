<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class LikeButton extends Component
{
    public $newsId;
    public $isLiked = false;
    public $likesCount = 0;

    public function mount($newsId)
    {
        $this->newsId = $newsId;
        $this->updateLikes();
    }

    public function updateLikes()
    {
        $news = News::withCount('likes')->find($this->newsId);
        $this->likesCount = $news->likes_count;

        if (Auth::check()) {
            $this->isLiked = $news->hasUserLiked(Auth::id());
        }
    }

    public function toggleLike()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $news = News::find($this->newsId);

        if ($this->isLiked) {
            $news->likes()->where('user_id', Auth::id())->delete();
            $this->isLiked = false;
        } else {
            $news->likes()->create([
                'user_id' => Auth::id()
            ]);
            $this->isLiked = true;
        }

        $this->updateLikes();
    }

    public function render()
    {
        return view('livewire.post.like-button');
    }
}
