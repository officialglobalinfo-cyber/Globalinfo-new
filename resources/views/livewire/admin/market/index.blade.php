<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Market Management</h2>
        <!-- Add Stock Button (Modal ideally) -->
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Add Stock</button>
    </div>

    <div class="bg-white rounded shadow p-4">
        <input type="text" wire:model.live="search" class="w-full p-2 border rounded mb-4" placeholder="Search stocks...">

        <table class="w-full">
            <thead>
                <tr class="text-left border-b">
                    <th class="p-2">Symbol</th>
                    <th class="p-2">Name</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Change</th>
                    <th class="p-2">Active</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2 font-bold">{{ $stock->symbol }}</td>
                    <td class="p-2">{{ $stock->name }}</td>
                    <td class="p-2">{{ $stock->latestPrice?->price ?? '-' }}</td>
                    <td class="p-2 text-{{ $stock->latestPrice?->change > 0 ? 'green' : 'red' }}-600">
                        {{ $stock->latestPrice?->change ?? '-' }}
                    </td>
                    <td class="p-2">
                        <button wire:click="toggleActive({{ $stock->id }})">
                            @if($stock->is_active)
                                <span class="bg-green-100 text-green-700 px-2 rounded-full text-xs">Active</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 rounded-full text-xs">Inactive</span>
                            @endif
                        </button>
                    </td>
                    <td class="p-2">
                        <button class="text-blue-600">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $stocks->links() }}
        </div>
    </div>
</div>
