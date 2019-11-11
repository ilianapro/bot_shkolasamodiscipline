<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(GroupsSeeder::class);
        $this->call(ParticipantsSeeder::class);
        $this->call(MotivatorsTableSeeder::class);
    }
}
