<?php

use Illuminate\Database\Seeder;
use App\ComsComtPlus;

class ComsComtPlusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=1; $i <= 40; $i++) {
	        ComsComtPlus::create([
                'comment_id' => rand(1,4),
                'comment_plus_id' => rand(1,5)
	        ]);
        }
    }
}
