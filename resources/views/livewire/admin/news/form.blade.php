<div>
    <h2 class="text-2xl font-bold mb-6">{{ $news ? 'Edit' : 'Create' }} News</h2>

    <form wire:submit="save" class="bg-white p-6 rounded shadow space-y-4">
        <div>
            <label class="block font-bold mb-1">Title</label>
            <input type="text" wire:model.live="title" class="w-full p-2 border rounded">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-bold mb-1">Slug</label>
            <input type="text" wire:model="slug" class="w-full p-2 border rounded bg-gray-50">
        </div>

        <div>
            <label class="block font-bold mb-1">Category</label>
            <select wire:model="category_id" class="w-full p-2 border rounded">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-bold mb-1">Content</label>
            <div wire:ignore x-data="{ content: @entangle('content') }" x-init="
                ClassicEditor.create($refs.editor)
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        $dispatch('input', editor.getData());
                        @this.set('content', editor.getData());
                    });
                })
                .catch(error => {
                    console.error(error);
                });
            ">
                <textarea x-ref="editor" wire:model="content" class="w-full p-2 border rounded h-40"></textarea>
            </div>
        </div>

        <div>
            <label class="block font-bold mb-1">Image</label>
            <div class="mb-2">
                @if($image)
                    <img src="{{ $image->temporaryUrl() }}" alt="New Image Preview" class="w-32 h-32 object-cover border border-gray-300 rounded">
                @elseif($existingImage)
                    <img src="{{ Str::startsWith($existingImage, 'images/') ? asset($existingImage) : asset('storage/'.$existingImage) }}" alt="Current Image" class="w-32 h-32 object-cover border border-gray-300 rounded">
                @endif
            </div>
            <input type="file" wire:model="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 transition">
            @error('image') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center space-x-4">
            <label class="flex items-center">
                <input type="checkbox" wire:model="is_breaking" class="mr-2"> Breaking News
            </label>
            
            <select wire:model="status" class="p-2 border rounded">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="scheduled">Scheduled</option>
            </select>
        </div>

        <div x-data="{ open: false }" class="border border-gray-200 rounded p-4">
            <button type="button" @click="open = !open" class="flex justify-between items-center w-full font-bold text-gray-700">
                <span><i class="fa-solid fa-search mr-2"></i> SEO & Social Media</span>
                <i :class="open ? 'fa-angle-up' : 'fa-angle-down'" class="fa-solid"></i>
            </button>
            <div x-show="open" class="mt-4 space-y-4 border-t pt-4">
                
                <h3 class="font-bold text-sm uppercase text-gray-500 border-b pb-1">Search Engine Optimization</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold mb-1">Meta Title</label>
                        <input type="text" wire:model="meta_title" class="w-full p-2 border rounded text-sm" placeholder="Leave empty to use Post Title">
                        <span class="text-xs text-gray-400">Recommended: 60 chars</span>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Canonical URL</label>
                        <input type="text" wire:model="canonical_url" class="w-full p-2 border rounded text-sm" placeholder="e.g. https://original-source.com/...">
                    </div>
                </div>
                <div>
                     <label class="block text-sm font-bold mb-1">Meta Description</label>
                     <textarea wire:model="meta_description" class="w-full p-2 border rounded text-sm h-20" placeholder="Summary for Google search results..."></textarea>
                     <span class="text-xs text-gray-400">Recommended: 160 chars</span>
                </div>
                <div>
                     <label class="block text-sm font-bold mb-1">Meta Keywords</label>
                     <input type="text" wire:model="meta_keywords" class="w-full p-2 border rounded text-sm" placeholder="news, india, breaking, politics (comma separated)">
                </div>
                 <div>
                     <label class="block text-sm font-bold mb-1">Robots</label>
                     <select wire:model="robots" class="w-full p-2 border rounded text-sm">
                         <option value="index, follow">Index, Follow (Default)</option>
                         <option value="noindex, nofollow">No Index, No Follow</option>
                         <option value="index, nofollow">Index, No Follow</option>
                     </select>
                </div>

                <h3 class="font-bold text-sm uppercase text-gray-500 border-b pb-1 mt-6">Social Media (Facebook / Twitter)</h3>
                <div class="grid grid-cols-2 gap-4">
                     <div>
                        <label class="block text-sm font-bold mb-1">OG Title</label>
                        <input type="text" wire:model="og_title" class="w-full p-2 border rounded text-sm" placeholder="Facebook Title">
                    </div>
                    <div>
                         <label class="block text-sm font-bold mb-1">Twitter Title</label>
                         <input type="text" wire:model="twitter_title" class="w-full p-2 border rounded text-sm" placeholder="Twitter Card Title">
                    </div>
                     <div class="col-span-2">
                        <label class="block text-sm font-bold mb-1">OG Description</label>
                        <input type="text" wire:model="og_description" class="w-full p-2 border rounded text-sm" placeholder="Description for Facebook shares">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
    </form>
</div>
