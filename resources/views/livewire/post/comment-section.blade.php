<div class="mt-12 pt-8 border-t-2 border-dashed border-neutral-300">
    <h3 class="font-black font-serif text-2xl mb-6">Discussion ({{ $comments->total() }})</h3>

    @auth
        <form wire:submit="postComment" class="mb-8 p-4 bg-neutral-50 border border-neutral-200">
            <label class="block font-bold text-xs uppercase tracking-widest mb-2">Leave a Comment</label>
            <textarea wire:model="content" rows="3" class="w-full border border-black p-3 font-serif placeholder-neutral-400 focus:outline-none focus:border-accent-red transition bg-white mb-2" placeholder="Share your thoughts..."></textarea>
            @error('content') <span class="text-red-600 text-xs font-bold block mb-2">{{ $message }}</span> @enderror
            
            <button type="submit" class="bg-black text-white font-bold uppercase py-2 px-6 tracking-widest hover:bg-accent-red transition text-xs">
                Post Comment
            </button>
        </form>
    @else
        <div class="mb-8 p-6 bg-paper-dark border border-black text-center">
            <p class="font-serif italic mb-2">Join the conversation.</p>
            <a href="{{ route('login') }}" class="inline-block bg-black text-white font-bold uppercase py-2 px-6 tracking-widest hover:bg-accent-red transition text-xs">Sign In to Comment</a>
        </div>
    @endauth

    <div class="space-y-6">
        @forelse($comments as $comment)
        <div class="flex gap-4">
            <div class="w-10 h-10 rounded-full border border-neutral-300 overflow-hidden shrink-0">
                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="{{ $comment->user->name ?? 'User' }}" class="w-full h-full object-cover">
            </div>
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="font-bold font-sans text-sm">{{ $comment->user->name }}</span>
                    <span class="text-xs text-neutral-500 font-serif italic">&bull; {{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-neutral-800 font-serif text-sm leading-relaxed">{{ $comment->content }}</p>
            </div>
        </div>
        @empty
        <p class="text-neutral-500 font-serif italic text-sm">No comments yet. Be the first to start the discussion.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $comments->links() }}
    </div>
</div>
