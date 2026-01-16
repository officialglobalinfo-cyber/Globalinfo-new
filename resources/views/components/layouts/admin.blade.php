<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/globalinfo.svg') }}">
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white flex flex-col">
            <div class="h-16 flex items-center justify-center border-b border-slate-700">
                <span class="text-xl font-bold">News Admin</span>
            </div>
            <nav class="flex-1 px-2 py-4 space-y-2">
                <a href="/admin/dashboard" wire:navigate class="block px-4 py-2 hover:bg-slate-800 rounded {{ request()->is('admin/dashboard') ? 'bg-slate-800' : '' }}">
                    Dashboard
                </a>
                <a href="/admin/news" wire:navigate class="block px-4 py-2 hover:bg-slate-800 rounded {{ request()->is('admin/news*') ? 'bg-slate-800' : '' }}">
                    News / Blog
                </a>
                <a href="/admin/market" wire:navigate class="block px-4 py-2 hover:bg-slate-800 rounded {{ request()->is('admin/market*') ? 'bg-slate-800' : '' }}">
                    Market
                </a>
                <a href="/admin/cricket" wire:navigate class="block px-4 py-2 hover:bg-slate-800 rounded {{ request()->is('admin/cricket*') ? 'bg-slate-800' : '' }}">
                    Cricket
                </a>
                <a href="{{ route('admin.categories.index') }}" wire:navigate class="block px-4 py-2 hover:bg-slate-800 rounded {{ request()->is('admin/categories*') ? 'bg-slate-800' : '' }}">
                    Categories
                </a>
                <div class="border-t border-slate-700 my-2"></div>
                <a href="#" class="block px-4 py-2 hover:bg-slate-800 rounded">
                    Settings
                </a>
            </nav>
            <div class="p-4 border-t border-slate-700">
                <div class="text-sm">User: {{ auth()->user()->name ?? 'Guest' }}</div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6">
                <h1 class="text-lg font-semibold text-gray-800">{{ $header ?? 'Dashboard' }}</h1>
                <div>
                     <!-- Logout Button -->
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
