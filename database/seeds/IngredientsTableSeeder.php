<?php

use Illuminate\Database\Seeder;
use App\Ingredient;
use Illuminate\Support\Facades\Config;

class IngredientsTableSeeder extends Seeder
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

        for( $i = 0; $i < Config::get('seeder.ingredients'); $i++ ){
            $ingredient = new Ingredient();
            $ingredient->save();

            foreach (Config::get('seeder.languages') as $locale) {
                $ingredient->translateOrNew($locale)->title = $faker->unique()->vegetableName();
            }

            $ingredient->slug = 'sastojak-' .$ingredient->id;
            $ingredient->save();
        }
    }
}
