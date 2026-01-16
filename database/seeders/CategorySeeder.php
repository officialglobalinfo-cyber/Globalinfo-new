<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'National', 'color' => 'bg-blue-600'],
            ['name' => 'World', 'color' => 'bg-indigo-600'],
            ['name' => 'Business', 'color' => 'bg-green-600'],
            ['name' => 'Technology', 'color' => 'bg-gray-600'],
            ['name' => 'Sports', 'color' => 'bg-red-600'],
            ['name' => 'Entertainment', 'color' => 'bg-purple-600'],
            ['name' => 'Health', 'color' => 'bg-teal-600'],
            ['name' => 'Science', 'color' => 'bg-cyan-600'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'type' => 'news',
                    'color' => $cat['color'],
                    'is_active' => true
                ]
            );
        }
    }
}
