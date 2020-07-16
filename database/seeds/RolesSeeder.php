<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'super_admin',   'title' => 'Супер Адмін'],
            ['name' => 'admin',         'title' => 'Адмін'],
            ['name' => 'moderator',     'title' => 'Редактор'],
        ]);
    }
}
