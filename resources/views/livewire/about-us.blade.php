@section('meta_title', 'About Us - Global Info')
@section('meta_description', 'About Global Info - A personal blog by JayPrakash sharing insights on technology, lifestyle, and global events.')
@section('canonical_url', route('about'))

@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "AboutPage",
  "mainEntityOfPage": {
    "@@type": "WebPage",
    "@@id": "{{ route('about') }}"
  },
  "headline": "About Global Info",
  "description": "Global Info is a personal blog sharing insights on technology, lifestyle, and global events.",
  "publisher": {
    "@@type": "Person",
    "name": "JayPrakash",
    "url": "{{ route('home') }}"
  }
}
</script>
@endpush



<div class="min-h-screen bg-slate-50 font-serif text-neutral-900">
    <!-- Header Hero -->
    <div class="bg-black text-white py-20 px-6 border-b-8 border-accent-red relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-neutral-900/50 skew-x-12 translate-x-20"></div>
        <div class="max-w-4xl mx-auto relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 tracking-tight">Just a Blog</h1>
            <p class="text-xl md:text-2xl text-neutral-400 font-sans max-w-2xl mx-auto leading-relaxed">
                No corporate agenda. No breaking news stress. Just stories we love.
            </p>
        </div>
    </div>

    <div class="max-w-screen-xl mx-auto px-6 py-16">
        
        <!-- Mission Statement -->
        <div class="grid md:grid-cols-12 gap-12 items-center mb-24">
            <div class="md:col-span-12 lg:col-span-8">
                <span class="text-accent-red font-bold uppercase tracking-widest text-sm mb-4 block font-sans">Our Story</span>
                <h2 class="text-4xl font-bold mb-8 leading-tight">We are not journalists. We are storytellers.</h2>
                <div class="prose prose-lg text-neutral-600 font-sans">
                    <p class="mb-6">Global Info isn't a massive media conglomerate or a professional news network. It started with a simple idea: to read, research, and write about the things that fascinate us.</p>
                    <p>We are just normal people who love to blog. Whether it's the latest tech trend, a sports update, or a cultural event, we share our personal take on it. Our goal isn't to be the first to break the news, but to share information in a way that is easy to understand and fun to read.</p>
                </div>
            </div>
             <div class="md:col-span-12 lg:col-span-4 relative">
                <div class="border-4 border-black p-2">
                    <img src="{{ asset('images/logolight.png') }}" alt="Global Info Logo" class="w-full h-auto bg-neutral-100 p-8 grayscale hover:grayscale-0 transition-all duration-500">
                </div>
            </div>
        </div>

        <!-- Values Grid -->
        <div class="mb-24">
            <div class="border-t border-b border-black py-16">
                <div class="grid md:grid-cols-3 gap-12 font-sans">
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-neutral-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-accent-red group-hover:text-white transition-colors">
                            <i class="fa-solid fa-pen-nib text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-3">Pure Blogging</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed px-4">We write for the love of writing. No complex jargon, just simple blogs.</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-neutral-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-accent-red group-hover:text-white transition-colors">
                            <i class="fa-solid fa-heart text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-3">Personal Touch</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed px-4">Every post reflects our personal interests and research. It's human, not automated.</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-neutral-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-accent-red group-hover:text-white transition-colors">
                            <i class="fa-solid fa-lightbulb text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-3">Knowledge Sharing</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed px-4">We learn something new, and we pass it on to you. Simple as that.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="max-w-4xl mx-auto text-center">
            <span class="text-accent-red font-bold uppercase tracking-widest text-sm mb-4 block font-sans">The Creator</span>
            <h2 class="text-3xl font-bold mb-12">Who's Writing?</h2>
            
            <div class="grid md:grid-cols-2 gap-8 font-sans text-left mx-auto max-w-lg">
                <!-- Creator Profile -->
                <div class="col-span-2 flex items-start gap-6 p-6 border border-neutral-200 hover:border-black transition-colors bg-white">
                    <div class="w-20 h-20 bg-neutral-200 shrink-0 overflow-hidden">
                         <i class="fa-solid fa-user text-4xl text-neutral-400 w-full h-full flex items-center justify-center"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">JayPrakash</h4>
                        <p class="text-accent-red text-xs uppercase tracking-widest font-bold mb-3">Admin & Blogger</p>
                        <p class="text-neutral-500 text-sm">Just a tech enthusiast and information lover. I built Global Info to share what I find interesting with the world.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
