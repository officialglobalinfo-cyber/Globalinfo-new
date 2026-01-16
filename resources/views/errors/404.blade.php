<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - 404</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:bg-slate-900 font-serif text-ink flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full p-8 text-center border-4 border-double border-neutral-800 bg-white shadow-2xl relative">
        <!-- Newspaper Header decoration -->
        <div class="border-b-2 border-black mb-6 pb-2">
            <h1 class="font-black text-6xl mb-0 leading-none">404</h1>
            <p class="font-sans-caption uppercase tracking-widest text-xs font-bold mt-1">Page Not Found</p>
        </div>

        <div class="mb-8">
            <div class="aspect-video bg-neutral-200 mb-4 border border-black overflow-hidden relative">
                <!-- Static noise effect overlay or simple missing image -->
                <img src="https://picsum.photos/400/300" alt="Missing content" class="w-full h-full object-cover opacity-80">
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="bg-black text-white px-2 py-1 font-bold uppercase text-xs transform -rotate-6 border border-white">Missing Story</span>
                </div>
            </div>
            
            <h2 class="text-2xl font-bold mb-3 leading-tight">The page you are looking for has been moved or deleted.</h2>
            <p class="font-sans text-sm text-gray-600 leading-relaxed">
                It seems our reporters cannot find the story you requested. It might have been archived, removed, or never existed in the first place.
            </p>
        </div>

        <div class="flex flex-col space-y-3">
            <a href="/" class="block w-full bg-black text-white font-bold uppercase text-sm py-3 tracking-wider hover:bg-neutral-800 transition" wire:navigate>
                Return to Front Page
            </a>
            <a href="{{ url()->previous() }}" class="block w-full bg-white border border-black text-black font-bold uppercase text-sm py-3 tracking-wider hover:bg-gray-50 transition">
                Go Back
            </a>
        </div>
        
        <div class="mt-8 border-t border-black pt-2">
            <p class="text-[10px] font-sans text-gray-400 uppercase">Vol. 404 • No. 000 • Est. 2026</p>
        </div>
    </div>
</body>
</html>
