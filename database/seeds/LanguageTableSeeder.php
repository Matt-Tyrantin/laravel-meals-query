<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Config::get('seeder.languages') as $locale){
            DB::table('languages')->insert([
                'language' => $locale,
            ]);
        }
    }
}