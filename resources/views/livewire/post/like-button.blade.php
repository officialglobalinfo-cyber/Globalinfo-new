<button wire:click="toggleLike" class="flex items-center gap-2 group transition hover:text-accent-red {{ $isLiked ? 'text-accent-red' : 'text-neutral-400 text-neutral-600' }}">
    <i class="{{ $isLiked ? 'fa-solid' : 'fa-regular' }} fa-heart text-lg group-hover:scale-110 transition-transform"></i>
    <span class="text-sm font-bold font-sans">{{ $likesCount }} {{ Str::plural('Like', $likesCount) }}</span>
</button>
