<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-violet-50 flex items-center justify-center text-violet-600">
                    <i class="fa-solid fa-newspaper text-xl"></i>
                </div>
                <span class="text-xs font-bold text-gray-400 uppercase">Total News</span>
            </div>
            <h2 class="text-3xl font-black text-slate-800">{{ $totalNews }}</h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                    <i class="fa-solid fa-folder-tree text-xl"></i>
                </div>
                <span class="text-xs font-bold text-gray-400 uppercase">Categories</span>
            </div>
            <h2 class="text-3xl font-black text-slate-800">{{ $totalCategories }}</h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-600">
                    <i class="fa-solid fa-bullhorn text-xl"></i>
                </div>
                <span class="text-xs font-bold text-gray-400 uppercase">Breaking</span>
            </div>
            <h2 class="text-3xl font-black text-slate-800">{{ $breakingNews }}</h2>
        </div>
    </div>

    <!-- Recent News Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800">Recent News</h3>
            <a href="{{ route('admin.news.index') }}" class="text-sm font-bold text-violet-600 hover:text-violet-700" wire:navigate>View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Title</th>
                        <th class="px-6 py-3">Source</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentNews as $news)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $news->title }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-md bg-gray-100 text-xs font-bold text-gray-600">{{ $news->source->name ?? 'Manual' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($news->status == 'published')
                                <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">Published</span>
                            @else
                                <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">{{ ucfirst($news->status) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $news->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400">No news yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
