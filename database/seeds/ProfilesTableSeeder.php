<?php

use App\Profile;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    public function run()
    {
        Profile::create([
            'user_id' => 1
        ]);
    }
}
