<div wire:poll.3s="updateScore" class="bg-paper border border-black p-4 relative overflow-hidden group">
    <!-- Live Badge -->
    <div class="absolute top-2 right-2 flex items-center gap-1.5 bg-red-600 text-white px-2 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider animate-pulse">
        <span class="w-1.5 h-1.5 bg-white rounded-full"></span> Live
    </div>

    <h3 class="font-sans-caption font-bold text-xs uppercase text-neutral-500 mb-2">3rd Test • Melbourne</h3>
    
    <div class="flex justify-between items-end mb-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <img src="https://flagcdn.com/w40/in.png" alt="India Flag" class="w-6 h-4 object-cover border border-black shadow-sm">
                <span class="font-black text-2xl font-serif">IND</span>
            </div>
            <div class="text-3xl font-black font-serif leading-none">
                {{ $runs }}/{{ $wickets }}
            </div>
            <div class="text-sm text-neutral-600 font-sans mt-1">
                Overs: <span class="font-bold text-black">{{ number_format($overs, 1) }}</span>
            </div>
        </div>
        <div class="text-right opacity-50">
             <div class="flex items-center gap-2 mb-1 justify-end">
                <span class="font-bold text-lg font-serif">AUS</span>
                <img src="https://flagcdn.com/w40/au.png" alt="Australia Flag" class="w-6 h-4 object-cover border border-black shadow-sm">
            </div>
            <div class="text-lg font-bold">1st Inn</div>
        </div>
    </div>

    <!-- Batsmen -->
    <div class="border-t border-neutral-300 pt-2 space-y-1 text-sm font-sans">
        <div class="flex justify-between">
            <span class="font-bold text-ink">Kohli*</span>
            <span class="font-mono">{{ $strikerScore }}</span>
        </div>
        <div class="flex justify-between text-neutral-500">
            <span>Rahul</span>
            <span class="font-mono">{{ $nonStrikerScore }}</span>
        </div>
    </div>
    
    <div class="mt-3 text-[10px] text-center bg-black text-white py-1 uppercase tracking-widest font-bold">
        Last Ball: {{ $lastBall == '' ? '...' : ($lastBall == 'W' ? 'WICKET!' : $lastBall . ' Runs') }}
    </div>
</div>
