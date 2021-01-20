<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'    => 'tester',
            'password'   =>  Hash::make('password'),
            'remember_token' =>  Str::random(10),
        ]);
    }
}