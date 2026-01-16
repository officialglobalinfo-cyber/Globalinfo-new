<div wire:poll.2s class="bg-paper rounded-none p-4 font-sans text-ink shadow-none border-2 border-black w-full shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4 border-b-2 border-black pb-2">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-arrow-trend-up text-accent-red"></i>
            <span class="font-black text-lg font-serif">MARKETS</span>
        </div>
        <button class="text-neutral-500 hover:text-black"><i class="fa-solid fa-ellipsis"></i></button>
    </div>

    <!-- Market Items -->
    <div class="space-y-0 text-ink divide-y divide-neutral-300">
        @foreach($markets as $market)
        <div class="flex items-center justify-between group cursor-pointer hover:bg-neutral-100 py-3 transition">
            <!-- Left: Name & Symbol -->
            <div class="w-1/3">
                <span class="block font-black text-sm">{{ $market['symbol'] }}</span>
                <span class="block text-xs text-neutral-500 truncate font-sans-caption uppercase tracking-wider">{{ $market['name'] }}</span>
            </div>

            <!-- Center: Sparkline (SVG) -->
            <div class="w-1/4 h-6 flex items-center justify-center">
                <svg viewBox="0 0 100 40" class="w-full h-full fill-none stroke-2 {{ $market['up'] ? 'stroke-green-700' : 'stroke-red-700' }} opacity-80" preserveAspectRatio="none">
                    @if($market['up'])
                        <path d="M0,35 Q20,30 30,20 T60,15 T100,5" />
                    @else
                        <path d="M0,10 Q30,15 50,25 T90,30 T100,35" />
                    @endif
                </svg>
            </div>

            <!-- Right: Price & Change -->
            <div class="w-1/3 text-right">
                <span class="block font-bold text-sm {{ $market['up'] ? 'text-green-700' : 'text-red-700' }}">{{ $market['change'] }}</span>
                <span class="block text-xs font-mono text-black font-bold">{{ $market['price'] }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Footer -->
    <div class="mt-4 pt-3 border-t-2 border-black flex justify-between items-center text-xs">
        <span class="font-sans-caption uppercase text-[10px] text-neutral-500 font-bold">Live Data</span>
        <a href="#" class="text-accent-red hover:underline font-bold uppercase tracking-wider">Full Market ></a>
    </div>
</div>
