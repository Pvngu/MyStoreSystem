<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(3)->create();

        Category::create([
            'name' => 'None',
            'description' => ''
        ]);

        Category::create([
            'name' => 'Utensils',
            'description' => 'a'
        ]);

        Category::create([
            'name' => 'Electronic',
            'description' => 'b'
        ]);

        Category::create([
            'name' => 'Game systems',
            'description' => 'c'
        ]);

        Category::create([
            'name' => 'Videogames',
            'description' => 'd'
        ]);

        Category::create([
            'name' => 'Desktop computers',
            'description' => 'e'
        ]);

        Item::factory(200)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
