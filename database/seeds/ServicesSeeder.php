<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::insert([
            ['name' => 'Cпорядження',                   'addition' => '',     'position' => 1, 'public' => 1, 'language_id' => 1],
            ['name' => 'Equipment',                     'addition' => '',     'position' => 1, 'public' => 1, 'language_id' => 3],
            ['name' => 'Проживання',                    'addition' => '',     'position' => 1, 'public' => 1, 'language_id' => 1],
            ['name' => 'Residence',                     'addition' => '',     'position' => 1, 'public' => 1, 'language_id' => 3],
            ['name' => 'Транспортування',               'addition' => '',                                   'position' => 1, 'public' => 1, 'language_id' => 1],
            ['name' => 'Transportation',                'addition' => '',                                   'position' => 1, 'public' => 1, 'language_id' => 3],
            ['name' => 'Дворазове харчування',          'addition' => 'ціна за 1 людину',                   'position' => 1, 'public' => 1, 'language_id' => 1],
            ['name' => 'Two meals a day',               'addition' => 'price for 1 person',                 'position' => 1, 'public' => 1, 'language_id' => 3],
        ]);
    }
}
