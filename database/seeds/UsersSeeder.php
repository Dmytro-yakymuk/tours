<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['name' => 'Dmytro',    'email' => 'admin@gmail.com',   'password' => '$2y$10$0N8N3c/cyrhWGeSvKhgFr.InFpHWjAnlJrpteUt40rGQauHQnqYuq', 'remember_token' => 'dcsfk7Q0cxtE3Eo1edbM30wZP7Ehiyvrn9NBbk9DZH4iUSzWFZqzXVm6fUeK'],
            ['name' => 'Roma',      'email' => 'roma@gmail.com',    'password' => '$2y$10$.svg3GPNjqD5LOmE2cl4Ruy5lvs0dZ22mewGMnZSPg29ua/XefD92', 'remember_token' => 'aR3TrSfTlLG6x2QNa69QFK7Q4QOxH00ZPvyigKLho2bdnmNN2CrjRzAFSTth'],
            ['name' => 'Vova',      'email' => 'vova@gmail.com',    'password' => '$2y$10$.CLbQhXAzovDw2C122.vcO7nEcgoMO79sfmlb/VRn0jjqHzuKnAyW', 'remember_token' => 'CFW5F8v55PwWisLyXqSIJBwU82JxRn9WTliATBYvw6pgo9m8WLwUOtQ2oHm5'],
        ]);
    }
}
