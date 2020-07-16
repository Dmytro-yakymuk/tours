<?php

use Illuminate\Database\Seeder;
use App\Icon;

class IconsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Icon::insert([
            ['icon' => 'icon-service-9.png',    'text' => 'Безкоштовний Wi-Fi',         'room' => 1, 'public' => 1, 'language_id' => 1],
            ['icon' => 'icon-service-9.png',    'text' => 'Free Wi-Fi in all rooms',    'room' => 1, 'public' => 1, 'language_id' => 3],
            ['icon' => 'icon-service-10.png',   'text' => 'Місця для куріння',          'room' => 0, 'public' => 1, 'language_id' => 1],
            ['icon' => 'icon-service-10.png',   'text' => 'Smoking area',               'room' => 0, 'public' => 1, 'language_id' => 3],
            ['icon' => 'icon-service-11.png',   'text' => 'Пральня',                    'room' => 0, 'public' => 1, 'language_id' => 1],
            ['icon' => 'icon-service-11.png',   'text' => 'Laundry service',            'room' => 0, 'public' => 1, 'language_id' => 3],
            ['icon' => 'icon-service-12.png',   'text' => 'Бізнес центер',              'room' => 0, 'public' => 1, 'language_id' => 1],
            ['icon' => 'icon-service-12.png',   'text' => 'Business center',            'room' => 0, 'public' => 1, 'language_id' => 3],
            ['icon' => 'icon-service-8.png',    'text' => 'Айропорт',                   'room' => 1, 'public' => 1, 'language_id' => 1],
            ['icon' => 'icon-service-8.png',    'text' => 'Airport transfer',           'room' => 1, 'public' => 1, 'language_id' => 3],
            ['icon' => 'icon-service-7.png',    'text' => 'Басейн',                     'room' => 1, 'public' => 1, 'language_id' => 1],
            ['icon' => 'icon-service-7.png',    'text' => 'Swimming pool',              'room' => 1, 'public' => 1, 'language_id' => 3],

        ]);
    }
}
