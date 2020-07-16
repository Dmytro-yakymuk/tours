<?php

use Illuminate\Database\Seeder;

use App\Currency;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::insert([
            ['name' => 'UAH'],
            ['name' => 'RUB'],
            ['name' => 'USD'],
            ['name' => 'EUR']
        ]);
    }
}
