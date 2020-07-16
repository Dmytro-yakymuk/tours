<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	['name'=>'Demo Event-1', 'email'=>'test@gmail.com', 'phone'=>'0953417774', 'start_date'=>'2019-02-11', 'end_date'=>'2019-02-12', 'tour_id'=> 1, 'message'=>'Message text', 'public'=>true, 'color'=>'red', 'icon'=>''],
        	['name'=>'Demo Event-2', 'email'=>'test@gmail.com', 'phone'=>'0953417774', 'start_date'=>'2019-02-11', 'end_date'=>'2019-02-13', 'tour_id'=> 1, 'message'=>'Message text', 'public'=>true, 'color'=>'red', 'icon'=>''],
        	['name'=>'Demo Event-3', 'email'=>'test@gmail.com', 'phone'=>'0953417774', 'start_date'=>'2019-02-14', 'end_date'=>'2019-02-14', 'tour_id'=> 1, 'message'=>'Message text', 'public'=>true, 'color'=>'red', 'icon'=>''],
        	['name'=>'Demo Event-4', 'email'=>'test@gmail.com', 'phone'=>'0953417774', 'start_date'=>'2019-02-17', 'end_date'=>'2019-02-17', 'tour_id'=> 1, 'message'=>'Message text', 'public'=>true, 'color'=>'red', 'icon'=>''],
        ];
        foreach ($data as $key => $value) {
        	Event::create($value);
        }

    }
}
