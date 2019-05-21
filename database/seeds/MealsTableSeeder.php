<?php

use Illuminate\Database\Seeder;
use App\Meal;
use App\Category;
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
        factory(Tag::class, 5)->create();
        factory(Ingredient::class, 5)->create();
        factory(Meal::class, 15)->create()->each(function($meal){
            $meal->tags()->attach(Tag::all()->random(rand(1,3)));
            $meal->ingredients()->attach(Ingredient::all()->random(rand(1,3)));
        });
    }
}
