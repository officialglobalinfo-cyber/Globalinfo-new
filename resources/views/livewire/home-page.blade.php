@section('meta_title', 'Global Info - Breaking News, World, Tech & Lifestyle')
@section('meta_description', 'Stay ahead with Global Info. Your trusted source for breaking news, in-depth analysis on technology, business, sports, and lifestyle from around the world.')
@section('meta_keywords', 'news, global news, technology, business, lifestyle, sports, latest updates')
@section('canonical_url', route('home'))
@section('og_title', 'Global Info - Breaking News, World, Tech & Lifestyle')
@section('og_description', 'Stay ahead with Global Info. Your trusted source for breaking news, in-depth analysis on technology, business, sports, and lifestyle from around the world.')
@section('og_image', asset('images/logolight.png'))
@section('twitter_title', 'Global Info - Breaking News, World, Tech & Lifestyle')
@section('twitter_description', 'Stay ahead with Global Info. Your trusted source for breaking news, in-depth analysis on technology, business, sports, and lifestyle from around the world.')

@section('preload_lcp')
    @if($featuredPosts->first())
        @php $lcpImage = $featuredPosts->first()->image; @endphp
        <link rel="preload" as="image" href="{{ Str::startsWith($lcpImage, 'http') ? $lcpImage : ($lcpImage ? asset(''.$lcpImage) : asset('images/logolight.png')) }}" fetchpriority="high">
    @endif
@endsection

