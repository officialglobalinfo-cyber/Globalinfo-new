<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin', ['title' => 'Categories'])]
class CategoryIndex extends Component
{
    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            if ($category->news()->exists()) {
                 session()->flash('error', 'Cannot delete category with associated posts.');
                 return;
            }
            $category->delete();
            session()->flash('message', 'Category deleted successfully.');
        }
    }

    public function render()
    {
        return view('livewire.admin.categories.category-index', [
            'categories' => Category::withCount('news')->get()
        ]);
    }
}
