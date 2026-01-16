<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = News::latest()->get();
        $categories = Category::all();

        // Static Pages
        $urls = [
            [
                'loc' => route('home'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '1.0'
            ],
            [
                'loc' => route('about'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => route('contact'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => route('privacy'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'yearly',
                'priority' => '0.5'
            ],
            [
                'loc' => route('terms'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'yearly',
                'priority' => '0.5'
            ],
        ];

        // Categories
        foreach ($categories as $category) {
            $urls[] = [
                'loc' => route('category', $category->slug),
                'lastmod' => $category->updated_at ? $category->updated_at->toAtomString() : now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ];
        }

        // Posts
        foreach ($posts as $post) {
            $urls[] = [
                'loc' => route('post', $post->slug),
                'lastmod' => $post->updated_at ? $post->updated_at->toAtomString() : ($post->published_at ? \Carbon\Carbon::parse($post->published_at)->toAtomString() : now()->toAtomString()),
                'changefreq' => 'weekly',
                'priority' => '0.9'
            ];
        }

        return response()->view('sitemap', compact('urls'))->header('Content-Type', 'text/xml');
    }
}