@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebSite",
  "name": "Global Info",
  "url": "{{ route('home') }}",
  "potentialAction": {
    "@@type": "SearchAction",
    "target": "{{ route('home') }}?search={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
@endpush



<div class="font-serif text-ink pb-12">
    @if(isset($searchResults))
         <section class="max-w-screen-2xl mx-auto px-4 md:px-6 py-12">
             <h1 class="text-2xl md:text-4xl font-black mb-8 border-b-2 border-black pb-4">Search: "{{ $searchQuery }}"</h1>
             <div class="grid md:grid-cols-3 gap-8">
                 @foreach($searchResults as $post)
                 <div class="group">
                     <div class="overflow-hidden mb-4 border border-black h-48">
                         <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : (Str::startsWith($post->image, 'images/') ? asset($post->image) : asset($post->image)) }}" alt="{{ $post->title }}" width="640" height="360" class="w-full h-full object-contain transition duration-700">
                     </div>
                     <h3 class="text-xl font-semibold leading-tight mb-2 group-hover:underline">
                         <a href="{{ route('post', $post->slug) }}" wire:navigate>{{ $post->title }}</a>
                     </h3>
                     <span class="text-[10px] text-[] font-sans block mt-1"><i class="fa-regular fa-clock mr-1"></i>{{ $post->created_at->format('M d, Y') }} {{ $post->created_at->diffForHumans() }}</span>
                 </div>
                 @endforeach
             </div>
         </section>
    @else

    <!-- 0. ORIGINAL TICKER -->
    <livewire:widgets.breaking-news-ticker />


    <!-- 2. NEW DON'T MISS GRID -->
    <section class="max-w-screen-2xl mx-auto px-4 md:px-6">
        <h2 class="sr-only">Featured Stories</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($editorPicks->take(3) as $post)
            <div class="group">
                <div class="aspect-video border border-black overflow-hidden mb-3 relative">
                     <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : (Str::startsWith($post->image, 'images/') ? asset($post->image) : asset(''.$post->image)) }}" alt="{{ $post->title }}" width="640" height="360" class="w-full h-full object-contain transition">
                     <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>
                </div>
                <span class="text-[10px] text-accent-red font-bold uppercase tracking-widest">{{ $post->category->name ?? 'Featured' }}</span>
                <h3 class="text-lg font-semibold font-serif leading-tight mt-1 group-hover:underline">
                    <a href="{{ route('post', $post->slug) }}" wire:navigate>{{ $post->title }}</a>
                </h3>
                <span class="text-[10px] text-[] font-sans block mt-1"><i class="fa-regular fa-clock mr-1"></i>{{ $post->created_at->format('M d, Y') }} {{ $post->created_at->diffForHumans() }}</span>
            </div>
            @endforeach
        </div>
    </section>

    <!-- 3. ORIGINAL HERO SECTION (Restored) -->
    <section class="max-w-screen-2xl mx-auto px-4 md:px-6 py-8 md:py-12 border-b-4 border-double border-neutral-800">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12">
            <!-- LEFT: In Brief (Restored) -->
            <div class=" md:col-span-3 space-y-6 pr-0 md:pr-6 block mt-8 md:mt-0">
                <h2 class="font-sans-caption font-semibold border-b border-black mb-2 pb-1">Top Headlines</h2>
                <div class="space-y-6">
                    @foreach($headlines as $news)
                    <article class="mb-6 group">
                        <div class="flex gap-3 mb-2">
                             <div class="w-20 h-20 border border-black overflow-hidden shrink-0">
                                 <img src="{{ Str::startsWith($news->image, 'http') ? $news->image : ($news->image ? asset(''.$news->image) : asset('images/logolight.png')) }}" alt="{{ $news->title }}" width="80" height="80" class="w-full h-full object-contain transition duration-500">
                             </div>
                             <div>
                                <span class="text-[9px] font-bold font-sans uppercase text-[] block mb-1">
                                    {{ $news->created_at->format('M d, Y') }} {{ $news->created_at->diffForHumans() }} / {{ $news->source->name ?? 'Wire' }}
                                </span>
                                <h3 class="font-semibold text-base leading-snug font-serif text-[#222] hover:text-accent-red cursor-pointer group-hover:underline line-clamp-2">
                                    <a href="{{ route('post', $news->slug) }}" wire:navigate>{{ $news->title }}</a>
                                </h3>
                             </div>
                        </div>
                    </article>
                    @endforeach
                </div>
                 <!-- Quote of the Day -->
                 <div class="bg-paper-dark p-4 border border-black mt-8 text-center">
                    <span class="font-sans-caption text-[10px] font-bold uppercase block mb-2">Quote of the Day</span>
                    <p class="font-serif italic text-sm mb-2">"You cannot change your future, but you can change your habits, and surely your habits will change your future."</p>
                    <span class="font-bold text-xs uppercase">— A.P.J. Abdul Kalam</span>
                </div>
            </div>

            <!-- CENTER: Lead Story (Restored, using featuredPosts) -->
            <div class="order-1 md:order-2 md:col-span-6">
                @if($featuredPosts->first())
                @php $main = $featuredPosts->first(); @endphp
                <article>
                    <div class="mb-4 relative border border-black overflow-hidden object-contain aspect-[4/3]">
                         <a href="{{ route('post', $main->slug) }}" wire:navigate>
                            <img src="{{ Str::startsWith($main->image, 'http') ? $main->image : ($main->image ? asset(''.$main->image) : asset('images/logolight.png')) }}" alt="{{ $main->title }}" width="800" height="600" fetchpriority="high" class="w-full h-full object-contain transition duration-1000">
                         </a>
                    </div>
                    <div class="text-center md:px-4">
                        <span class="inline-block border-y border-black py-1 px-4 text-xs font-bold font-sans uppercase tracking-[0.2em] mb-4 text-accent-red">COVER STORY</span>
                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-black leading-none mb-2">
                            <a href="{{ route('post', $main->slug) }}" wire:navigate>{{ $main->title }}</a>
                        </h1>
                        <div class="flex items-center justify-center gap-2 mb-4 text-[10px] font-bold uppercase tracking-widest text-[] font-sans">
                            <span><i class="fa-regular fa-calendar-check mr-1"></i>{{ $main->created_at->format('M d, Y') }}</span>
                            <span>•</span>
                            <span><i class="fa-regular fa-clock mr-1"></i>{{ $main->created_at->format('M d, Y') }} {{ $main->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-lg text-[#222] mb-4 font-serif leading-relaxed line-clamp-4 text-justify">
                            <span class="drop-cap">{{ substr($main->title, 0, 1) }}</span>{{ Str::ucfirst(Str::lower(Str::limit(strip_tags($main->content), 250))) }}
                        </p>
                    </div>
                </article>
                @endif
            </div>

            <!-- RIGHT: Recent & Popular (Restored) -->
            <div class="order-3 md:col-span-3 space-y-6 border-l border-neutral-200 md:border-none mt-8 md:mt-0">
                <div class=" md:pl-6 h-full"> 
                    <h2 class="font-sans-caption font-semibold border-b border-black mb-4 pb-1">Popular & Recent</h2>
                    @foreach($latestPosts->skip(5)->take(4) as $post)
                    <article class="mb-6 group">
                        <div class="flex gap-3 mb-2">
                             <div class="w-20 h-20 border border-black overflow-hidden shrink-0">
                                 <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : (Str::startsWith($post->image, 'images/') ? asset($post->image) : asset(''.$post->image)) }}" alt="{{ $post->title }}" width="80" height="80" class="w-full h-full object-contain transition duration-500">
                             </div>
                             <div>
                                <span class="text-[9px] font-bold font-sans uppercase text-[] block mb-1">
                                    {{ $post->category->name ?? 'News' }} • {{ $post->created_at->format('M d, Y') }} {{ $post->created_at->diffForHumans() }}
                                </span>
                                <h3 class="font-semibold text-base leading-snug font-serif text-[#222] group-hover:underline line-clamp-2">
                                    <a href="{{ route('post', $post->slug) }}" wire:navigate>{{ $post->title }}</a>
                                </h3>
                             </div>
                        </div>
                    </article>
                    @endforeach
                    <div class="bg-paper-dark border border-black p-4 mt-8 text-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <h3 class="font-sans-caption font-semibold text-xs mb-2 text-ink">Subscribe to E-Paper</h3>
                        <p class="text-sm font-serif italic mb-3">Get unbiased journalism delivered daily.</p>
                        <a href="https://www.youtube.com/@officialGlobalInfo" target="_blank" class="block w-full bg-black text-white text-center font-bold uppercase text-[10px] py-2 tracking-widest hover:bg-neutral-800 transition">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- 1. NEW SLIDER (TRENDING NOW) -->
    <section class="container mx-auto px-4 md:px-6 py-8" x-data="{ 
        activeSlide: 0, 
        totalSlides: {{ $dontMissPosts->count() }},
        next() { this.activeSlide = (this.activeSlide + 1) % this.totalSlides },
        prev() { this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides }
    }">
        <div class="flex items-center justify-between mb-4 border-l-4 border-accent-red pl-3">
             <h2 class="text-2xl font-semibold font-sans uppercase tracking-tight">Don't Miss</h2>
             
             <div class="flex gap-2">
                 <button aria-label="Previous slide" @click="prev()" class="w-8 h-8 flex items-center justify-center border border-black hover:bg-black hover:text-white transition"><i class="fa-solid fa-arrow-left"></i></button>
                 <button aria-label="Next slide" @click="next()" class="w-8 h-8 flex items-center justify-center border border-black hover:bg-black hover:text-white transition"><i class="fa-solid fa-arrow-right"></i></button>
             </div>
        </div>
        <div class="overflow-hidden relative border border-black bg-paper-dark p-1">
            <div class="flex transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                @foreach($dontMissPosts as $index => $post)
                <div class="w-full shrink-0 flex flex-col md:flex-row gap-6 p-4 md:p-8 items-center">
                     <div class="w-full md:w-1/2 aspect-video border border-black overflow-hidden relative">
                         <span class="absolute top-2 left-2 bg-black text-white w-8 h-8 flex items-center justify-center font-bold font-sans text-lg border border-white z-10">#{{ $loop->iteration }}</span>
                         <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : (Str::startsWith($post->image, 'images/') ? asset($post->image) : asset(''.$post->image)) }}" alt="{{ $post->title }}" width="640" height="360" loading="lazy" decoding="async" class="w-full h-full object-contain transition duration-700">
                     </div>
                     <div class="w-full md:w-1/2 space-y-4">
                         <span class="inline-block px-3 py-1 border border-black text-xs font-bold uppercase tracking-wider bg-accent-red text-black">{{ $post->category->name ?? 'News' }}</span>
                         <h3 class="text-2xl md:text-4xl font-semibold leading-none hover:underline decoration-accent-red decoration-4">
                             <a href="{{ route('post', $post->slug) }}" wire:navigate>{{ $post->title }}</a>
                         </h3>
                         <p class="text-[#222] font-serif italic text-lg line-clamp-3">{{ Str::limit(strip_tags($post->meta_description ?? $post->content), 150) }}</p>
                         <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-[#222]">
                             <span>{{ $post->author->name ?? 'Editor' }}</span>
                             <span>•</span>
                             <span><i class="fa-regular fa-clock mr-1"></i>{{ $post->created_at->format('M d, Y') }} {{ $post->created_at->diffForHumans() }}</span>
                         </div>
                     </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- 4. OFFICIAL & COLORFUL MODERN PAPER UI -->
    <section class="w-full bg-[#FAFAFA] py-16 border-b border-neutral-200">
        <div class="max-w-screen-2xl mx-auto px-4 md:px-6">
            <!-- Official Header -->
            <div class="flex items-end justify-between mb-10 border-b-2 border-blue-900 pb-4 relative">
                 <div class="flex items-center gap-3">
                     <div class="h-10 w-2 bg-blue-900"></div>
                     <h2 class="text-3xl md:text-4xl font-semibold font-serif text-blue-950 uppercase tracking-tight leading-none">
                        India <span class="text-[#bb0b0d]">&</span> National
                     </h2>
                 </div>
                 <a href="{{ route('category', 'india') }}" class="hidden md:flex items-center gap-2 font-sans font-bold text-xs uppercase tracking-widest text-blue-900 hover:text-[#bb0b0d] transition-colors bg-white px-4 py-2 border border-blue-100 shadow-sm">
                    View Full Coverage <i class="fa-solid fa-arrow-right"></i>
                 </a>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                <!-- Large Feature Story (Col span 7) -->
                @php $leadPost = $latestPosts->skip(2)->first(); @endphp
                @if($leadPost)
                <div class="lg:col-span-7 group cursor-pointer lg:border-r lg:border-dashed lg:border-neutral-300 lg:pr-12">
                    <div class="relative mb-6">
                        <div class="overflow-hidden aspect-[16/9] border border-neutral-200 mb-4 shadow-md group-hover:shadow-xl transition-all duration-300 relative">
                             <div class="absolute top-0 left-0 bg-blue-900 text-white text-xs font-bold px-3 py-1 uppercase tracking-widest z-10">
                                {{ $leadPost->category->name ?? 'Top Story' }}
                             </div>
                             <img src="{{ Str::startsWith($leadPost->image, 'http') ? $leadPost->image : ($leadPost->image ? asset(''.$leadPost->image) : asset('images/logolight.png')) }}" alt="{{ $leadPost->title }}" width="800" height="450" loading="lazy" decoding="async" class="w-full h-full object-contain transition duration-700 group-hover:scale-105">
                        </div>
                        
                        <div class="flex items-center gap-3 mb-2">
                             <span class="text-xs font-bold font-sans uppercase text-[#bb0b0d] tracking-wider"><i class="fa-solid fa-fire mr-1"></i> Trending Now</span>
                             <span class="text-xs font-serif text-[] italic">/ {{ $leadPost->created_at->format('M d, Y') }} {{ $leadPost->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <h3 class="text-2xl md:text-4xl font-semibold font-serif leading-tight mb-3 text-blue-950 group-hover:text-blue-700 transition-colors">
                            <a href="{{ route('post', $leadPost->slug) }}" wire:navigate>{{ $leadPost->title }}</a>
                        </h3>
                        
                        <p class="text-lg text-[#222] font-serif leading-relaxed line-clamp-3">
                            {{ Str::limit(strip_tags($leadPost->content), 180) }}
                        </p>
                    </div>
                </div>
                @else
                <div class="lg:col-span-7 flex items-center justify-center border border-dashed border-neutral-300 h-64">
                    <p class="text-[#444] font-bold uppercase tracking-widest">No Stories Available</p>
                </div>
                @endif
                
                <!-- Side Stories (Col span 5) -->
                <div class="lg:col-span-5 flex flex-col h-full bg-white border border-neutral-100 p-6 shadow-sm">
                    <h3 class="font-sans font-semibold text-xs uppercase tracking-widest text-blue-900 border-b-2 border-amber-500 pb-2 mb-6 flex justify-between items-center">
                        <span>Latest Updates</span>
                        <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                    </h3>
                    
                    <div class="divide-y divide-dashed divide-neutral-200">
                        @foreach($latestPosts->skip(3)->take(5) as $index => $post)
                        <div class="py-5 group flex gap-5 items-start first:pt-0 last:pb-0">
                             <!-- Number/Index styling for 'Official' look -->
                             <span class="font-black text-2xl text-neutral-200 group-hover:text-blue-900 transition-colors font-serif leading-none -mt-1">{{ $loop->iteration }}</span>
                             
                             <div class="flex-1">
                                 <div class="flex items-center gap-2 mb-1.5">
                                     <span class="text-[9px] font-bold uppercase text-[#bb0b0d] tracking-wider">{{ $post->category->name ?? 'Update' }}</span>
                                     <span class="text-[9px] text-[#444] font-sans">• {{ $post->created_at->format('M d, Y') }} {{ $post->created_at->diffForHumans() }}</span>
                                 </div>
                                 <h4 class="text-base font-bold font-serif leading-snug mb-1 group-hover:text-blue-700 transition-colors text-blue-950">
                                     <a href="{{ route('post', $post->slug) }}" wire:navigate>{{ $post->title }}</a>
                                 </h4>
                             </div>
                             
                             <div class="w-20 h-20 shrink-0 border border-neutral-100 overflow-hidden rounded-sm relative">
                                 <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : (Str::startsWith($post->image, 'images/') ? asset($post->image) : asset(''.$post->image)) }}" alt="{{ $post->title }}" width="100" height="100" loading="lazy" decoding="async" class="w-full h-full object-contain group-hover:scale-110 transition duration-500">
                             </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. OFFICIAL DALAL STREET & ECONOMY -->
    <section class="w-full bg-white py-12 border-b border-neutral-200">
        <div class="max-w-screen-2xl mx-auto px-4 md:px-6">
            <!-- Market Ticker Bar -->
            <div class="hidden mb-8 border-y border-neutral-200 py-2 bg-neutral-50 rounded-sm">
                 <livewire:widgets.market-ticker />
            </div>

            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 pb-2 border-b-2 border-green-700 gap-2 md:gap-0">
                <h2 class="text-2xl md:text-3xl font-semibold font-serif text-blue-950 uppercase tracking-tight flex items-center gap-3">
                    <span class="w-8 h-8 bg-green-700 text-white flex items-center justify-center rounded-sm text-sm"><i class="fa-solid fa-chart-line"></i></span>
                    Dalal Street <span class="text-[#bb0b0d]">&</span> Economy
                </h2>
                <a href="{{ route('category', 'business') }}" class="text-xs font-bold font-sans uppercase text-blue-900 hover:text-green-700 ml-11 md:ml-0">Market Dashboard <i class="fa-solid fa-arrow-right ml-1"></i></a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                 <!-- Left: Main Economy Feature -->
                 <div class="lg:col-span-8">
                     @if($trendingPosts->first())
                     <div class="group cursor-pointer">
                         <div class="aspect-video md:aspect-[2/1] border border-neutral-200 overflow-hidden mb-5 relative shadow-sm">
                             <img src="{{ Str::startsWith($trendingPosts->first()->image, 'http') ? $trendingPosts->first()->image : ($trendingPosts->first()->image ? asset(''.$trendingPosts->first()->image) : asset('images/logolight.png')) }}" alt="{{ $trendingPosts->first()->title }}" width="800" height="400" loading="lazy" decoding="async" class="w-full h-full object-contain transition duration-700 group-hover:scale-105">
                             <div class="absolute bottom-0 left-0 bg-white/95 backdrop-blur-sm p-6 max-w-2xl border-t-4 border-green-700">
                                 <span class="text-[10px] font-bold uppercase tracking-widest text-green-700 mb-2 block"><i class="fa-solid fa-arrow-trend-up mr-1"></i> Market Mover</span>
                                 <h3 class="text-2xl md:text-4xl font-semibold font-serif text-blue-950 leading-tight mb-2 group-hover:underline decoration-green-700 decoration-2">{{ $trendingPosts->first()->title }}</h3>
                                 <p class="text-neutral-600 font-serif leading-relaxed line-clamp-2">{{ Str::limit(strip_tags($trendingPosts->first()->content), 120) }}</p>
                             </div>
                         </div>
                     </div>
                     @endif

                     <!-- Sub-grid of Economy News -->
                     <div class="grid md:grid-cols-2 gap-6 mt-8 pt-8 border-t border-dashed border-neutral-300">
                        @foreach($latestPosts->skip(6)->take(2) as $post)
                        <div class="flex gap-4 items-start group">
                            <div class="w-24 h-24 shrink-0 border border-neutral-200 overflow-hidden rounded-sm">
                                <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : (Str::startsWith($post->image, 'images/') ? asset($post->image) : asset(''.$post->image)) }}" alt="{{ $post->title }}" width="100" height="100" loading="lazy" decoding="async" class="w-full h-full object-contain group-hover:scale-110 transition">
                            </div>
                            <div>
                                <span class="text-[9px] font-bold text-[#444] uppercase mb-1 block">{{ $post->category->name }}</span>
                                <h4 class="text-lg font-bold font-serif leading-tight text-blue-950 mb-2 group-hover:text-green-700 transition">
                                    <a href="{{ route('post', $post->slug) }}" wire:navigate>{{ $post->title }}</a>
                                </h4>
                                <span class="text-xs font-bold text-green-600"><i class="fa-solid fa-caret-up"></i> Bullish • {{ $post->created_at->format('M d, Y') }} {{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @endforeach
                     </div>
                 </div>

                 <!-- Right: Market Updates List -->
                 <div class="lg:col-span-4 bg-blue-50/50 p-6 border border-blue-100 rounded-sm">
                     <h3 class="font-sans font-semibold text-xs uppercase tracking-widest text-blue-900 mb-5 border-b border-blue-200 pb-2">
                         <i class="fa-regular fa-bell mr-1"></i> Market Brief
                     </h3>
                     <div class="space-y-5">
                         @foreach($latestPosts->skip(8)->take(4) as $post)
                         <div class="group border-b border-blue-100 pb-4 last:border-0 last:pb-0">
                             <div class="flex justify-between items-start mb-1">
                                <span class="text-[9px] font-bold text-blue-500 uppercase">{{ $post->created_at->format('M d, Y') }} {{ $post->created_at->diffForHumans() }}</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 group-hover:bg-green-500 transition-colors"></span>
                             </div>
                             <h4 class="font-bold font-serif text-sm leading-snug text-blue-950 group-hover:text-green-700 transition-colors">
                                 <a href="{{ route('post', $post->slug) }}" wire:navigate>{{ $post->title }}</a>
                             </h4>
                         </div>
                         @endforeach
                     </div>
                     <button class="w-full mt-6 bg-blue-900 text-white text-xs font-bold uppercase py-3 tracking-widest hover:bg-blue-800 transition shadow-sm rounded-sm">
                         Open Dashboard
                     </button>
                 </div>
            </div>
        </div>
    </section>

    <!-- 6. SPORTS SECTION (Modern UI) -->
    <section class="container mx-auto px-4 md:px-6 py-12 border-t border-neutral-200 bg-neutral-50/50">
        <div class="flex items-center justify-between mb-8 border-b-2 border-red-600 pb-2">
             <div class="flex items-center gap-3">
                 <span class="w-8 h-8 flex items-center justify-center bg-red-600 text-white rounded-sm"><i class="fa-solid fa-medal"></i></span>
                 <h2 class="font-serif text-2xl md:text-4xl font-semibold uppercase tracking-tight text-blue-950">Sports Arena</h2>
             </div>
             <div class="flex gap-4 text-xs font-bold uppercase tracking-widest text-[] hidden md:flex">
                 <a href="{{ route('home') }}" class="hover:text-red-600 transition">Cricket</a>
                 <a href="{{ route('home') }}" class="hover:text-red-600 transition">Football</a>
                 <a href="{{ route('home') }}" class="hover:text-red-600 transition">Tennis</a>
                 <a href="{{ route('home') }}" class="hover:text-red-600 transition">F1</a>
             </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
             <!-- LEFT: Live Scores (Keep existing widget) -->
             <div class="lg:col-span-3">
                 <livewire:widgets.live-cricket-score />
                 
                 <!-- Additional Small Sports Widget -->
                 <div class="mt-6 bg-white border border-black p-4 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                     <h3 class="font-sans font-semibold text-xs uppercase tracking-widest text-[] mb-3 border-b border-neutral-100 pb-2">Upcoming Matches</h3>
                     <ul class="space-y-3">
                         <li class="flex justify-between items-center text-xs font-bold text-blue-900">
                             <span>IND vs AUS</span>
                             <span class="bg-red-100 text-red-600 px-1.5 py-0.5 rounded">Live</span>
                         </li>
                         <li class="flex justify-between items-center text-xs font-bold text-neutral-600">
                             <span>ENG vs NZ</span>
                             <span>Tomorrow</span>
                         </li>
                         <li class="flex justify-between items-center text-xs font-bold text-neutral-600">
                             <span>RSA vs PAK</span>
                             <span>Oct 24</span>
                         </li>
                     </ul>
                 </div>
            </div>

            <!-- CENTER: Main Content (Rich Density) -->
            <div class="lg:col-span-9">
                <div class="grid lg:grid-cols-12 gap-6">
                    <!-- Main Featured Story (Col 7) -->
                    @php $sportMain = $sportsPosts->first(); @endphp
                    @if($sportMain)
                    <div class="lg:col-span-8 group cursor-pointer">
                        <div class="aspect-video relative overflow-hidden border border-black mb-0">
                            <span class="absolute top-0 right-0 bg-red-600 text-white px-3 py-1 text-xs font-bold uppercase tracking-widest z-10 animate-pulse">Live Action</span>
                             <img src="{{ Str::startsWith($sportMain->image, 'http') ? $sportMain->image : ($sportMain->image ? asset(''.$sportMain->image) : asset('images/logolight.png')) }}" alt="{{ $sportMain->title }}" width="640" height="360" loading="lazy" decoding="async" class="w-full h-full object-contain transition duration-700 group-hover:scale-105">
                             <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60"></div>
                             <div class="absolute bottom-0 left-0 p-6 w-full">
                                 <h3 class="text-xl md:text-3xl font-semibold font-serif text-white leading-none mb-2">{{ $sportMain->title }}</h3>
                                 <p class="text-neutral-200 line-clamp-2 font-serif text-sm w-5/6">{{ Str::limit(strip_tags($sportMain->content), 100) }}</p>
                                 <span class="text-[10px] font-bold text-white/60 uppercase tracking-widest mt-2 block"><i class="fa-regular fa-clock mr-1"></i>{{ $sportMain->created_at->format('M d, Y') }} {{ $sportMain->created_at->diffForHumans() }}</span>
                             </div>
                        </div>
                    </div>
                    @endif

                    <!-- Right List (Col 5) -->
                    <div class="lg:col-span-4 flex flex-col gap-2">
                         @foreach($sportsPosts->skip(1)->take(3) as $sub)
                         <div class="flex gap-3 p-2 border border-transparent hover:border-neutral-200 hover:bg-white transition group cursor-pointer">
                             <div class="w-16 h-16 shrink-0 border border-neutral-200 overflow-hidden relative">
                                  <img src="{{ Str::startsWith($sub->image, 'http') ? $sub->image : ($sub->image ? asset(''.$sub->image) : asset('images/logolight.png')) }}" alt="{{ $sub->title }}" width="100" height="100" loading="lazy" decoding="async" class="w-full h-full object-contain group-hover:scale-110 transition">
                             </div>
                             <div>
                                 <span class="text-[9px] font-bold uppercase text-red-600 block mb-0.5">{{ $sub->category->name ?? 'Sports' }}</span>
                                 <h4 class="text-sm font-bold font-serif leading-tight text-blue-950 group-hover:underline line-clamp-2">
                                     <a href="{{ route('post', $sub->slug) }}" wire:navigate>{{ $sub->title }}</a>
                                 </h4>
                                  <span class="text-[9px] text-[] font-sans block mt-1">{{ $sub->created_at->format('M d, Y') }} {{ $sub->created_at->diffForHumans() }}</span>
                             </div>
                         </div>
                         @endforeach
                    </div>
                </div>

                <!-- Bottom Grid (More Content) -->
                <div class="grid md:grid-cols-3 gap-6 mt-6 pt-6 border-t border-dashed border-neutral-300">
                     @foreach($sportsPosts->skip(4)->take(3) as $gridItem)
                     <div class="group">
                         <div class="aspect-[3/2] border border-neutral-200 overflow-hidden mb-2 relative">
                             <img src="{{ Str::startsWith($gridItem->image, 'http') ? $gridItem->image : ($gridItem->image ? asset(''.$gridItem->image) : asset('images/logolight.png')) }}" alt="{{ $gridItem->title }}" width="400" height="260" loading="lazy" decoding="async" class="w-full h-full object-contain brightness-95 group-hover:brightness-100 transition duration-500">
                         </div>
                         <h4 class="font-bold font-serif text-sm leading-tight group-hover:text-red-700 transition">
                             <a href="{{ route('post', $gridItem->slug) }}" wire:navigate>{{ $gridItem->title }}</a>
                         </h4>
                          <span class="text-[10px] text-[] font-sans mt-1 block">{{ $gridItem->created_at->format('M d, Y') }} {{ $gridItem->created_at->diffForHumans() }}</span>
                     </div>
                     @endforeach
                </div>
            </div>
        </div>
    </section>



    <!-- 7. NEW MAIN CONTENT AREA (Tech/Sports + Sidebar Widgets) -->
    <section class="container mx-auto px-4 md:px-6 py-12 border-t-4 border-double border-black">
        <h2 class="text-2xl font-semibold font-sans uppercase mb-6 text-center">More News & Features</h2>
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Left Column: Big Feature + List -->
            <div class="lg:w-2/3">
                 <!-- Business / Economy Block -->
                 <div class="mb-12">
                     @php $mainFeature = $latestPosts->skip(3)->first(); @endphp
                     @if($mainFeature)
                     <div class="flex flex-col md:flex-row gap-6 mb-8 border-b border-black pb-8">
                         <div class="md:w-2/3 relative group">
                             <div class="aspect-video border border-black overflow-hidden">
                                 <img src="{{ Str::startsWith($mainFeature->image, 'http') ? $mainFeature->image : ($mainFeature->image ? asset(''.$mainFeature->image) : asset('images/logolight.png')) }}" alt="{{ $mainFeature->title }}" width="640" height="360" loading="lazy" decoding="async" class="w-full h-full object-contain transition">
                             </div>
                             <div class="mt-4">
                                 <span class="bg-blue-600 text-white px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider">{{ $mainFeature->category->name ?? 'News' }}</span>
                                 <h3 class="text-2xl font-semibold font-serif mt-2 leading-tight group-hover:text-blue-700 transition">
                                     <a href="{{ route('post', $mainFeature->slug) }}" wire:navigate>{{ $mainFeature->title }}</a>
                                 </h3>
                                 <p class="text-sm text-neutral-600 mt-2 font-serif line-clamp-2">{{ Str::limit(strip_tags($mainFeature->meta_description ?? $mainFeature->content), 120) }}</p>
                                  <span class="text-[9px] text-[#444] font-bold uppercase tracking-widest mt-2 block">{{ $mainFeature->created_at->format('M d, Y') }} {{ $mainFeature->created_at->diffForHumans() }}</span>
                             </div>
                         </div>
                         <div class="md:w-1/3 flex flex-col gap-4">
                             @foreach($latestPosts->skip(10)->take(4) as $subPost)
                             <div class="flex gap-3 items-start group">
                                 <div class="w-16 h-16 shrink-0 border border-black overflow-hidden">
                                     <img src="{{ Str::startsWith($subPost->image, 'http') ? $subPost->image : ($subPost->image ? asset(''.$subPost->image) : asset('images/logolight.png')) }}" alt="{{ $subPost->title }}" width="64" height="64" loading="lazy" decoding="async" class="w-full h-full object-contain transition">
                                 </div>
                                 <div>
                                     <h4 class="text-xs font-bold font-serif leading-tight group-hover:underline">
                                         <a href="{{ route('post', $subPost->slug) }}" wire:navigate>{{ $subPost->title }}</a>
                                     </h4>
                                      <span class="text-[9px] text-[] uppercase">{{ $subPost->created_at->format('M d, Y') }} {{ $subPost->created_at->diffForHumans() }}</span>
                                 </div>
                             </div>
                             @endforeach
                         </div>
                     </div>
                     @endif
                 </div>

                 <!-- Category Blocks (Tech & Sports) -->
                 <div class="grid md:grid-cols-2 gap-8">
                     @if($latestPosts->isNotEmpty())
                          <!-- Tech -->
                          <div>
                             <div class="flex items-center mb-4 border-l-4 border-blue-600 pl-3">
                                 <h3 class="font-semibold font-sans uppercase text-blue-800">Technology</h3>
                             </div>
                             @php 
                                 $techPosts = $latestPosts->where('category_id', 4);
                                 // Strict DB Content: latest tech post or just latest post. No random.
                                 $tech = $techPosts->first() ?? $latestPosts->first(); 
                             @endphp
                             <div class="mb-4 group">
                                 <div class="aspect-[16/10] border border-black overflow-hidden mb-2">
                                     <img src="{{ Str::startsWith($tech->image, 'http') ? $tech->image : ($tech->image ? asset(''.$tech->image) : asset('images/logolight.png')) }}" alt="{{ $tech->title }}" width="400" height="250" loading="lazy" decoding="async" class="w-full h-full object-contain transition">
                                 </div>
                                 <h4 class="font-bold font-serif text-lg leading-tight group-hover:underline"><a href="{{ route('post', $tech->slug) }}" wire:navigate>{{ $tech->title }}</a></h4>
                             </div>
                             <ul class="space-y-3 divide-y divide-neutral-300">
                                  @foreach($techPosts->skip(1)->take(3) as $tp)
                                  <li class="pt-2">
                                      <a href="{{ route('post', $tp->slug) }}" class="text-xs font-bold hover:text-blue-700 transition flex items-center gap-2" wire:navigate>
                                          <i class="fa-solid fa-angle-right text-[8px] text-blue-500"></i> {{ $tp->title }}
                                      </a>
                                  </li>
                                  @endforeach
                             </ul>
                          </div>

                          <!-- Sports -->
                          <div>
                             <div class="flex items-center mb-4 border-l-4 border-orange-500 pl-3">
                                 <h3 class="font-semibold font-sans uppercase text-orange-700">Sports</h3>
                             </div>
                             @php 
                                 $catPosts = $latestPosts->where('category_id', 5);
                                 // Strict DB Content: latest sports post or next latest post. No random.
                                 $sports = $catPosts->first() ?? $latestPosts->where('id', '!=', $tech->id)->first();
                             @endphp
                             
                             @if($sports)
                             <div class="mb-4 group">
                                 <div class="aspect-[16/10] border border-black overflow-hidden mb-2">
                                     <img src="{{ Str::startsWith($sports->image, 'http') ? $sports->image : ($sports->image ? asset(''.$sports->image) : asset('images/logolight.png')) }}" alt="{{ $sports->title }}" width="400" height="250" loading="lazy" decoding="async" class="w-full h-full object-contain transition">
                                 </div>
                                 <h4 class="font-bold font-serif text-lg leading-tight group-hover:underline"><a href="{{ route('post', $sports->slug) }}" wire:navigate>{{ $sports->title }}</a></h4>
                             </div>
                             @endif
                             
                             <ul class="space-y-3 divide-y divide-neutral-300">
                                  @foreach($catPosts->skip(1)->take(3) as $sp)
                                  <li class="pt-2">
                                      <a href="{{ route('post', $sp->slug) }}" class="text-xs font-bold hover:text-orange-600 transition flex items-center gap-2" wire:navigate>
                                          <i class="fa-solid fa-angle-right text-[8px] text-orange-500"></i> {{ $sp->title }}
                                      </a>
                                  </li>
                                  @endforeach
                             </ul>
                          </div>
                      @else
                         <div class="col-span-2 text-center py-12 border border-dashed border-neutral-300">
                             <p class="text-[#444] font-bold uppercase">Content Loading...</p>
                         </div>
                      @endif
                  </div>
             </div>

             <!-- New Sidebar (Widgets) -->
             <aside class="lg:w-1/3 space-y-8">
                 <!-- Social Follow -->
                 <div class="bg-white border border-black p-5 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                     <h3 class="font-sans-caption font-semibold border-b border-black pb-2 mb-4 uppercase text-xs tracking-widest">Follow Us</h3>
                     <div class="grid grid-cols-2 gap-3">
                         <a href="#" class="flex items-center justify-between px-3 py-2 bg-[#3b5998] text-white text-xs font-bold border border-black hover:opacity-90 transition">
                             <span><i class="fa-brands fa-facebook-f mr-2"></i> Fans</span>
                             <span>12k</span>
                         </a>
                         <a href="#" class="flex items-center justify-between px-3 py-2 bg-[#1da1f2] text-white text-xs font-bold border border-black hover:opacity-90 transition">
                             <span><i class="fa-brands fa-twitter mr-2"></i> Followers</span>
                             <span>8k</span>
                         </a>
                         <a href="#" class="flex items-center justify-between px-3 py-2 bg-[#e1306c] text-white text-xs font-bold border border-black hover:opacity-90 transition">
                             <span><i class="fa-brands fa-instagram mr-2"></i> Followers</span>
                             <span>45k</span>
                         </a>
                         <a href="https://www.youtube.com/@officialGlobalInfo" target="_blank" class="flex items-center justify-between px-3 py-2 bg-[#ff0000] text-white text-xs font-bold border border-black hover:opacity-90 transition">
                             <span><i class="fa-brands fa-youtube mr-2"></i> Subs</span>
                             <span>25k</span>
                         </a>
                     </div>
                 </div>

                 <!-- Tabs: Popular / Recent -->
                 <div x-data="{ tab: 'popular' }" class="border border-black bg-paper-dark">
                     <div class="flex border-b border-black">
                         <button @click="tab = 'popular'" :class="{ 'bg-black text-white': tab === 'popular', 'bg-transparent text-black': tab !== 'popular' }" class="flex-1 py-2 text-xs font-bold uppercase tracking-widest transition">Popular</button>
                         <button @click="tab = 'recent'" :class="{ 'bg-black text-white': tab === 'recent', 'bg-transparent text-black': tab !== 'recent' }" class="flex-1 py-2 text-xs font-bold uppercase tracking-widest transition">Recent</button>
                     </div>
                     <div class="p-4">
                         <div x-show="tab === 'popular'" class="space-y-4">
                              @foreach($trendingPosts->take(4) as $pop)
                              <div class="flex gap-3 items-center group">
                                  <div class="w-12 h-12 rounded-full border border-black overflow-hidden shrink-0">
                                      <img src="{{ Str::startsWith($pop->image, 'http') ? $pop->image : ($pop->image ? asset(''.$pop->image) : asset('images/logolight.png')) }}" alt="{{ $pop->title }}" class="w-full h-full object-contain">
                                  </div>
                                  <div>
                                      <h4 class="text-xs font-bold font-serif leading-tight group-hover:underline"><a href="{{ route('post', $pop->slug) }}" wire:navigate>{{ $pop->title }}</a></h4>
                                      <span class="text-[9px] text-[] uppercase">{{ $pop->views }} Reads • {{ $pop->created_at->format('M d, Y') }} {{ $pop->created_at->diffForHumans() }}</span>
                                  </div>
                              </div>
                              @endforeach
                         </div>
                         <div x-show="tab === 'recent'" class="space-y-4" style="display: none;">
                              @foreach($latestPosts->take(4) as $rec)
                              <div class="flex gap-3 items-center group">
                                  <div class="w-12 h-12 rounded-full border border-black overflow-hidden shrink-0">
                                      <img src="{{ Str::startsWith($rec->image, 'http') ? $rec->image : ($rec->image ? asset(''.$rec->image) : asset('images/logolight.png')) }}" alt="{{ $rec->title }}" class="w-full h-full object-cover">
                                  </div>
                                  <div>
                                      <h4 class="text-xs font-bold font-serif leading-tight group-hover:underline"><a href="{{ route('post', $rec->slug) }}" wire:navigate>{{ $rec->title }}</a></h4>
                                      <span class="text-[9px] text-[] uppercase">{{ $rec->created_at->format('M d, Y') }} {{ $rec->created_at->diffForHumans() }}</span>
                                  </div>
                              </div>
                              @endforeach
                         </div>
                     </div>
                 </div>

                 <!-- Categories -->
                 <div class="border border-black bg-white p-5">
                     <h3 class="font-sans-caption font-semibold border-b border-black pb-2 mb-4 uppercase text-xs tracking-widest">Categories</h3>
                     <div class="space-y-2">
                         @foreach($categories as $cat)
                         <a href="{{ route('category', $cat->slug) }}" class="flex justify-between items-center group" wire:navigate>
                             <span class="text-xs font-bold group-hover:text-accent-red transition">{{ $cat->name }}</span>
                             <span class="bg-neutral-200 text-neutral-700 text-[9px] px-1.5 py-0.5 rounded-full font-bold group-hover:bg-accent-red group-hover:text-white transition">{{ $cat->news_count }}</span>
                         </a>
                         @endforeach
                     </div>
                 </div>
             </aside>
        </div>
    </section>

    <!-- 8. NEW VISUAL STORIES (Bottom) -->
     <section class="container mx-auto px-4 md:px-6 py-12 border-t-4 border-double border-black mt-8">
        <div class="flex justify-between items-end mb-6">
            <h2 class="font-serif font-semibold text-3xl uppercase tracking-tight">Visual Stories</h2>
            <a href="{{ route('home') }}" class="font-sans-caption text-xs font-bold hover:text-accent-red">View Archive <i class="fa-solid fa-arrow-right ml-1"></i></a>
        </div>
        <div class="flex overflow-x-auto gap-4 pb-4 snap-x hide-scrollbar">
            @foreach($latestPosts->take(8) as $story)
            <div class="snap-center shrink-0 w-48 h-80 relative group cursor-pointer border border-black overflow-hidden bg-black">
                <img src="{{ Str::startsWith($story->image, 'http') ? $story->image : ($story->image ? asset(''.$story->image) : asset('images/logolight.png')) }}" alt="{{ $story->title }}" width="192" height="320" loading="lazy" decoding="async" class="w-full h-full object-contain opacity-80 group-hover:scale-110 group-hover:opacity-100 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-90"></div>
                
                <div class="absolute bottom-0 left-0 w-full p-4">
                    <span class="inline-block px-2 py-0.5 bg-white text-black text-[9px] font-bold uppercase tracking-wider mb-2">
                        {{ $story->category->name ?? 'Story' }}
                    </span>
                    <h3 class="text-white font-serif font-semibold leading-tight text-sm line-clamp-3 group-hover:underline">
                        <a class="text-white" href="{{ route('post', $story->slug) }}" wire:navigate>{{ $story->title }}</a>
                    </h3>
                </div>
                
                <div class="absolute top-3 right-3 w-8 h-8 rounded-full border border-white/30 bg-black/20 backdrop-blur flex items-center justify-center">
                    <i class="fa-solid fa-layer-group text-white text-xs"></i>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- 9. NEW STORIES SECTION (Formerly Multimedia) -->
    <section class="border-t-4 border-double border-black py-12 bg-paper-dark">
        <div class="container mx-auto px-4 md:px-6">
            <h2 class="font-sans-caption font-semibold border-b border-black pb-2 mb-8 flex justify-between items-center">
                <span>In Focus</span>
                <i class="fa-solid fa-newspaper"></i>
            </h2>
            <div class="grid lg:grid-cols-12 gap-8">
                 <!-- Main Feature Story -->
                 @php 
                    // Using latestPosts to ensure content always shows. Skipping 12 to avoid top-page duplicates.
                    $focusMain = $latestPosts->skip(12)->first(); 
                 @endphp
                 @if($focusMain)
                 <div class="lg:col-span-7 relative border border-black group cursor-pointer bg-black">
                     <div class="aspect-video relative overflow-hidden">
                         <img src="{{ Str::startsWith($focusMain->image, 'http') ? $focusMain->image : ($focusMain->image ? asset(''.$focusMain->image) : asset('images/logolight.png')) }}" alt="{{ $focusMain->title }}" width="800" height="450" loading="lazy" decoding="async" class="w-full h-full object-contain opacity-90 group-hover:scale-105 transition duration-700">
                         <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                     </div>
                     <div class="absolute bottom-0 left-0 w-full p-6">
                         <span class="bg-accent-red text-white font-bold text-xs uppercase tracking-widest px-2 py-1 mb-2 inline-block">
                             {{ $focusMain->category->name ?? 'News' }}
                         </span>
                         <h3 class="text-white font-semibold text-xl md:text-4xl font-serif leading-none mb-2 shadow-black drop-shadow-md">
                             <a href="{{ route('post', $focusMain->slug) }}" wire:navigate>{{ $focusMain->title }}</a>
                         </h3>
                         <div class="flex items-center gap-3 text-neutral-300 text-xs font-sans uppercase tracking-widest mt-3">
                             <span>{{ $focusMain->author->name ?? 'Editor' }}</span>
                             <span>•</span>
                             <span>{{ $focusMain->created_at->format('M d, Y') }} {{ $focusMain->created_at->diffForHumans() }}</span>
                         </div>
                     </div>
                 </div>
                 @endif

                 <!-- Side Grid (2x2) -->
                 <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                     @foreach($latestPosts->skip(13)->take(4) as $post)
                     <div class="group cursor-pointer flex flex-col h-full bg-white border border-neutral-200">
                         <div class="aspect-video relative border-b border-neutral-200 overflow-hidden">
                             <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : (Str::startsWith($post->image, 'images/') ? asset($post->image) : asset(''.$post->image)) }}" alt="{{ $post->title }}" width="400" height="225" loading="lazy" decoding="async" class="w-full h-full object-contain group-hover:scale-105 transition duration-500">
                             <span class="absolute top-2 left-2 bg-white/90 px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider">{{ $post->category->name ?? 'News' }}</span>
                         </div>
                         <div class="p-3 flex flex-col flex-1">
                             <h4 class="text-sm font-bold leading-tight hover:underline transition font-serif line-clamp-3 mb-auto text-blue-950">
                                 <a href="{{ route('post', $post->slug) }}" wire:navigate>{{ $post->title }}</a>
                             </h4>
                             <span class="text-[10px] text-[] font-bold uppercase mt-3 pt-2 border-t border-neutral-100 block">
                                  {{ $post->created_at->format('M d, Y') }} {{ $post->created_at->diffForHumans() }}
                             </span>
                         </div>
                     </div>
                     @endforeach
                 </div>
            </div>
        </div>
    </section>

    @endif
</div>
