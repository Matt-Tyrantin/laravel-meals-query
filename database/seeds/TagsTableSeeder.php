<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Illuminate\Support\Facades\Config;

class TagsTableSeeder extends Seeder
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

        for( $i = 0; $i < Config::get('seeder.tags'); $i++ ){
            $tag = new Tag();
            $tag->save();

            foreach (Config::get('seeder.languages') as $locale) {
                $tag->translateOrNew($locale)->title = $faker->unique()->fruitName();
            }

            $tag->slug = 'tag-' .$tag->id;
            $tag->save();
        }
    }
}
