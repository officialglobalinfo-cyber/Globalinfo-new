<?php

namespace App\Jobs;

use App\Models\News;
use App\Models\Source;
use App\Services\NewsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class FetchNewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(NewsService $newsService): void
    {
        // Example: Fetch top news
        $articles = $newsService->fetchGNews('top-news'); // Or iterate active sources

        foreach ($articles as $article) {
            News::updateOrCreate(
                ['slug' => Str::slug($article['title'])],
                [
                    'title' => $article['title'],
                    'content' => $article['content'] ?? $article['description'],
                    'image' => $article['image_url'],
                    'published_at' => $article['published_at'],
                    'status' => 'published',
                    'meta_title' => Str::limit($article['title'], 60),
                    'meta_description' => Str::limit($article['description'] ?? '', 160),
                ]
            );
        }
    }
}
