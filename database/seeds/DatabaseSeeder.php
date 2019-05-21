<?php

use App\Ingredient;
use App\Meal;
use App\Tag;
use Faker\Factory;
use FakerRestaurant\Provider\en_US\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LanguageTableSeeder::class,
            CategoriesTableSeeder::class ,
            IngredientsTableSeeder::class,
            TagsTableSeeder::class,
            MealsTableSeeder::class
        ]);
    }
}
