<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(PermissionRolesSeeder::class);
        $this->call(RolesUsersSeeder::class);

        $this->call(LanguagesSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(SpeciesSeeder::class);

        $this->call(ToursSeeder::class);
        $this->call(PlusSeeder::class);
        $this->call(IconsSeeder::class);
        $this->call(TourIconsSeeder::class);
        $this->call(ServicesSeeder::class);
        $this->call(TourServicesSeeder::class);
        $this->call(ImagesSeeder::class);
        $this->call(EventsSeeder::class);

        $this->call(CommentPlusesSeeder::class);
        $this->call(CommentsSeeder::class);
        $this->call(ComsComtPlusesSeeder::class);
        $this->call(SubscriptionsSeeder::class);
        $this->call(CurrenciesSeeder::class);
        
   
        
    }
}
