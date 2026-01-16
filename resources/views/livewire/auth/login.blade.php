<div class="max-w-md mx-auto my-20 bg-white p-8 border border-neutral-200 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
    <h2 class="text-3xl font-black font-serif text-center mb-8 uppercase tracking-tight">Sign In</h2>

    <form wire:submit="login" class="space-y-6">
        <div>
            <label class="block font-bold text-xs uppercase tracking-widest mb-2">Email Address</label>
            <input type="email" wire:model="email" class="w-full border border-black p-3 font-serif placeholder-neutral-400 focus:outline-none focus:border-accent-red transition bg-neutral-50" placeholder="name@example.com">
            @error('email') <span class="text-red-600 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-bold text-xs uppercase tracking-widest mb-2">Password</label>
            <input type="password" wire:model="password" class="w-full border border-black p-3 font-serif placeholder-neutral-400 focus:outline-none focus:border-accent-red transition bg-neutral-50" placeholder="Your Password">
            @error('password') <span class="text-red-600 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm font-sans font-bold cursor-pointer">
                <input type="checkbox" wire:model="remember" class="w-4 h-4 border-black text-accent-red focus:ring-accent-red">
                <span>Remember Me</span>
            </label>
            <a href="#" class="text-xs font-bold uppercase tracking-wide text-neutral-500 hover:text-black">Forgot Password?</a>
        </div>

        <button type="submit" class="w-full bg-black text-white font-bold uppercase py-3 tracking-widest hover:bg-accent-red transition shadow-lg">
            <span wire:loading.remove>Sign In</span>
            <span wire:loading>Authenticating...</span>
        </button>
    </form>

    <div class="mt-6 text-center text-sm font-serif">
        New to Global Info? <a href="{{ route('register') }}" class="font-bold underline text-accent-red">Create Account</a>
    </div>
</div>
