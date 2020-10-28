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
        App\User::create(
            [
                'name' => 'Bernardino Vilalgra B.',
                'email' => 'test@email.com',
                'password' => bcrypt('laravel'),
            ]
        );
        factory(App\Post::class, 18)->create();
    }
}
