<div class="max-w-xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">{{ $category ? 'Edit Category' : 'Create New Category' }}</h2>
        <a href="{{ route('admin.categories.index') }}" class="text-slate-500 hover:text-slate-800 font-bold text-sm" wire:navigate>Cancel</a>
    </div>

    <form wire:submit="save" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 space-y-6">
        
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-1">Name</label>
            <input wire:model.live="name" type="text" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500 transition">
            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-1">Slug</label>
            <input wire:model="slug" type="text" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500 transition">
            @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-1">Color Theme</label>
            <select wire:model="color" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500 transition">
                <option value="blue">Blue</option>
                <option value="violet">Violet</option>
                <option value="pink">Pink</option>
                <option value="amber">Amber</option>
                <option value="emerald">Emerald</option>
                <option value="cyan">Cyan</option>
                <option value="red">Red</option>
            </select>
            <p class="text-xs text-slate-400 mt-1">Used for badges and accents.</p>
        </div>

        <div class="pt-6 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-[color:var(--primary)] text-white font-bold py-3 px-8 rounded-xl hover:bg-violet-700 transition shadow-glow">
                Save Category
            </button>
        </div>
    </form>
</div>
