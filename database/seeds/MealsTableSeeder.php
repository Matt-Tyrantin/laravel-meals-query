<?php

require_once('vendor/fzaninotto/faker/src/autoload.php');

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Seeder;
use App\Meal;
use App\Ingredient;
use App\Tag;

class MealsTableSeeder extends Seeder
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

        for( $i = 0; $i < Config::get('seeder.meals'); $i++ ){
            $meal = new Meal();
            $meal->category_id = $faker->optional(0.8)->numberBetween(1, 5);
            $meal->status = 'created';
            $meal->save();

            foreach (Config::get('seeder.languages') as $locale) {
                $meal->translateOrNew($locale)->title = $faker->foodName();
                $meal->translateOrNew($locale)->description = $faker->sentence(rand(4,10));
            }

            $meal->tags()->attach(Tag::all()->random(rand(1,3)));
            $meal->ingredients()->attach(Ingredient::all()->random(rand(1,3)));

            $meal->save();
        }
    }
}
