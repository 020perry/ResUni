<?php
// database/seeders/DatabaseSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MenuItem;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Voeg categorieën toe
        for ($i = 0; $i < 5; $i++) {
            Category::create([
                'name' => $faker->word,
            ]);
        }

        // Voeg menu-items toe met willekeurige categorieën
        for ($i = 0; $i < 10; $i++) {
            $menuItem = MenuItem::create([
                'name' => $faker->word,
                'price' => $faker->randomFloat(2, 5, 50),
                'description' => $faker->sentence,
                'extra_description' => $faker->paragraph,
                'available' => $faker->boolean,
            ]);

            // Voeg willekeurige categorieën toe aan het menu-item
            $categories = Category::inRandomOrder()->limit(rand(1, 3))->get();
            $menuItem->categories()->attach($categories->pluck('id')->toArray());
        }
    }
}
