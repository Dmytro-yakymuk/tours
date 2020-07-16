<?php

use Illuminate\Database\Seeder;
use App\Subscription;

class SubscriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        Subscription::insert([
            ['email' => 'admin@gmail.com',   'public' => true ],
            ['email' => 'roma@gmail.com',    'public' => true ],
            ['email' => 'vova@gmail.com',    'public' => true ]
        ]);
        
    }
}
