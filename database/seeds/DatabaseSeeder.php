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
        // $this->call(UsersTableSeeder::class);
        factory(App\Admin::class, 1)->create();
        factory(App\Vehicle::class, 5)->create();
        factory(App\User::class, 100)->create();
        factory(App\Mechanic::class, 100)->create();
        factory(App\Problem::class, 200)->create();
        factory(App\Review::class, 1000)->create();
    }
}
