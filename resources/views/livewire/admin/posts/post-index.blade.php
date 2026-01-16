<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-xl font-bold text-slate-800">All Posts</h2>
        <a href="{{ route('admin.posts.create') }}" class="bg-[color:var(--primary)] text-white font-bold py-2 px-4 rounded-xl hover:bg-violet-700 transition shadow-glow text-sm" wire:navigate>
            <i class="fa-solid fa-plus mr-2"></i> New Post
        </a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative m-6" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Category</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Views</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900 border-l-4 border-transparent hover:border-violet-500 transition-all">
                        {{ $post->title }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-md bg-gray-100 text-xs font-bold text-gray-600">{{ $post->category->name ?? 'Uncategorized' }}</span>
                    </td>
                    <td class="px-6 py-4">
                         @if($post->published_at)
                            <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">Published</span>
                        @else
                            <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $post->views }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="font-medium text-blue-600 hover:underline" wire:navigate>Edit</a>
                        <button wire:click="delete({{ $post->id }})" wire:confirm="Are you sure?" class="font-medium text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">No posts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6">
        {{ $posts->links() }}
    </div>
</div>
