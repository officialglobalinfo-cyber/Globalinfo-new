<div class="max-w-4xl mx-auto py-12 px-6">
    <h1 class="text-4xl font-black font-serif mb-8 border-b-2 border-black pb-4">Sitemap</h1>
    
    <div class="grid md:grid-cols-2 gap-12 font-serif">
        <div>
            <h3 class="text-2xl font-bold mb-4 uppercase tracking-widest font-sans">Main Navigation</h3>
            <ul class="space-y-3 text-lg">
                <li><a href="{{ route('home') }}" class="hover:text-accent-red underline decoration-neutral-300 underline-offset-4">Home</a></li>
                <li><a href="{{ route('category', 'india') }}" class="hover:text-accent-red underline decoration-neutral-300 underline-offset-4">India</a></li>
                <li><a href="{{ route('category', 'world') }}" class="hover:text-accent-red underline decoration-neutral-300 underline-offset-4">World</a></li>
                <li><a href="{{ route('category', 'business') }}" class="hover:text-accent-red underline decoration-neutral-300 underline-offset-4">Business</a></li>
                <li><a href="{{ route('category', 'technology') }}" class="hover:text-accent-red underline decoration-neutral-300 underline-offset-4">Technology</a></li>
                <li><a href="{{ route('category', 'science') }}" class="hover:text-accent-red underline decoration-neutral-300 underline-offset-4">Science</a></li>
                <li><a href="{{ route('category', 'entertainment') }}" class="hover:text-accent-red underline decoration-neutral-300 underline-offset-4">Entertainment</a></li>
                <li><a href="{{ route('category', 'lifestyle') }}" class="hover:text-accent-red underline decoration-neutral-300 underline-offset-4">Lifestyle</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-2xl font-bold mb-4 uppercase tracking-widest font-sans">Utility</h3>
            <ul class="space-y-3 text-lg">
                <li><a href="{{ route('login') }}" class="hover:text-accent-red underline decoration-neutral-300 underline-offset-4">Sign In</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-accent-red underline decoration-neutral-300 underline-offset-4">Create Account</a></li>
                <li><a href="{{ route('privacy') }}" class="hover:text-accent-red underline decoration-neutral-300 underline-offset-4">Privacy Policy</a></li>
                <li><a href="{{ route('terms') }}" class="hover:text-accent-red underline decoration-neutral-300 underline-offset-4">Terms & Conditions</a></li>
            </ul>
        </div>
    </div>
</div>
