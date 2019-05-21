<?php

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
            MealsTableSeeder::class,
            CategoriesTableSeeder::class,
            //IngredientsTableSeeder::class,
            //TagsTableSeeder::class
        ]);

        DB::update('update categories set slug = CONCAT("category-", id)');
        DB::update('update ingredients set slug = CONCAT("sastojak-", id)');
        DB::update('update tags set "slug" = CONCAT("tag-", id)');
    }
}
