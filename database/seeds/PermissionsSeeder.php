<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([

            ['name' => 'VIEW_ADMIN',        'title' => 'Перегляд адмін панелі'],

            ['name' => 'VIEW_TOUR',         'title' => 'Перегляд туру'],
            ['name' => 'CREATE_TOUR',          'title' => 'Добавлення туру'],
            ['name' => 'UPDATE_TOUR',       'title' => 'Редагування туру'],
            ['name' => 'DELETE_TOUR',       'title' => 'Видалення туру'],

            ['name' => 'VIEW_PERMISSIONS',      'title' => 'Перегляд прав'],
            ['name' => 'CREATE_PERMISSIONS',       'title' => 'Добавлення прав'],
            ['name' => 'UPDATE_PERMISSIONS',    'title' => 'Редагування прав'],
            ['name' => 'DELETE_PERMISSIONS',    'title' => 'Видалення прав'],

            ['name' => 'VIEW_ROLE',      'title' => 'Перегляд ролів'],
            ['name' => 'CREATE_ROLE',       'title' => 'Добавлення ролів'],
            ['name' => 'UPDATE_ROLE',    'title' => 'Редагування ролів'],
            ['name' => 'DELETE_ROLE',    'title' => 'Видалення ролів'],

            ['name' => 'VIEW_SPECIE',      'title' => 'Перегляд видів турів'],
            ['name' => 'CREATE_SPECIE',       'title' => 'Добавлення видів турів'],
            ['name' => 'UPDATE_SPECIE',    'title' => 'Редагування видів турів'],
            ['name' => 'DELETE_SPECIE',    'title' => 'Видалення видів турів'],
            
        ]);
    }
}
