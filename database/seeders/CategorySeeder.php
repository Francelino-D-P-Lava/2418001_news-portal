<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Politik', 'slug' => 'politik', 'description' => 'Berita seputar politik'],
            ['name' => 'Olahraga', 'slug' => 'olahraga', 'description' => 'Berita olahraga'],
            ['name' => 'Teknologi', 'slug' => 'teknologi', 'description' => 'Berita teknologi'],
            ['name' => 'Ekonomi', 'slug' => 'ekonomi', 'description' => 'Berita ekonomi'],
            ['name' => 'Hiburan', 'slug' => 'hiburan', 'description' => 'Berita hiburan'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}