@section('meta_title', $post->meta_title ?? $post->title)
@section('meta_description', $post->meta_description ?? Str::limit(strip_tags($post->content), 160))
@section('meta_keywords', $post->meta_keywords ?? '')
@section('canonical_url', $post->canonical_url ?? route('post', $post->slug))
@section('og_title', $post->og_title ?? $post->title)
@section('og_description', $post->og_description ?? Str::limit(strip_tags($post->content), 160))
@section('og_image', $post->og_image ? asset('storage/'.$post->og_image) : asset('images/logolight.png'))
@section('twitter_title', $post->twitter_title ?? $post->title)
@section('twitter_description', $post->twitter_description ?? Str::limit(strip_tags($post->content), 160))

@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BlogPosting",
  "mainEntityOfPage": {
    "@@type": "WebPage",
    "@@id": "{{ route('post', $post->slug) }}"
  },
  "headline": "{{ $post->title }}",
  "description": "{{ $post->meta_description ?? Str::limit(strip_tags($post->content), 160) }}",
  "image": [
    "{{ $post->og_image ? asset('storage/'.$post->og_image) : ($post->image ? (Str::startsWith($post->image, 'http') ? $post->image : asset('storage/'.$post->image)) : asset('images/logolight.png')) }}"
  ],  
  "author": {
    "@@type": "Person",
    "name": "{{ $post->author->name ?? 'JayPrakash' }}",
    "url": "{{ route('about') }}"
  },  
  "publisher": {
    "@@type": "Organization",
    "name": "Global Info",
    "logo": {
      "@@type": "ImageObject",
      "url": "{{ asset('images/logolight.png') }}"
    }
  },
  "datePublished": "{{ $post->published_at ? $post->published_at->toIso8601String() : $post->created_at->toIso8601String() }}",
  "dateModified": "{{ $post->updated_at->toIso8601String() }}"
}
</script>
@endpush


