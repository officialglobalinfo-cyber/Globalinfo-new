<?php

namespace App\Livewire\Admin\Market;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Stock;
use App\Models\StockPrice;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin', ['title' => 'Market Management'])]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $stocks = Stock::query()
            ->with('latestPrice')
            ->when($this->search, fn($q) => $q->where('symbol', 'like', '%'.$this->search.'%')->orWhere('name', 'like', '%'.$this->search.'%'))
            ->paginate(10);

        return view('livewire.admin.market.index', [
            'stocks' => $stocks
        ]);
    }

    public function toggleActive($id)
    {
        $stock = Stock::find($id);
        $stock->is_active = !$stock->is_active;
        $stock->save();
    }
}
