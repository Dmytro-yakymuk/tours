<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::insert([
            ['name' => 'Українська',    'locale' => 'ua'],
            ['name' => 'Російська',     'locale' => 'ru'],
            ['name' => 'Englich',       'locale' => 'en'],
        ]);
    }
}
