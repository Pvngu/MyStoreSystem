<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(3)->create();

        User::create([
            'first_name' => 'Omar',
            'last_name' => 'Sanchez',
            'username'=> 'Pvngu',
            'email' => 'omar151102@hotmail.com',
            'password' => Hash::make('contrasena')
        ]);

        $categoriesData = [
            ['name' => 'None', 'description' => '', 'image' => ''],
            ['name' => 'Utensils', 'description' => 'a', 'image' => ''],
            ['name' => 'Electronic', 'description' => 'b', 'image' => ''],
            ['name' => 'Game systems', 'description' => 'c', 'image' => ''],
            ['name' => 'Videogames', 'description' => 'd', 'image' => ''],
            ['name' => 'Desktop computers', 'description' => 'e', 'image' => ''],
        ];
        
        Category::insert($categoriesData);

        Item::factory(20)->create();

        $this->call(AddressSeeder::class);

        Customer::factory(60)->create();

        Order::factory(3)->create();

        Role::create(['name' => 'admin']);
        User::find(1)->assignRole('admin');
    }
}
