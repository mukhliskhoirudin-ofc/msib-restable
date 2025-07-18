<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Starters',
            'slug' => 'starters'
        ]);

        Category::create([
            'name' => 'Breakfast',
            'slug' => 'breakfast'
        ]);

        Category::create([
            'name' => 'Lunch',
            'slug' => 'lunch'
        ]);

        Category::create([
            'name' => 'Dinner',
            'slug' => 'dinner'
        ]);
    }
}
