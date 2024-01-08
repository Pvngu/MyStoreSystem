<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\City;
use App\Models\Item;
use App\Models\Order;
use App\Models\Address;
use App\Models\Country;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(3)->create();

        $categoriesData = [
            ['name' => 'None', 'description' => '', 'image' => ''],
            ['name' => 'Utensils', 'description' => 'a', 'image' => ''],
            ['name' => 'Electronic', 'description' => 'b', 'image' => ''],
            ['name' => 'Game systems', 'description' => 'c', 'image' => ''],
            ['name' => 'Videogames', 'description' => 'd', 'image' => ''],
            ['name' => 'Desktop computers', 'description' => 'e', 'image' => ''],
        ];
        
        foreach ($categoriesData as $data) {
            Category::create($data);
        }

        Item::factory(200)->create();

        $countriesData = [
            ['name' => 'United States'],
            ['name' => 'Mexico'],
            ['name' => 'Canada']
        ];

        foreach ($countriesData as $data) {
            Country::create($data);
        }

        $citiesData = [
            // United States
            ['name' => 'New York', 'country_id' => 1],
            ['name' => 'Los Angeles', 'country_id' => 1],
            ['name' => 'Chicago', 'country_id' => 1],
            ['name' => 'Houston', 'country_id' => 1],
            ['name' => 'Phoenix', 'country_id' => 1],
            ['name' => 'Philadelphia', 'country_id' => 1],
            ['name' => 'San Antonio', 'country_id' => 1],
            ['name' => 'San Diego', 'country_id' => 1],
            ['name' => 'Dallas', 'country_id' => 1],
            ['name' => 'San Francisco', 'country_id' => 1],
        
            // Mexico
            ['name' => 'Mexico City', 'country_id' => 2],
            ['name' => 'Guadalajara', 'country_id' => 2],
            ['name' => 'Monterrey', 'country_id' => 2],
            ['name' => 'Puebla', 'country_id' => 2],
            ['name' => 'Tijuana', 'country_id' => 2],
            ['name' => 'Merida', 'country_id' => 2],
            ['name' => 'Cancun', 'country_id' => 2],
            ['name' => 'Leon', 'country_id' => 2],
            ['name' => 'Queretaro', 'country_id' => 2],
            ['name' => 'Toluca', 'country_id' => 2],
        
            // Canada
            ['name' => 'Toronto', 'country_id' => 3],
            ['name' => 'Vancouver', 'country_id' => 3],
            ['name' => 'Montreal', 'country_id' => 3],
            ['name' => 'Calgary', 'country_id' => 3],
            ['name' => 'Edmonton', 'country_id' => 3],
            ['name' => 'Ottawa', 'country_id' => 3],
            ['name' => 'Winnipeg', 'country_id' => 3],
            ['name' => 'Quebec City', 'country_id' => 3],
            ['name' => 'Hamilton', 'country_id' => 3],
            ['name' => 'London', 'country_id' => 3],
        ];

        foreach ($citiesData as $data) {
            City::create($data);
        }

        Address::factory(50)->create();

        Customer::factory(50)->create();

        Order::factory(2)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
