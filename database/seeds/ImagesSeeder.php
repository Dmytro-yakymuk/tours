<?php

use Illuminate\Database\Seeder;
use App\Image;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 400; $i++) {
	        Image::create([
                'name' => 'img_'.rand(1,6).'.jpg',
                'tour_id' => rand(1,49)
	        ]);
        }
    }
}
