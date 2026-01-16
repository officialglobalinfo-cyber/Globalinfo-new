<div class="bg-slate-900 text-white py-1 overflow-x-auto" wire:poll.30s>
    <div class="flex space-x-6 px-4 min-w-max">
        @foreach($stocks as $stock)
            <div class="flex items-center space-x-2 text-sm">
                <span class="font-bold text-gray-400">{{ $stock->symbol }}</span>
                <span class="font-mono">{{ $stock->latestPrice?->price }}</span>
                @php $change = $stock->latestPrice?->change ?? 0; @endphp
                <span class="{{ $change >= 0 ? 'text-green-400' : 'text-red-400' }} text-xs">
                    {{ $change >= 0 ? '+' : '' }}{{ $change }}%
                </span>
            </div>
        @endforeach
    </div>
</div>
