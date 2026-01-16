<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('components.layouts.admin', ['title' => 'Manage Category'])]
class CategoryForm extends Component
{
    public ?Category $category = null;

    #[Rule('required|min:3')]
    public $name = '';

    #[Rule('required|unique:categories,slug,except,id')]
    public $slug = '';

    #[Rule('nullable')]
    public $color = 'blue';

    public function mount(?Category $category = null)
    {
        if ($category && $category->exists) {
            $this->category = $category;
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->color = $category->color;
        }
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'color' => $this->color,
        ];

        if ($this->category && $this->category->exists) {
            $this->category->update($data);
            session()->flash('message', 'Category updated successfully.');
        } else {
            Category::create($data);
            session()->flash('message', 'Category created successfully.');
        }

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.category-form');
    }
}
