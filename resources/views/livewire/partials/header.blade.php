<div class="font-sans text-neutral-900 selection:bg-accent-red selection:text-white" x-data="{ mobileOpen: false, searchOpen: false }" x-init="$watch('mobileOpen', value => value ? document.body.classList.add('overflow-hidden') : document.body.classList.remove('overflow-hidden'))">
    
    <!-- 1. Top "Data Stream" Bar (Dark) -->
    <div class="bg-black text-white text-[11px] font-mono tracking-tight py-2 border-b border-neutral-800 relative z-[60]">
        <div class="max-w-[1600px] mx-auto px-2 md:px-6 flex justify-between items-center">
             
             <!-- Left: Live Data -->
             <div class="flex items-center gap-6">
                 <div class="flex items-center gap-2 text-accent-red animate-pulse">
                     <span class="w-2 h-2 rounded-full bg-accent-red"></span>
                     <span class="font-bold uppercase tracking-widest">Live</span>
                 </div>
                 <span class="text-neutral-500">|</span>
                 <span class="max-[340px]:hidden uppercase text-neutral-300">{{ now()->format('D, M d, Y') }}</span>

             </div>

             <!-- Center: Ticker -->
             <div class="hidden lg:block flex-1 mx-12 overflow-hidden h-4 relative">
                 <div class="absolute w-full whitespace-nowrap animate-marquee">
                     <span class="mx-4"><span class="text-accent-red font-bold">BREAKING:</span> Global markets reach all-time high amidst tech rally</span>
                     <span class="mx-4 text-neutral-600">///</span>
                     <span class="mx-4"><span class="text-accent-red font-bold">SPORTS:</span> World Cup finals schedule announced</span>
                     <span class="mx-4 text-neutral-600">///</span>
                     <span class="mx-4"><span class="text-accent-red font-bold">TECH:</span> New AI regulations proposed by EU committee</span>
                 </div>
             </div>

             <!-- Right: Utilities -->
             <div class="flex items-center gap-4 uppercase font-bold tracking-wider">
                 @auth
                    <div x-data="{ open: false }" class="relative inline-block text-left">
                        <button @click="open = !open" class="hover:text-accent-red transition-colors font-bold uppercase flex items-center gap-1">
                            Hi, {{ str_replace(' ', '', Auth::user()->name) }} <i class="fa-solid fa-caret-down"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-neutral-200 shadow-xl py-1 z-50">
                             <a href="#" class="block px-4 py-2 text-xs text-black hover:bg-neutral-100">My Profile</a>
                             <!-- Or simple form -->
                             <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-xs text-red-600 hover:bg-neutral-100 uppercase font-bold">Logout</button>
                             </form>
                        </div>
                    </div>
                 @else
                 <a href="{{ route('login') }}" class="hover:text-accent-red transition-colors">Sign In</a>
                 @endauth
                 <div class="hidden md:flex items-center ml-4 border-l border-neutral-800">
                     <a href="https://www.youtube.com/@officialGlobalInfo" target="_blank" class="w-8 h-8 flex items-center justify-center text-neutral-400 hover:text-white hover:bg-[#FF0000] transition-all"><i class="fa-brands fa-youtube"></i></a>
                 </div>
             </div>
        </div>
    </div>

    <!-- 2. Main Header (Sticky & Bordered) -->
    <header class="sticky top-0 z-50 bg-white border-b-2 border-black">
        <div class="max-w-[1600px] mx-auto px-2 md:px-6">
            <div class="flex items-stretch justify-between h-20 md:h-24">
                
                <!-- Logo Section -->
                <div class="flex items-center pr-2 mr-2 md:pr-4 md:mr-4 lg:pr-6 lg:mr-6 xl:pr-8 xl:mr-8 border-r border-neutral-100">
                    <a href="/" class="group block" wire:navigate>
                        <img src="{{asset('images/logolight.png')}}" alt="Global Info" width="213" height="64" fetchpriority="high" class="h-12 md:h-12 lg:h-14 xl:h-16 w-auto object-contain transform group-hover:scale-105 transition-transform duration-500">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex flex-1 items-center justify-center h-full px-0 lg:px-2 xl:px-8">
                    <ul class="flex items-center justify-center gap-4 xl:gap-8 h-full">
                                                {{-- Home Link (Static) --}}
                        <li class="h-full flex items-center">
                            <a href="{{ route('home') }}" 
                               class="font-bold uppercase tracking-widest text-[13px] py-1 transition-colors {{ request()->routeIs('home') ? 'text-accent-red' : 'text-neutral-600 hover:text-accent-red' }}"
                               wire:navigate>
                                Home
                            </a>
                        </li>

                        {{-- Dynamic Categories --}}
                        @foreach($categories as $category)
                        <li class="h-full flex items-center">
                            @php
                                $isActive = request()->routeIs('category') && request()->route('slug') === $category->slug;
                            @endphp
                            <a href="{{ route('category', $category->slug) }}" 
                               class="font-bold uppercase tracking-widest text-[13px] py-1 transition-colors {{ $isActive ? 'text-accent-red' : 'text-neutral-600 hover:text-accent-red' }}"
                               wire:navigate>
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </nav>

                <!-- Actions Section -->
                <div class="flex items-center gap-0 pl-4 md:pl-0">
                    
                    <!-- Search Button -->
                    <button aria-label="Search" @click="searchOpen = !searchOpen" class="h-full px-3 md:px-4 lg:px-6 xl:px-8 border-l border-neutral-100 text-neutral-800 hover:bg-neutral-50 hover:text-accent-red transition-colors flex items-center justify-center">
                        <i class="fa-solid fa-search text-xl"></i>
                    </button>

                    @guest
                    <a href="{{ route('login') }}" class="hidden md:flex h-12 items-center px-4 lg:px-6 xl:px-8 ml-4 lg:ml-6 bg-black text-white text-xs font-bold uppercase tracking-widest hover:bg-accent-red transition-colors" wire:navigate>
                        Login
                    </a>
                    @endguest

                    @auth
                    <a href="https://www.youtube.com/@officialGlobalInfo?sub_confirmation=1" target="_blank" class="hidden md:flex h-12 items-center px-4 lg:px-6 xl:px-8 ml-4 lg:ml-6 bg-[#FF0000] text-white text-xs font-bold uppercase tracking-widest hover:bg-black transition-colors">
                        <i class="fa-brands fa-youtube text-lg mr-2"></i> Subscribe
                    </a>
                    @endauth

                    <!-- Mobile Trigger -->
                     <button @click="mobileOpen = true" class="lg:hidden h-full px-3 md:px-5 border-l border-neutral-100 text-neutral-800 hover:text-accent-red md:ml-0">
                        <div class="flex flex-col gap-1.5 items-end">
                            <span class="w-8 h-[3px] bg-current"></span>
                            <span class="w-6 h-[3px] bg-current"></span>
                            <span class="w-8 h-[3px] bg-current"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mega Search Overlay -->
        <div x-show="searchOpen" 
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="absolute top-full left-0 w-full bg-neutral-900 text-white border-b-4 border-accent-red shadow-2xl z-[60]">
             <div class="max-w-[1200px] mx-auto py-16 px-6">
                 <div class="flex flex-col items-center">
                     <label class="text-xs font-bold uppercase tracking-[0.3em] text-neutral-500 mb-6">Search The Network</label>
                     <form @submit.prevent="Livewire.navigate('{{ route('home') }}?search=' + $el.querySelector('input').value); searchOpen = false" class="w-full max-w-3xl relative">
                        <input type="text" placeholder="Type keywords..." class="w-full bg-transparent border-b-2 border-white/20 text-5xl md:text-7xl font-serif font-bold py-4 focus:border-accent-red focus:outline-none placeholder:text-neutral-700 transition-colors text-center">
                        <button class="absolute right-0 top-1/2 -translate-y-1/2 text-2xl hover:text-accent-red hidden md:block"><i class="fa-solid fa-arrow-right"></i></button>
                     </form>
                     
                     <div class="mt-12 flex flex-wrap justify-center gap-4 text-xs font-mono uppercase">
                         <span class="text-neutral-500">Popular:</span>
                         <a href="#" class="border border-white/20 px-4 py-1 hover:bg-white hover:text-black transition-colors">Technology</a>
                         <a href="#" class="border border-white/20 px-4 py-1 hover:bg-white hover:text-black transition-colors">Startups</a>
                         <a href="#" class="border border-white/20 px-4 py-1 hover:bg-white hover:text-black transition-colors">Markets</a>
                     </div>
                 </div>
                 <button @click="searchOpen = false" class="absolute top-8 right-8 text-neutral-500 hover:text-white"><i class="fa-solid fa-times text-2xl"></i></button>
             </div>
        </div>
    </header>

    <!-- Official Professional Mobile Menu Drawer -->
    <div x-show="mobileOpen" class="fixed inset-0 z-[100] md:hidden" style="display: none;">
        <!-- Standard Dim Backdrop -->
        <div class="absolute inset-0 bg-neutral-900/60 backdrop-blur-sm" 
             @click="mobileOpen = false" 
             x-show="mobileOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>
        
        <!-- Official White Drawer Panel -->
        <div class="absolute right-0 top-0 bottom-0 w-[85%] max-w-sm bg-white flex flex-col transform shadow-[-10px_0_50px_rgba(0,0,0,0.1)] overflow-hidden"
             x-show="mobileOpen"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full">
             
             <!-- Drawer Header -->
             <div class="px-6 py-6 border-b border-neutral-50 flex items-center justify-between bg-white">
                 <img src="{{ asset('images/logolight.png') }}" alt="Logo" class="h-12 w-auto">
                 <button @click="mobileOpen = false" class="w-10 h-10 rounded-xl bg-neutral-50 flex items-center justify-center text-neutral-400 hover:bg-neutral-900 hover:text-white transition-all">
                     <i class="fa-solid fa-xmark text-lg"></i>
                 </button>
             </div>

             <!-- Navigation Content (Official Density) -->
             <div class="flex-1 overflow-y-auto custom-scrollbar">
                
                <!-- Main Links -->
                <div class="p-4 space-y-1">
                    <a href="{{ route('home') }}" 
                       class="flex items-center justify-between p-4 rounded-2xl {{ request()->routeIs('home') ? 'bg-neutral-900 text-white shadow-lg' : 'hover:bg-neutral-50 text-neutral-600' }} transition-all" wire:navigate>
                        <div class="flex items-center gap-4">
                            <span class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('home') ? 'bg-white/10' : 'bg-neutral-100' }}"><i class="fa-solid fa-house text-xs"></i></span>
                            <span class="text-sm font-bold uppercase tracking-widest">Home</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] opacity-20"></i>
                    </a>

                    @foreach($categories as $category)
                    @php 
                        $isActive = request()->routeIs('category') && request()->route('slug') === $category->slug;
                    @endphp
                    <a href="{{ route('category', $category->slug) }}" 
                       class="flex items-center justify-between p-4 rounded-2xl {{ $isActive ? 'bg-neutral-900 text-white shadow-lg' : 'hover:bg-neutral-50 text-neutral-600' }} transition-all" wire:navigate>
                        <div class="flex items-center gap-4">
                            <span class="w-8 h-8 flex items-center justify-center rounded-lg {{ $isActive ? 'bg-white/10' : 'bg-neutral-100 text-neutral-400' }}"><i class="fa-solid fa-hashtag text-xs"></i></span>
                            <span class="text-sm font-bold uppercase tracking-widest">{{ $category->name }}</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] opacity-20"></i>
                    </a>
                    @endforeach
                </div>

                <!-- Subtle Divider -->
                <div class="px-8 my-4"><div class="h-px bg-neutral-50 w-full"></div></div>
             </div>

             <!-- Official Footer -->
             <div class="p-8 bg-neutral-50 border-t border-neutral-100">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-neutral-400">Follow Us</span>
                    <div class="flex gap-3">
                         <a href="https://www.youtube.com/@officialGlobalInfo" target="_blank" class="w-8 h-8 rounded-lg bg-white border border-neutral-200 flex items-center justify-center text-neutral-400 hover:bg-neutral-900 hover:text-white transition-all"><i class="fa-brands fa-youtube text-xs"></i></a>
                    </div>
                </div>
                <div class="text-[10px] text-neutral-400 font-medium">
                    &copy; {{ date('Y') }} Global Info. All rights reserved.
                </div>
             </div>
        </div>
    </div>
</div>
