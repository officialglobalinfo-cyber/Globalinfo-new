<div wire:poll.5s class="bg-paper rounded-none p-4 font-sans text-ink shadow-none border-2 border-black w-full shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4 pb-2 border-b-2 border-black">
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-accent-red animate-pulse"></span>
            <span class="font-black text-lg font-serif">LIVE CRICKET</span>
        </div>
        <div class="flex gap-3 text-neutral-500 text-sm">
            <i class="fa-solid fa-arrows-rotate hover:text-black cursor-pointer hover:animate-spin"></i>
        </div>
    </div>

    <!-- Match Cards -->
    <div class="space-y-4">
        @foreach($matches as $match)
            @if(isset($match['live']) && $match['live'])
            <!-- Live Match -->
            <div class="bg-white p-3 border border-black relative overflow-hidden group hover:shadow-md transition">
                <div class="flex justify-between items-center mb-3">
                    <!-- Team 1 -->
                    <div class="text-center w-1/4">
                        <span class="text-3xl block mb-1 drop-shadow-sm">{{ $match['team1_flag'] }}</span>
                        <span class="block font-black text-xs uppercase tracking-tight">{{ $match['team1'] }}</span>
                    </div>

                    <!-- VS / Status -->
                    <div class="text-center w-2/4 border-x border-neutral-200">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $match['status_color'] }} text-white uppercase tracking-widest inline-block mb-2">
                            {{ $match['status_label'] }}
                        </span>
                        <div class="flex items-center justify-center gap-1 font-mono font-bold text-lg leading-none">
                            <span>{{ $match['team1_score'] }}</span>
                            <span class="text-neutral-400 text-sm">v</span>
                            @if(isset($match['team2_score']))
                            <span>{{ $match['team2_score'] }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Team 2 -->
                    <div class="text-center w-1/4">
                        <span class="text-3xl block mb-1 drop-shadow-sm">{{ $match['team2_flag'] }}</span>
                        <span class="block font-black text-xs uppercase tracking-tight">{{ $match['team2'] }}</span>
                    </div>
                </div>
                <!-- Commentary Line -->
                <div class="bg-neutral-100 border-t border-dotted border-black pt-2 mt-1 text-center">
                    <p class="text-[10px] font-bold text-neutral-600 font-sans-caption uppercase">{{ $match['note'] ?? 'Match in progress' }}</p>
                </div>
            </div>
            @else
            <!-- Upcoming Match -->
            <div class="bg-neutral-100 p-3 border border-neutral-300 flex justify-between items-center opacity-75 hover:opacity-100 transition">
                <div class="flex items-center gap-3">
                     <div class="text-center w-10">
                        <span class="text-xl block">{{ $match['team1_flag'] }}</span>
                        <span class="text-[9px] font-bold">{{ $match['team1'] }}</span>
                     </div>
                </div>
                
                <div class="text-center px-1">
                    <span class="block font-bold text-xs">{{ $match['date'] }}</span>
                    <span class="block text-[9px] text-neutral-500 uppercase">{{ $match['time'] }}</span>
                </div>

                <div class="flex items-center gap-3">
                     <div class="text-center w-10">
                        <span class="text-xl block">{{ $match['team2_flag'] }}</span>
                        <span class="text-[9px] font-bold">{{ $match['team2'] }}</span>
                     </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>

    <!-- Footer -->
    <div class="mt-4 pt-2 text-center border-t border-neutral-300">
        <a href="#" class="text-black hover:text-accent-red font-bold text-[10px] uppercase tracking-widest">View Scorecard</a>
    </div>
</div>
