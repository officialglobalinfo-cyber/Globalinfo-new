<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\SinglePost;
use App\Livewire\CategoryPage;
use App\Livewire\Admin\Login;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Posts\PostIndex;
use App\Livewire\Admin\Posts\PostForm;
use App\Livewire\Admin\Categories\CategoryIndex;
use App\Livewire\Admin\Categories\CategoryForm;

// Public Routes
Route::get('/', HomePage::class)->name('home');
Route::get('/post/{slug}', SinglePost::class)->name('post');
Route::get('/category/{slug}', CategoryPage::class)->name('category');
Route::get('/about-us', \App\Livewire\AboutUs::class)->name('about');
Route::get('/contact-us', \App\Livewire\ContactUs::class)->name('contact');
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap.xml');

// User Auth
Route::get('/register', \App\Livewire\Auth\Register::class)->name('register');
Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
Route::post('/logout', function () {
    Illuminate\Support\Facades\Auth::logout();
    session()->invalidate();
    session()->regenerateToken(); 
    return redirect('/');
})->name('logout');

// Admin Auth
Route::get('/admin/login', Login::class)->name('admin.login');

// Utility Pages
Route::get('/privacy-policy', \App\Livewire\Pages\Privacy::class)->name('privacy');
Route::get('/terms-and-conditions', \App\Livewire\Pages\Terms::class)->name('terms');
Route::get('/sitemap', \App\Livewire\Pages\Sitemap::class)->name('sitemap');

// Admin Protected Routes
// Admin Protected Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    // News / Blog
    Route::get('/news', \App\Livewire\Admin\News\Index::class)->name('news.index');
    Route::get('/news/create', \App\Livewire\Admin\News\Form::class)->name('news.create');
    Route::get('/news/{news}/edit', \App\Livewire\Admin\News\Form::class)->name('news.edit');

    // Market
    Route::get('/market', \App\Livewire\Admin\Market\Index::class)->name('market.index');
    
    // Cricket
    Route::get('/cricket', \App\Livewire\Admin\Cricket\Index::class)->name('cricket.index');

    // Posts (Legacy/Blog) - keeping if needed, or remove? User asked for News/Blog.
    // We can alias News as the main Blog system. Use News model for now.
    
    // Categories
    Route::get('/categories', CategoryIndex::class)->name('categories.index');
    Route::get('/categories/create', CategoryForm::class)->name('categories.create');
    Route::get('/categories/{category}/edit', CategoryForm::class)->name('categories.edit');
});

require __DIR__ . '/diagnose.php';