<div class="max-w-screen-2xl mx-auto px-4 md:px-6 py-12">
    <div class="flex flex-col lg:flex-row gap-12">
        
        <!-- Main Content (Newspaper Article Style) -->
        <article class="lg:w-2/3">
             <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-xs font-bold text-neutral-500 mb-6 uppercase tracking-wider font-sans">
                <a href="{{ route('home') }}" class="hover:text-accent-red transition" wire:navigate>Home</a>
                <i class="fa-solid fa-angle-right text-[8px]"></i>
                <a href="{{ route('category', $post->category->slug) }}" class="hover:text-accent-red transition" wire:navigate>{{ $post->category->name }}</a>
            </div>

            <!-- Title & Meta -->
            <h1 class="text-3xl md:text-5xl font-black text-[#222] leading-tight mb-4 border-b-2 border-black pb-6" style="font-family: 'Playfair Display', serif;">{{ $post->title }}</h1>
            
            <div class="flex items-center justify-between border-b border-black pb-6 mb-8">
                <div class="flex items-center gap-4">
                     <!-- Author Avatar (Bordered) -->
                     <div class="w-12 h-12 rounded-full border border-black p-0.5 overflow-hidden">
                         <img src="https://www.w3schools.com/howto/img_avatar.png" alt="{{ $post->author->name ?? 'Author Avatar' }}" class="w-full h-full object-cover">
                     </div>
                     <div>
                         <p class="text-sm font-bold text-[#222] uppercase font-sans">By {{ $post->author->name ?? 'Unknown Author' }}</p>
                         <div class="flex flex-wrap gap-x-3 gap-y-1 text-xs text-neutral-600 font-medium font-serif italic mt-1 items-center">
                             <span>{{ $post->author->role->name ?? 'Author' }}</span>
                             <span class="text-neutral-300">&bull;</span>
                             <span>{{ $post->published_at ? $post->published_at->format('d M Y, h:i A') : $post->created_at->format('d M Y, h:i A') }}</span>
                             <span class="text-neutral-300">&bull;</span>
                             <span><i class="fa-regular fa-clock mr-1"></i> {{ $post->read_time }}</span>
                             <span class="text-neutral-300">&bull;</span>
                             <span><i class="fa-regular fa-comment mr-1"></i> {{ $post->comments_count ?? 0 }} comments</span>
                         </div>
                     </div>
                </div>
                <div class="flex items-center gap-6">
                    <livewire:post.like-button :newsId="$post->id" />
                    <div class="flex gap-4 text-lg border-l border-neutral-300 pl-6">
                        <a href="#" class="hover:text-accent-red transition"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="#" class="hover:text-accent-red transition"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="hover:text-accent-red transition"><i class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>

            <!-- Featured Image (Square corners, simple border) -->
            <div class="mb-10 border border-black p-1">
                <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : (Str::startsWith($post->image, 'images/') ? asset($post->image) : asset('storage/'.$post->image)) }}" alt="{{ $post->title }}" class="w-full w-full object-contain transition duration-700">
              
            </div>

            <!-- Content (Drop Cap, Serif) -->
            <!-- Content (Drop Cap, Serif) -->
            <div class="prose prose-lg prose-headings:font-serif prose-p:font-serif prose-p:text-[#222] max-w-none leading-relaxed text-justify [&_p]:!my-0 [&_p]:min-h-[1.5rem] [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_li]:mb-1 [&_blockquote]:border-l-4 [&_blockquote]:border-neutral-900 [&_blockquote]:pl-4 [&_blockquote]:italic">
                {!! $post->content !!}
            </div>
            
            <!-- Tags & Share -->
             <div class="mt-12 pt-8 border-t-4 border-double border-black flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex gap-2 flex-wrap font-sans">
                    <span class="text-sm font-bold text-ink mr-2">Filed Under:</span>
                    <a href="{{ route('category', $post->category->slug) }}" class="px-2 py-0.5 border border-black text-xs font-bold hover:bg-black hover:text-white transition uppercase" wire:navigate>{{ $post->category->name }}</a>
                    <a href="{{ route('category', 'india') }}" class="px-2 py-0.5 border border-black text-xs font-bold hover:bg-black hover:text-white transition uppercase">India</a>
                    <a href="{{ route('home') }}" class="px-2 py-0.5 border border-black text-xs font-bold hover:bg-black hover:text-white transition uppercase">News</a>
                </div>
             </div>

             <livewire:post.comment-section :newsId="$post->id" />

        </article>

        <!-- Sidebar (Classic Column) -->
        <aside class="lg:w-1/3 space-y-10 pl-0 lg:pl-8 border-l border-neutral-300">
             
           

            <!-- Author Card -->
             <div class="bg-paper-dark p-6 border border-black text-center">
                 <div class="w-20 h-20 mx-auto rounded-full border border-black mb-4 overflow-hidden">
                     <img src="https://www.w3schools.com/howto/img_avatar.png" alt="{{ $post->author->name ?? 'Author Avatar' }}" class="w-full h-full object-cover">
                 </div>
                 <h3 class="text-lg font-bold text-[#222] mb-1 font-serif">{{ $post->author->name ?? 'Unknown Author' }}</h3>
                 <p class="text-[10px] text-accent-red font-bold uppercase tracking-widest mb-4">Blog Author</p>
                 <p class="text-sm text-[#222] mb-6 font-serif italic border-y border-neutral-300 py-2">"Sharing personal insights and latest updates."</p>
                 <button class="bg-black text-white font-bold py-2 px-6 uppercase text-xs hover:bg-neutral-800 transition tracking-widest">Follow Author</button>
             </div>

             <!-- Related Posts -->
             <div>
                <h3 class="font-sans-caption font-bold border-b border-black mb-4 pb-1">Related Stories</h3>
                <div class="space-y-6">
                    @foreach($relatedPosts as $related)
                    <a href="{{ route('post', $related->slug) }}" class="flex gap-4 group" wire:navigate>
                        <div class="w-20 h-20 border border-black overflow-hidden shrink-0">
                            <img src="{{ Str::startsWith($related->image, 'http') ? $related->image : ($related->image ? asset($related->image) : asset('images/logolight.png')) }}" alt="{{ $related->title }}" class="w-full h-full object-contain transition">
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#222] group-hover:underline transition leading-tight mb-1 font-serif">{{ $related->title }}</h4>
                            <span class="text-[10px] text-neutral-500 font-bold uppercase font-sans">{{ $related->created_at->format('M d, Y') }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
              <!-- Table of Contents Widget -->
             @if(count($toc) > 0)
             <div class="bg-neutral-50 border border-black p-6 sticky top-8 z-10">
                 <h3 class="font-sans font-bold text-xs uppercase tracking-widest border-b-2 border-black pb-3 mb-4 flex items-center gap-2">
                     <i class="fa-solid fa-list-ul text-accent-red"></i> In This Article
                 </h3>
                 <nav>
                     <ul class="space-y-3 font-serif text-sm">
                         @foreach($toc as $item)
                         <li class="{{ $item['level'] <= 2 ? '' : ($item['level'] == 3 ? 'pl-4' : ($item['level'] == 4 ? 'pl-8' : 'pl-12')) }}">
                             <a href="#{{ $item['id'] }}" 
                                class="block text-neutral-600 hover:text-black hover:underline transition-colors leading-tight"
                                @click.prevent="document.getElementById('{{ $item['id'] }}').scrollIntoView({ behavior: 'smooth' })">
                                 {{ $item['title'] }}
                             </a>
                         </li>
                         @endforeach
                     </ul>
                 </nav>
             </div>
             @endif
            
            <!-- Newsletter -->
            <div class="border-y-4 border-double border-black py-8 text-center">
                <h3 class="text-xl font-black font-serif mb-2">The Daily Edition</h3>
                <p class="text-[#222] text-sm mb-4 font-serif italic">Subscribe for the finest journalism.</p>
                <a href="https://www.youtube.com/@officialGlobalInfo" target="_blank" class="block w-full bg-black text-white text-center font-bold py-2 uppercase tracking-widest hover:bg-accent-red transition text-xs">Subscribe on YouTube</a>
            </div>
        </aside>
    </div>
</div>
