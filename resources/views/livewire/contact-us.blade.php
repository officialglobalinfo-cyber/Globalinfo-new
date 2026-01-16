@section('meta_title', 'Contact Us - Global Info')
@section('meta_description', 'Contact Global Info - Get in touch with us for inquiries, tips, or feedback.')
@section('canonical_url', route('contact'))

@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "ContactPage",
  "mainEntityOfPage": {
    "@@type": "WebPage",
    "@@id": "{{ route('contact') }}"
  },
  "headline": "Contact Global Info",
  "description": "Get in touch with Global Info.",
  "url": "{{ route('contact') }}"
}
</script>
@endpush



<div class="min-h-screen bg-slate-50 font-serif text-neutral-900">
    
    <!-- Header Hero -->
    <div class="bg-black text-white py-16 px-6 border-b border-neutral-800">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 tracking-tight">Contact Us</h1>
            <p class="text-lg md:text-xl text-neutral-400 font-sans max-w-xl mx-auto">
                Got a tip? A question? Or just want to say hello? We're listening.
            </p>
        </div>
    </div>

    <div class="max-w-screen-xl mx-auto px-6 py-16">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-24">
            
            <!-- Contact Form -->
            <div class="lg:col-span-7">
                <div class="bg-white p-8 md:p-12 border border-neutral-200 shadow-sm">
                    <h2 class="text-2xl font-bold mb-8 font-serif">Send us a message</h2>
                    
                    <form wire:submit.prevent="submit" class="font-sans space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-neutral-500 mb-2">Your Name</label>
                                <input type="text" class="w-full bg-slate-50 border-b-2 border-neutral-200 p-3 focus:outline-none focus:border-black transition-colors" placeholder="John Doe">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-neutral-500 mb-2">Email Address</label>
                                <input type="email" class="w-full bg-slate-50 border-b-2 border-neutral-200 p-3 focus:outline-none focus:border-black transition-colors" placeholder="john@example.com">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-neutral-500 mb-2">Subject</label>
                            <select class="w-full bg-slate-50 border-b-2 border-neutral-200 p-3 focus:outline-none focus:border-black transition-colors text-neutral-600">
                                <option>General Inquiry</option>
                                <option>News Tip</option>
                                <option>Advertising</option>
                                <option>Correction / Feedback</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-neutral-500 mb-2">Message</label>
                            <textarea rows="6" class="w-full bg-slate-50 border-b-2 border-neutral-200 p-3 focus:outline-none focus:border-black transition-colors resize-none" placeholder="How can we help you?"></textarea>
                        </div>

                        <button type="submit" class="bg-black text-white px-8 py-4 font-bold uppercase tracking-widest text-xs hover:bg-accent-red transition-colors w-full md:w-auto">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="lg:col-span-5 font-sans">
                <div class="sticky top-24">
                    
                    <!-- Direct Contact -->
                    <div class="mb-12">
                        <h3 class="font-bold text-lg mb-6 border-b-2 border-black inline-block pb-1">Get in Touch</h3>
                        <div class="space-y-6 text-sm text-neutral-600">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-neutral-100 flex items-center justify-center shrink-0 text-black"><i class="fa-solid fa-envelope"></i></div>
                                <div>
                                    <p class="font-bold text-black mb-1">Email Us</p>
                                    <a href="mailto:official.globalinfo@gmail.com" class="hover:text-accent-red transition-colors">official.globalinfo@gmail.com</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Connect -->
                    <div class="mb-12">
                        <h3 class="font-bold text-lg mb-6 border-b-2 border-black inline-block pb-1">Follow Us</h3>
                        <div class="flex gap-4">
                            <a href="https://www.youtube.com/@officialGlobalInfo" target="_blank" class="w-12 h-12 border border-neutral-200 flex items-center justify-center text-neutral-400 hover:bg-black hover:text-white hover:border-black transition-all">
                                <i class="fa-brands fa-youtube text-xl"></i>
                            </a>
                            <!-- Placeholder for other networks if needed -->
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>
</div>
