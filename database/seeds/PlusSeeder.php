<?php

use Illuminate\Database\Seeder;
use App\Plus;

class PlusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 49; $i++) {
            Plus::create([
                'text' => 'Полювання в СНГ для кожного - '.$i,
                'room' => 0,
                'public' => 1,
                'language_id' => rand(1,3),
                'tour_id' => $i
	        ]);
        }

        for ($i=1; $i <= 49; $i++) {
            Plus::create([
                'text' => 'Приїжайте, в нас найкраще!!!',
                'room' => $i,
                'public' => 1,
                'language_id' => rand(1,3),
                'tour_id' => $i
	        ]);
        }
    }
}
