<div class="bg-paper-dark border border-black p-4 mt-6">
    <h4 class="font-sans-caption font-bold border-b border-black mb-3 pb-1 flex items-center">
        <span class="w-2 h-2 bg-red-600 rounded-full mr-2 animate-pulse"></span> Trending Now
    </h4>
    <div class="marquee-container overflow-hidden whitespace-nowrap relative h-6">
        <ul class="space-y-2">
            @foreach($trends as $index => $trend)
            <li class="flex items-center text-sm font-bold font-serif border-b border-neutral-300 pb-1 last:border-0">
                <span class="text-neutral-500 mr-2">#{{ $index + 1 }}</span>
                <a href="https://www.google.com/search?q={{ urlencode($trend) }}" target="_blank" class="hover:underline hover:text-accent-red truncate block w-full">
                    {{ $trend }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
