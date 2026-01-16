@section('meta_title', $category->name . ' - Global Info News')
@section('meta_description', 'Latest ' . $category->name . ' news, analysis, and updates from Global Info. Read in-depth stories on ' . $category->name . '.')
@section('meta_keywords', $category->name . ', news, latest updates, global info')
@section('canonical_url', route('category', $category->slug))
@section('og_title', $category->name . ' - Global Info News')
@section('og_description', 'Latest ' . $category->name . ' news, analysis, and updates from Global Info.')
@section('og_image', asset('images/logolight.png'))
@section('twitter_title', $category->name . ' - Global Info News')
@section('twitter_description', 'Latest ' . $category->name . ' news, analysis, and updates from Global Info.')

@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "CollectionPage",
  "mainEntityOfPage": {
    "@@type": "WebPage",
    "@@id": "{{ route('category', $category->slug) }}"
  },
  "headline": "{{ $category->name }}",
  "description": "Latest {{ $category->name }} news and updates from Global Info.",
  "url": "{{ route('category', $category->slug) }}"
}
</script>
@endpush



<div class="pb-20">
    <!-- Header (Classic Masthead Style) -->
    <div class="max-w-screen-2xl mx-auto px-4 md:px-6 py-12 text-center border-b-4 border-double border-black mb-12">
        <span class="inline-block py-1 px-3 border border-black text-[10px] font-bold uppercase tracking-widest mb-4 font-sans">Topic Archive</span>
        <h1 class="text-5xl md:text-7xl font-black mb-4 font-serif tracking-tight">{{ $category->name }}</h1>
        <p class="text-lg text-neutral-600 max-w-2xl mx-auto font-serif italic">Complete coverage and analysis on {{ strtolower($category->name) }} from our editors.</p>
    </div>

    <div class="max-w-screen-2xl mx-auto px-4 md:px-6">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <!-- Main Grid -->
            <div class="lg:w-2/3">
                <div class="space-y-12">
                     @forelse($posts as $post)
                    <article class="flex flex-col md:flex-row gap-8 pb-8 border-b border-neutral-300 group">
                        <div class="md:w-1/3 aspect-[4/3] border border-black overflow-hidden relative">
                            <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : ($post->image ? asset($post->image) : asset('images/logolight.png')) }}" alt="{{ $post->title }}" class="w-full h-full object-contain transition duration-700">
                        </div>
                        <div class="md:w-2/3 flex flex-col justify-center">
                            <div class="flex items-center gap-2 text-[10px] font-bold text-accent-red uppercase tracking-wider mb-2 font-sans">
                                <span>{{ $post->category->name }}</span>
                                <span class="text-neutral-400">&bull;</span>
                                <span class="text-neutral-500">{{ $post->created_at->format('M d, Y') }}</span>
                            </div>
                            <h3 class="text-2xl font-bold leading-tight text-ink group-hover:underline transition mb-3 font-serif">
                                <a href="{{ route('post', $post->slug) }}" wire:navigate>{{ $post->title }}</a>
                            </h3>
                            <p class="text-sm text-neutral-600 line-clamp-3 mb-4 font-serif leading-relaxed">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                            <a href="{{ route('post', $post->slug) }}" class="inline-flex items-center text-xs font-bold text-black uppercase tracking-wide hover:text-accent-red mt-auto font-sans" wire:navigate>Read Full Story <i class="fa-solid fa-arrow-right ml-2 text-[10px]"></i></a>
                        </div>
                    </article>
                    @empty
                    <div class="text-center py-20 border border-black p-8 bg-paper-dark">
                        <i class="fa-regular fa-folder-open text-4xl mb-4 text-neutral-400"></i>
                        <h3 class="text-xl font-bold text-ink mb-2">No Stories Found</h3>
                         <p class="text-neutral-600 text-sm font-serif italic">Our journalists are working on stories for this section.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-12 pt-6 border-t border-black flex justify-between font-sans font-bold text-sm uppercase">
                    <!-- Simple pagination buttons since we can't easily style the default Laravel one completely without publishing views, but assuming standard output works okay with text-ink. 
                         Ideally we would customize the pagination view, but for now relying on global styles. -->
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:w-1/3 space-y-10 pl-0 lg:pl-8 border-l border-neutral-300">
                 <!-- Categories Widget -->
                <div class="bg-paper p-0">
                    <h3 class="font-sans-caption font-bold border-b border-black mb-4 pb-1">Sections</h3>
                    <ul class="space-y-0 divide-y divide-neutral-200 border-x border-t border-b border-neutral-200">
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('category', $cat->slug) }}" class="flex justify-between items-center px-4 py-3 bg-paper hover:bg-paper-dark group transition" wire:navigate>
                                <span class="text-xs font-bold uppercase font-sans {{ $cat->id == $category->id ? 'text-accent-red pl-2' : 'text-neutral-600' }} transition-all">{{ $cat->name }}</span>
                                <span class="text-[10px] bg-neutral-200 text-neutral-600 px-2 py-0.5 rounded-full">{{ $cat->news_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Popular Posts -->
                <div>
                    <h3 class="font-sans-caption font-bold border-b border-black mb-4 pb-1">Most Read</h3>
                    <div class="space-y-6">
                        @foreach($popularPosts as $popular)
                        <a href="{{ route('post', $popular->slug) }}" class="flex gap-4 group" wire:navigate>
                            <span class="text-3xl font-black text-neutral-200 group-hover:text-accent-red transition -mt-2 font-serif">0{{ $loop->iteration }}</span>
                            <div>
                                <h4 class="text-sm font-bold text-ink group-hover:underline transition leading-tight mb-1 font-serif">{{ $popular->title }}</h4>
                                <span class="text-[10px] text-neutral-400 font-bold uppercase font-sans">{{ $popular->created_at->format('M d') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
