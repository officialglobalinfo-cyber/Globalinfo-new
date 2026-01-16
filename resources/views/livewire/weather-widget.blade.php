<div class="flex items-center space-x-2 font-sans-caption text-xs font-bold border-r border-black pr-4 mr-4 hidden md:flex">
    @if(isset($weather['temp']))
        <img src="https://openweathermap.org/img/wn/{{ $weather['icon'] }}@2x.png" alt="{{ $weather['condition'] }}" class="w-8 h-8">
        <div>
            <span class="block">{{ $weather['city'] }}</span>
            <span class="text-accent-red">{{ $weather['temp'] }}°C {{ $weather['condition'] }}</span>
        </div>
    @else
        <span>Weather Unavailable</span>
    @endif
</div>
