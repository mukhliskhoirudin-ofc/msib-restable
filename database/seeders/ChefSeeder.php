<?php

namespace Database\Seeders;

use App\Models\Chef;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chef::create([
            'name' => 'Chef 1',
            'position' => 'Position 1',
            'description' => 'Description 1',
            'image' => 'image1.jpg',
            'insta_link' => 'https://instagram.com/chef1',
            'linked_link' => 'https://linkedin.com/chef1'
        ]);

        Chef::create([
            'name' => 'Chef 2',
            'position' => 'Position 2',
            'description' => 'Description 2',
            'image' => 'image2.jpg',
            'insta_link' => 'https://instagram.com/chef2',
            'linked_link' => 'https://linkedin.com/chef2'
        ]);

        Chef::create([
            'name' => 'Chef 3',
            'position' => 'Position 3',
            'description' => 'Description 3',
            'image' => 'image3.jpg',
            'insta_link' => 'https://instagram.com/chef3',
            'linked_link' => 'https://linkedin.com/chef3'
        ]);
    }
}
