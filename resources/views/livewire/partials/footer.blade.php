<footer class="bg-slate-50 text-neutral-900 pt-16 pb-8 border-t-8 border-double border-black font-serif relative">
    
    <div class="max-w-screen-2xl mx-auto px-6 lg:px-12">
        
        <!-- Masthead -->
        <div class="border-b-4 border-black mb-12 pb-8 text-center">
            <img src="{{asset('images/logolight.png')}}" alt="Global Info" class="mx-auto h-12 md:h-12 lg:h-14 xl:h-16 w-auto mb-4">
            <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-2 text-xs md:text-sm font-sans font-bold uppercase tracking-widest text-neutral-600">
                <span>Est. 2024</span>
                <span class="hidden xs:inline text-black">•</span>
                <span>The Daily Edition</span>
                <span class="hidden xs:inline text-black">•</span>
                <span>Vol. CDXX</span>
            </div>
        </div>

        <!-- Main Footer Links Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-0 mb-16 border-b border-black pb-12">
            
            <!-- Column 1: Editorial -->
            <div class="lg:pr-8 lg:border-r border-black/20">
                <h3 class="font-bold text-lg mb-6 uppercase tracking-wider border-b-2 border-black inline-block">Editorial</h3>
                <p class="font-sans text-sm leading-relaxed mb-6 text-neutral-700 text-justify">
                    <span class="font-bold text-3xl float-left mr-2 mt-[-6px] font-serif">W</span>e are dedicated to the pursuit of truth. In an era of noise, we provide the signal. Global Info brings you unvarnished reporting from every corner of the globe, analyzing the currents that shape our tomorrow.
                </p>
                <div class="flex gap-4">
                    <a href="https://www.youtube.com/@officialGlobalInfo" target="_blank" class="text-neutral-800 hover:text-[#c30000] transition-colors"><i class="fa-brands fa-youtube text-xl"></i></a>
                </div>
            </div>

            <!-- Wrapper to make Sections and Essentials side-by-side on mobile -->
            <div class="grid grid-cols-2 lg:contents lg:gap-0 gap-8">
                <!-- Column 2: Sections -->
                <div class="lg:px-8 lg:border-r border-black/20 font-sans">
                    <h3 class="font-bold text-lg mb-6 uppercase tracking-wider border-b-2 border-black inline-block font-serif">Sections</h3>
                    <ul class="space-y-3 text-sm font-medium">
                        <li><a href="{{ route('category', 'world') }}" class="flex items-center group" wire:navigate><span class="w-2 h-2 bg-black mr-3 group-hover:bg-[#c30000] transition-colors"></span><span class="group-hover:translate-x-1 transition-transform group-hover:underline decoration-[#c30000] decoration-2 underline-offset-4 font-bold uppercase tracking-widest text-xs">World News</span></a></li>
                        <li><a href="{{ route('category', 'technology') }}" class="flex items-center group" wire:navigate><span class="w-2 h-2 bg-black mr-3 group-hover:bg-[#c30000] transition-colors"></span><span class="group-hover:translate-x-1 transition-transform group-hover:underline decoration-[#c30000] decoration-2 underline-offset-4 font-bold uppercase tracking-widest text-xs">Technology</span></a></li>
                        <li><a href="{{ route('category', 'business') }}" class="flex items-center group" wire:navigate><span class="w-2 h-2 bg-black mr-3 group-hover:bg-[#c30000] transition-colors"></span><span class="group-hover:translate-x-1 transition-transform group-hover:underline decoration-[#c30000] decoration-2 underline-offset-4 font-bold uppercase tracking-widest text-xs">Economy</span></a></li>
                        <li><a href="{{ route('category', 'lifestyle') }}" class="flex items-center group" wire:navigate><span class="w-2 h-2 bg-black mr-3 group-hover:bg-[#c30000] transition-colors"></span><span class="group-hover:translate-x-1 transition-transform group-hover:underline decoration-[#c30000] decoration-2 underline-offset-4 font-bold uppercase tracking-widest text-xs">Culture</span></a></li>
                    </ul>
                </div>

                <!-- Column 3: Essentials -->
                <div class="lg:px-8 lg:border-r border-black/20 font-sans">
                    <h3 class="font-bold text-lg mb-6 uppercase tracking-wider border-b-2 border-black inline-block font-serif">Essentials</h3>
                    <ul class="space-y-3 text-sm font-bold uppercase tracking-widest text-xs text-neutral-600">
                        <li><a href="{{ route('about') }}" class="hover:text-[#c30000] transition-colors flex items-center gap-2 underline decoration-1 underline-offset-4" wire:navigate>About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-[#c30000] transition-colors flex items-center gap-2 underline decoration-1 underline-offset-4" wire:navigate>Contact Us</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-[#c30000] transition-colors flex items-center gap-2 underline decoration-1 underline-offset-4">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <!-- Column 4: Newsletter -->
            <div class="lg:pl-8">
                <div class="border-2 border-dashed border-black p-6 bg-white hover:shadow-xl transition-shadow duration-300 relative shadow-md">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-slate-50 px-3 font-bold uppercase text-[10px] tracking-widest border border-black">Special Access</div>
                    <h4 class="font-black text-xl mb-2 text-center uppercase">The Daily Briefing</h4>
                    <p class="font-sans text-[11px] text-center text-neutral-600 mb-4 italic">"All the news that fits in your inbox."</p>
                    
                    <a href="https://www.youtube.com/@officialGlobalInfo" target="_blank" class="block w-full bg-black text-white text-center font-black uppercase text-xs tracking-widest py-3 mt-3 hover:bg-[#c30000] transition-colors shadow-lg">
                        Subscribe on YouTube
                    </a>
                    
                    <div class="mt-4 pt-3 border-t border-black/10 flex justify-between text-[9px] font-sans font-bold text-neutral-400 uppercase tracking-tighter">
                        <span>No Spam</span>
                        <span>Cancel Anytime</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="font-sans text-[10px] font-bold uppercase tracking-widest flex flex-col md:flex-row justify-between items-center text-neutral-400 pb-8 gap-4">
            <p>&copy; {{ date('Y') }} Global Info Network. All rights reserved.</p>
            <div class="flex gap-6">
                <a href="{{ route('privacy') }}" class="hover:text-black transition-colors" wire:navigate>Privacy</a>
                <a href="{{ route('terms') }}" class="hover:text-black transition-colors" wire:navigate>Terms</a>
                <a href="{{ route('sitemap') }}" class="hover:text-black transition-colors" wire:navigate>Sitemap</a>
            </div>
        </div>
    </div>
</footer>
