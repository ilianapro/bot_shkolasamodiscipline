<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
        [
            'name' => env('ADMIN1_NAME'),
            'email' => env('ADMIN1_EMAIL'),
            'password' => bcrypt(env('ADMIN1_PASSWORD')),
        ],
        [
            'name' => env('ADMIN2_NAME'),
            'email' => env('ADMIN2_EMAIL'),
            'password' => bcrypt(env('ADMIN2_PASSWORD')),
        ]
    );

            
    }
}
