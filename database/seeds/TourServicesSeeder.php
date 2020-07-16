<?php

use Illuminate\Database\Seeder;
use App\TourService;

class TourServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 400; $i++) {
	        TourService::create([
                'tour_id' => rand(1,50),
                'service_id' => rand(1,8),
                'price' => rand(200,5000)
	        ]);
        }
    }
}
