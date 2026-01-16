<div wire:poll.2s="updateMarket" class="bg-paper border border-black p-4 h-full">
    <div class="flex items-center justify-between border-b border-black pb-2 mb-4">
        <h3 class="font-sans-caption font-bold uppercase text-sm tracking-widest">Dalal Street Live</h3>
        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
    </div>

    <!-- SENSEX -->
    <div class="mb-4">
        <div class="flex justify-between items-baseline mb-1">
            <span class="font-black text-2xl font-serif">SENSEX</span>
            <span class="text-xs text-neutral-500 uppercase">BSE</span>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-3xl font-bold tracking-tight {{ $sensexChange >= 0 ? 'text-green-700' : 'text-red-600' }}">
                {{ number_format($sensex, 2) }}
            </span>
            <div class="flex flex-col text-xs leading-none {{ $sensexChange >= 0 ? 'text-green-700' : 'text-red-600' }}">
                <span class="font-bold">{{ $sensexChange >= 0 ? '+' : '' }}{{ number_format($sensexChange, 2) }}</span>
                <span>({{ number_format(($sensexChange/$sensex)*100, 2) }}%)</span>
            </div>
        </div>
    </div>

    <!-- NIFTY -->
    <div class="mb-4 pt-4 border-t border-neutral-300">
        <div class="flex justify-between items-baseline mb-1">
            <span class="font-black text-xl font-serif">NIFTY 50</span>
            <span class="text-xs text-neutral-500 uppercase">NSE</span>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-2xl font-bold tracking-tight {{ $niftyChange >= 0 ? 'text-green-700' : 'text-red-600' }}">
                {{ number_format($nifty, 2) }}
            </span>
            <span class="font-bold text-xs {{ $niftyChange >= 0 ? 'text-green-700' : 'text-red-600' }}">
                {{ $niftyChange >= 0 ? '+' : '' }}{{ number_format($niftyChange, 2) }}
            </span>
        </div>
    </div>

    <!-- COMMODITIES -->
    <div class="pt-2 border-t border-neutral-300 flex justify-between items-center text-sm">
        <span class="font-bold font-sans-caption uppercase text-ink">Gold (10g)</span>
        <span class="font-mono text-neutral-600">₹{{ number_format($gold) }}</span>
    </div>
</div>
