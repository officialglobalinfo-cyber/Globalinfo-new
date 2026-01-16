<div class="w-full max-w-sm bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-black text-slate-800">Global Admin</h1>
        <p class="text-sm text-slate-500">Sign in to manage your blog</p>
    </div>

    <form wire:submit="login" class="space-y-4">
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-1">Email Address</label>
            <input wire:model="email" type="email" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500 transition">
            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-1">Password</label>
            <input wire:model="password" type="password" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500 transition">
            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full bg-[color:var(--primary)] text-white font-bold py-3 rounded-xl hover:bg-violet-700 transition shadow-glow">
            <span wire:loading.remove>Sign In</span>
            <span wire:loading>Signing In...</span>
        </button>
    </form>
</div>
