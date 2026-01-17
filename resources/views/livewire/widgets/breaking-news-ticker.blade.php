<div class="bg-red-600 text-white py-2 px-4 flex items-center overflow-hidden">
    <span class="font-bold bg-red-800 px-2 py-0.5 rounded text-xs mr-4 uppercase tracking-wider">Breaking</span>
    <div class="flex-1 overflow-hidden relative h-6">
       <div class="animate-marquee whitespace-nowrap absolute">
            @foreach($breakingNews as $news)
                <a href="{{ route('post', $news->slug) }}" class="mr-8 hover:underline">{{ $news->title }}</a>
                <span class="mr-8 text-red-300">•</span>
            @endforeach
       </div>
    </div>

</div>
