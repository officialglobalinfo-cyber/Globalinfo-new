<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Category;
use App\Models\User;
use App\Models\Stock;
use App\Models\StockPrice;
use App\Models\CricketMatch;
use App\Models\CricketScore;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure we have a user
        $author = User::first() ?? User::factory()->create();
        
        // 1. Seed Stocks
        $stocks = [
            ['symbol' => 'RELIANCE', 'name' => 'Reliance Industries', 'price' => 2580.45, 'change' => 15.20],
            ['symbol' => 'TCS', 'name' => 'Tata Consultancy Svcs', 'price' => 3450.10, 'change' => -12.50],
            ['symbol' => 'HDFCBANK', 'name' => 'HDFC Bank', 'price' => 1650.00, 'change' => 5.00],
            ['symbol' => 'INFY', 'name' => 'Infosys Ltd', 'price' => 1420.30, 'change' => 8.10],
            ['symbol' => 'ICICIBANK', 'name' => 'ICICI Bank', 'price' => 980.50, 'change' => -2.10],
            ['symbol' => 'SBIN', 'name' => 'State Bank of India', 'price' => 590.20, 'change' => 1.50],
        ];

        foreach ($stocks as $stockData) {
            $stock = Stock::firstOrCreate(
                ['symbol' => $stockData['symbol']],
                ['name' => $stockData['name'], 'is_active' => true]
            );

            StockPrice::create([
                'stock_id' => $stock->id,
                'price' => $stockData['price'],
                'change' => $stockData['change'],
                'change_percent' => round(($stockData['change'] / $stockData['price']) * 100, 2),
                'timestamp' => now(),
            ]);
        }

        // 2. Seed Cricket Matches
        $liveMatch = CricketMatch::create([
            'series_name' => 'IPL 2026',
            // 'match_desc' => 'Final', // Removed
            'status' => 'live',
            'team_home' => 'CSK',
            'team_away' => 'MI',
            'match_time' => now()->subHours(2),
        ]);

        CricketScore::create([
            'match_id' => $liveMatch->id,
            'home_score' => '185/4 (19.2)',
            'away_score' => '182/8 (20)',
            'status_text' => 'CSK need 4 runs in 4 balls',
        ]);

        CricketMatch::create([
            'series_name' => 'The Ashes',
            // 'match_desc' => '1st Test', // Removed
            'status' => 'upcoming',
            'team_home' => 'ENG',
            'team_away' => 'AUS',
            'match_time' => now()->addDays(2),
        ]);

        // 3. Seed News Articles
        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            return;
        }

         $newsItems = [
            [
                'title' => 'India Launches Mission to Mars: A Historic Leap Used for Global Science',
                'cat' => 'Science',
                'breaking' => true,
                'featured' => true,
            ],
            [
                'title' => 'Sensex Hits All-Time High as Tech Stocks Rally',
                'cat' => 'Business',
                'breaking' => false,
                'featured' => true,
            ],
            [
                'title' => 'New Education Policy Implemented Across All States',
                'cat' => 'National',
                'breaking' => false,
                'featured' => false,
            ],
            [
                'title' => 'Global Climate Summit Ends with Historic Agreement',
                'cat' => 'World',
                'breaking' => false,
                'featured' => true,
            ],
            [
                'title' => 'Virat Kohli Announces Retirement from T20 Internationals',
                'cat' => 'Sports',
                'breaking' => true,
                'featured' => false,
            ],
             [
                'title' => 'AI Revolution: How Generative AI is changing the Job Market',
                'cat' => 'Technology',
                'breaking' => false,
                'featured' => true,
            ],
             [
                'title' => 'Top 10 Travel Destinations for Summer 2026',
                'cat' => 'Entertainment',
                'breaking' => false,
                'featured' => false,
            ],
             [
                'title' => 'Breakthrough in Cancer Research: New Drug Shows Promise',
                'cat' => 'Health',
                'breaking' => true,
                'featured' => false,
            ],
            [
                'title' => 'Electric Vehicles Sales Surpass Traditional Cars in Nordic Region',
                'cat' => 'Business',
                'breaking' => false,
                'featured' => false,
            ],
             [
                'title' => 'ISRO plans next lunar mission for 2028',
                'cat' => 'Science',
                'breaking' => false,
                'featured' => false,
            ],
        ];

        foreach ($newsItems as $item) {
             $category = $categories->where('name', $item['cat'])->first() ?? $categories->first();
             
             News::create([
                 'title' => $item['title'],
                 'slug' => Str::slug($item['title']) . '-' . rand(1000, 9999),
                 'content' => '<p>' . fake()->paragraphs(3, true) . '</p><p>' . fake()->paragraphs(2, true) . '</p>',
                 'meta_description' => fake()->sentence(20), // As excerpt
                 'image' => null, 
                 'category_id' => $category->id,
                 'user_id' => $author->id, // Corrected
                 'status' => 'published',
                 'is_breaking' => $item['breaking'],
                 'is_featured' => $item['featured'],
                 // 'is_trending' => rand(0, 1), // Removed
                 'published_at' => now()->subMinutes(rand(10, 5000)),
                 // 'views' => rand(100, 50000), // Views typically added by logic, but field might not be fillable unless added. The migration has it, but fillable?
             ]);
        }
        
        // Generate more random news
        foreach(range(1, 25) as $i) {
             $cat = $categories->random();
             News::create([
                 'title' => fake()->sentence(6),
                 'slug' => Str::slug(fake()->sentence(6)) . '-' . rand(1000, 9999),
                 'content' => fake()->paragraphs(3, true),
                 'meta_description' => fake()->sentence(15),
                 'image' => null,
                 'category_id' => $cat->id,
                 'user_id' => $author->id,
                 'status' => 'published',
                 'is_breaking' => rand(0, 10) > 8, // 20% chance
                 // 'is_trending' => rand(0, 10) > 7, // 30% chance
                 'published_at' => now()->subMinutes(rand(10, 10000)),
             ]);
        }
    }
}
