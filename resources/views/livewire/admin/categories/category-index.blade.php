<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-xl font-bold text-slate-800">All Categories</h2>
        <a href="{{ route('admin.categories.create') }}" class="bg-[color:var(--primary)] text-white font-bold py-2 px-4 rounded-xl hover:bg-violet-700 transition shadow-glow text-sm" wire:navigate>
            <i class="fa-solid fa-plus mr-2"></i> New Category
        </a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative m-6" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded relative m-6" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Slug</th>
                    <th class="px-6 py-3">Color</th>
                    <th class="px-6 py-3">Posts Count</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $category->name }}</td>
                    <td class="px-6 py-4">{{ $category->slug }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-md text-xs font-bold uppercase bg-{{ $category->color }}-100 text-{{ $category->color }}-600 border border-{{ $category->color }}-200">{{ $category->color }}</span>
                    </td>
                    <td class="px-6 py-4">{{ $category->posts_count }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="font-medium text-blue-600 hover:underline" wire:navigate>Edit</a>
                        <button wire:click="delete({{ $category->id }})" wire:confirm="Are you sure?" class="font-medium text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
