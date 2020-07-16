<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::insert([
            ['text' => 'Our stay was pleasant and joyful. We stayed in an apartment meant for 3 adults. First and foremost, close proximity to tube station was the reason of choosing this hotel. The cleaning services were fantastic. The support services were prompt...',
                'country' => 'London', 'public' => true,   'rating' => 5, 'tour_id' => 2, 'user_id' => 1],
            ['text' => 'Our stay was pleasant and welcoming. We stayed in an apartment meant for 3 adults with kitchen facilities. The cleaning services were superp. We liked the laundry and kitchen cleaning services on top of the regular cleaning services. The support services were prompt...much needed extra bowls were delivered in a jiffy. Front desk were very cotdial and helpful though working under at times. Needed travel arrangements and info were delivered with smiles. Delivering luggeges to the room was done witbout request.. Computer and printing service in the lobby was really helpful...tbe charge reasonable', 
                'country' => 'London', 'public' => true,   'rating' => 6, 'tour_id' => 2, 'user_id' => 1],
                ['text' => 'Our stay was pleasant and joyful. We stayed in an apartment meant for 3 adults. First and foremost, close proximity to tube station was the reason of choosing this hotel. The cleaning services were fantastic. The support services were prompt...',
                'country' => 'London', 'public' => true,   'rating' => 7, 'tour_id' => 2, 'user_id' => 1],
            ['text' => 'Our stay was pleasant and welcoming. We stayed in an apartment meant for 3 adults with kitchen facilities. The cleaning services were superp. We liked the laundry and kitchen cleaning services on top of the regular cleaning services. The support services were prompt...much needed extra bowls were delivered in a jiffy. Front desk were very cotdial and helpful though working under at times. Needed travel arrangements and info were delivered with smiles. Delivering luggeges to the room was done witbout request.. Computer and printing service in the lobby was really helpful...tbe charge reasonable', 
                'country' => 'London', 'public' => true,   'rating' => 8, 'tour_id' => 2, 'user_id' => 1]
 
        ]);
    }
}
