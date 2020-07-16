<?php

use Illuminate\Database\Seeder;
use App\CommentPlus;

class CommentPlusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommentPlus::insert([
            ['name' => 'location',  'position' => true, 'public' => true,   'language_id' => 1],
            ['name' => 'warmth',  'position' => true, 'public' => true,   'language_id' => 1],
            ['name' => 'cleanliness',  'position' => true, 'public' => true,   'language_id' => 1],

            ['name' => 'Noisy',  'position' => false, 'public' => true,   'language_id' => 1],
            ['name' => 'expensive',  'position' => false, 'public' => true,   'language_id' => 1]
        ]);
    }
}
