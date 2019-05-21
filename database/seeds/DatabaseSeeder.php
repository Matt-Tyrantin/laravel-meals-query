<?php

use Illuminate\Database\Seeder;

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
            MealsTableSeeder::class,
            CategoriesTableSeeder::class,
            //IngredientsTableSeeder::class,
            //TagsTableSeeder::class
        ]);
    }
}
