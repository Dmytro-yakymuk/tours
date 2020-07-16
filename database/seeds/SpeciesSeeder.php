<?php

use Illuminate\Database\Seeder;
use App\Specie;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specie::insert([
            ['name' => 'Дайвінг',       'slug' => 'diving',    'public' => 1,  'icon' => '',    'language_id' => 1],
            ['name' => 'Daving',        'slug' => 'diving',    'public' => 1,  'icon' => '',    'language_id' => 3],
            ['name' => 'Риболовля',     'slug' => 'fishing',    'public' => 1,  'icon' => '',    'language_id' => 1],
            ['name' => 'Fishing',       'slug' => 'fishing',    'public' => 1,  'icon' => '',    'language_id' => 3],
            ['name' => 'Туризм',        'slug' => 'tousim',     'public' => 1,  'icon' => '',    'language_id' => 1],
            ['name' => 'Tousim',        'slug' => 'tousim',     'public' => 1,  'icon' => '',    'language_id' => 3]
        ]);
    }
}
