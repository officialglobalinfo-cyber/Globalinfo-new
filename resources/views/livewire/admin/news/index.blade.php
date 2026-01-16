<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">News Management</h2>
        <a href="{{ route('admin.news.create') }}" class="px-4 py-2 bg-violet-600 text-white rounded hover:bg-violet-700" wire:navigate>
            Create News
        </a>
    </div>

    <div class="bg-white rounded shadow p-4">
        <input type="text" wire:model.live="search" class="w-full p-2 border rounded mb-4" placeholder="Search news...">

        <table class="w-full">
            <thead>
                <tr class="text-left border-b">
                    <th class="p-2">Title</th>
                    <th class="p-2">Category</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Created</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news_items as $item)
                <tr class="border-b hover:bg-gray-50" wire:key="{{ $item->id }}">
                    <td class="p-2">{{ $item->title }}</td>
                    <td class="p-2">{{ $item->category->name ?? '-' }}</td>
                    <td class="p-2">{{ $item->status }}</td>
                    <td class="p-2">{{ $item->created_at->format('M d, Y') }}</td>
                    <td class="p-2">
                        <a href="{{ route('admin.news.edit', $item) }}" class="text-blue-600 mr-2" wire:navigate>Edit</a>
                        <button wire:click="delete({{ $item->id }})" class="text-red-600" confirm="Are you sure?">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $news_items->links() }}
        </div>
    </div>
</div>
