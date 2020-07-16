<?php

use Illuminate\Database\Seeder;
use App\Region;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::insert([
            ['name' => 'Волинь',    'slug' => 'volun',  'image' => 'img_1.jpg',   'public' => 1,    'language_id' => 1,  'country_id' => 1 ],
            ['name' => 'Volun',     'slug' => 'volun',  'image' => 'img_1.jpg',   'public' => 1,    'language_id' => 3,  'country_id' => 2 ],
            ['name' => 'Київ',      'slug' => 'kiev',   'image' => 'img_2.jpg',   'public' => 1,    'language_id' => 1,  'country_id' => 1 ],
            ['name' => 'Kiev',      'slug' => 'kiev',   'image' => 'img_2.jpg',   'public' => 1,    'language_id' => 3,  'country_id' => 2 ],
            ['name' => 'Варшава',   'slug' => 'warsaw', 'image' => 'img_3.jpg',   'public' => 1,    'language_id' => 1,  'country_id' => 5 ],
            ['name' => 'Warsaw',    'slug' => 'warsaw', 'image' => 'img_3.jpg',   'public' => 1,    'language_id' => 3,  'country_id' => 6 ]
        ]);
    }
}
