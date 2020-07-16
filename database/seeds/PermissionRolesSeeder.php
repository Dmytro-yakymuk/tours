<?php

use Illuminate\Database\Seeder;
use App\PermissionRoles;

class PermissionRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 10; $i++) {
	        PermissionRoles::create([
                'role_id' => 1,
                'permission_id' => $i
	        ]);
        }
    }
}
