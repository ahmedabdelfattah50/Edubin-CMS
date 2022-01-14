<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Main Admin',
            'email' => 'main.admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);
    }
}
