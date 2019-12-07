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
        \App\User::create(array(
            'name'     => 'admin',
            'email'    => 'admin@email.com',
            'password' => Hash::make('hunter2'),
            'is_admin' => true,
        ));
        \App\User::create(array(
            'name'     => 'scott',
            'email'    => 'scott@email.com',
            'password' => Hash::make('tiger'),
            'is_admin' => false,
        ));
    }
}
