<?php

use FakerRestaurant\Provider\en_US\Restaurant;
use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Facades\Config;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new FakerRestaurant\Provider\en_US\Restaurant($faker));

        for( $i = 0; $i < Config::get('seeder.categories'); $i++ ){
            $category = new Category();
            $category->save();

            foreach (Config::get('seeder.languages') as $locale) {
                $category->translateOrNew($locale)->title = $faker->unique()->beverageName();
            }

            $category->slug = 'category-' .$category->id;
            $category->save();
        }
    }
}
