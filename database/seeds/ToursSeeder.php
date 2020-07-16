<?php

use Illuminate\Database\Seeder;
use App\Tour;

class ToursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 50; $i++) {
	        Tour::create([
                'title' => 'Активний відпочинок по Європі для кожного - '.$i,
                'slug' => 'diving_'.$i,
                'price' => rand(1500,5000),
                'discount' => 15,
                'price_discount' => rand(1200,4500),
                'new' => 1,
                'sold' => 0,
	            'description' => 'Активний відпочинок, рекреація (англ. Active leisure) — спосіб проведення вільного часу, різновид хобі, в процесі якого відпочивальник займається активними видами відпочинку, що потребують активної фізичної роботи організму, роботи м`язів, всього тіла.',
				'text' => 'Активний відпочинок, рекреація (англ. Active leisure) — спосіб проведення вільного часу, різновид хобі, в процесі якого відпочивальник займається активними видами відпочинку, що потребують активної фізичної роботи організму, роботи м`язів, всього тіла.',
                'image' => 'diving'.rand(1,6).'.jpg',
                'rating' => 4.8,
                'root' => 1,
                'public' => 1,
                'region_id' => rand(1,6),
                'language_id' => rand(1,3),
                'specie_id' => 1
	        ]);
        }
    }
}
