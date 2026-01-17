<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('meta_title', $title ?? 'Global Info - Premium Tech & Lifestyle')</title>

    <!-- ✅ FAVICON (GOOGLE + BROWSER SAFE) -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    @yield('preload_lcp')
    @stack('schema')

    <!-- SEO -->
    <meta name="description" content="@yield('meta_description', 'Global Info delivers the latest technology, lifestyle, and global news with a premium reading experience.')">
    <meta name="keywords" content="@yield('meta_keywords', 'news, tech, lifestyle, global, updates')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">
    <meta name="google-site-verification" content="ynV-CAitiicRp0k50PTTIZeYlnb6K6wEGX_GZcGVQxI" />

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', $title ?? 'Global Info')">
    <meta property="og:description" content="@yield('og_description', 'Global Info - Premium News')">
    <meta property="og:image" content="@yield('og_image', asset('images/logolight.png'))">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', $title ?? 'Global Info')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Global Info - Premium News')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logolight.png'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,900;1,400&display=swap" rel="stylesheet">

    <!-- Font Awesome (Non-blocking) -->
    <link rel="preload"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </noscript>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-267MKH872R"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-267MKH872R');
    </script>
</head>

<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:bg-gradient-to-br dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 text-ink font-sans antialiased selection:bg-indigo-500 selection:text-white min-h-screen">

    <livewire:partials.header />

    <main>
        {{ $slot }}
    </main>

    <livewire:partials.footer />

</body>
</html>
