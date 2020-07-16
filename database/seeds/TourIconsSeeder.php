<?php

use Illuminate\Database\Seeder;
use App\TourIcon;

class TourIconsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 400; $i++) {
	        TourIcon::create([
                'tour_id' => rand(1,50),
                'icon_id' => rand(1,12)
	        ]);
        }
    }
}
