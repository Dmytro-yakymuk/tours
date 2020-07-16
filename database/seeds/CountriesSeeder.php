<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::insert([
            ['name' => 'Україна',   'slug' => 'ukraine',    'language_id' => 1],
            ['name' => 'Ukraine',   'slug' => 'ukraine',    'language_id' => 3],
            ['name' => 'Росія',     'slug' => 'russia',     'language_id' => 1],
            ['name' => 'Russia',    'slug' => 'russia',     'language_id' => 3],
            ['name' => 'Польща',    'slug' => 'poland',     'language_id' => 1],
            ['name' => 'Poland',    'slug' => 'poland',     'language_id' => 3],
        ]);
    }
}
