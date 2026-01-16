<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return;
        }

        foreach ($categories as $category) {
            for ($i = 1; $i <= 5; $i++) {
                $title = $category->name . ' Post ' . $i;
                Post::create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                    'title' => $title,
                    'slug' => Str::slug($title . '-' . rand(1000,9999)),
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'image' => null, // View will fallback to picsum
                    'is_featured' => rand(0, 1) == 1,
                    'is_trending' => rand(0, 1) == 1,
                    'published_at' => now(),
                    'views' => rand(100, 5000),
                ]);
            }
        }
    }
}
