<div>
    @if($match)
    <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-600" wire:poll.10s>
        <div class="flex justify-between items-start mb-2">
            <span class="text-xs font-bold text-blue-600 uppercase">{{ $match->series_name }}</span>
            <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded animate-pulse">LIVE</span>
        </div>
        <div class="flex justify-between items-center">
            <div class="text-center">
                <div class="font-bold text-gray-800">{{ $match->team_home }}</div>
                <div class="text-xl font-black">{{ $match->latestScore->home_score ?? '-' }}</div>
            </div>
            <div class="text-gray-400 text-xs font-bold">VS</div>
            <div class="text-center">
                <div class="font-bold text-gray-800">{{ $match->team_away }}</div>
                <div class="text-xl font-black">{{ $match->latestScore->away_score ?? '-' }}</div>
            </div>
        </div>
        <div class="mt-2 text-center text-sm text-gray-600">
            {{ $match->latestScore->status_text ?? 'Match Starting Soon' }}
        </div>
    </div>
    @endif
</div>
