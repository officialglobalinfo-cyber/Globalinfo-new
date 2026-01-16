<?php

namespace App\Livewire\Admin\News;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\News;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin', ['title' => 'News Management'])]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $news = News::query()
            ->when($this->search, fn($q) => $q->where('title', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.news.index', [
            'news_items' => $news
        ]);
    }

    public function delete($id)
    {
        News::find($id)->delete();
        session()->flash('success', 'News deleted successfully.');
    }
}
