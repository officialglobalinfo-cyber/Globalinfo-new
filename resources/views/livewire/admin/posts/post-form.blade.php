<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">{{ $post ? 'Edit Post' : 'Create New Post' }}</h2>
        <a href="{{ route('admin.posts.index') }}" class="text-slate-500 hover:text-slate-800 font-bold text-sm" wire:navigate>Cancel</a>
    </div>

    <form wire:submit="save" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 space-y-6">
        
        <!-- Title & Slug -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Title</label>
                <input wire:model.live="title" type="text" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500 transition">
                @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Slug</label>
                <input wire:model="slug" type="text" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500 transition">
                @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Category & Image -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Category</label>
                <select wire:model="category_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500 transition">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            
             <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">Featured Image</label>
                <input wire:model="newImage" type="file" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
                @if ($newImage)
                    <img src="{{ $newImage->temporaryUrl() }}" alt="Preview" class="mt-2 h-20 w-auto rounded-lg shadow-sm">
                @elseif($image)
                    <img src="{{ asset('storage/'.$image) }}" alt="Current Image" class="mt-2 h-20 w-auto rounded-lg shadow-sm">
                @endif
                @error('newImage') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Content -->
        <!-- Content -->
        <div wire:ignore>
            <label class="block text-sm font-bold text-slate-700 mb-1">Content</label>
            <textarea id="content" wire:model="content" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-violet-500 transition font-mono text-sm"></textarea>
            
             <!-- Custom Styles for Editor to match User Request (Enter = No huge gap) -->
             <style>
                .ck-editor__editable_inline {
                    min-height: 400px;
                }
                /* Single enter (p) should have no margin */
                .ck-content p {
                    margin-bottom: 0 !important;
                    margin-top: 0 !important;
                }
                /* Restore List Styles defined by Tailwind Reset */
                .ck-content ul {
                    list-style-type: disc !important;
                    padding-left: 2rem !important;
                    margin-bottom: 1rem !important;
                }
                .ck-content ol {
                    list-style-type: decimal !important;
                    padding-left: 2rem !important;
                    margin-bottom: 1rem !important;
                }
                .ck-content blockquote {
                    border-left: 4px solid #ccc;
                    padding-left: 1rem;
                    font-style: italic;
                    margin-left: 0;
                    margin-right: 0;
                }
                .ck-content h2 { font-size: 1.5em; font-weight: bold; margin-top: 1em; margin-bottom: 0.5em; }
                .ck-content h3 { font-size: 1.25em; font-weight: bold; margin-top: 1em; margin-bottom: 0.5em; }
            </style>

            <script>
                function initCkEditor() {
                    const contentElement = document.querySelector('#content');
                    // Check if element exists and instance doesn't (we can check by looking for .ck-editor sibling or similar, but simpler to just try/catch or use a flag)
                    // Actually, if we use wire:navigate from another page, the DOM is replaced, so previous editor is gone.
                    if (contentElement && !contentElement.nextElementSibling?.classList.contains('ck-editor')) {
                         ClassicEditor
                            .create(contentElement, {
                                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
                            })
                            .then(editor => {
                                editor.model.document.on('change:data', () => {
                                    @this.set('content', editor.getData(), false);
                                });
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    }
                }

                // Initialize on first load
                document.addEventListener('livewire:initialized', initCkEditor);
                // Initialize on navigation
                document.addEventListener('livewire:navigated', initCkEditor);
            </script>
        </div>
        @error('content') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

        <!-- Switches -->
        <div class="flex gap-8">
            <label class="flex items-center gap-3 cursor-pointer">
                <input wire:model="is_featured" type="checkbox" class="w-5 h-5 text-violet-600 rounded focus:ring-violet-500 border-gray-300">
                <span class="text-sm font-bold text-slate-700">Featured Post</span>
            </label>
             <label class="flex items-center gap-3 cursor-pointer">
                <input wire:model="is_trending" type="checkbox" class="w-5 h-5 text-violet-600 rounded focus:ring-violet-500 border-gray-300">
                <span class="text-sm font-bold text-slate-700">Trending Now</span>
            </label>
        </div>

        <div class="pt-6 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-[color:var(--primary)] text-white font-bold py-3 px-8 rounded-xl hover:bg-violet-700 transition shadow-glow">
                Save Post
            </button>
        </div>
    </form>
</div>
