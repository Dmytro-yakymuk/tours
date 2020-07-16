<?php

use Illuminate\Database\Seeder;
use App\RolesUsers;

class RolesUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 3; $i++) {
	        RolesUsers::create([
                'user_id' => $i,
                'role_id' => $i
	        ]);
        }
    }
}
