<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        User::create([
            'name' => 'odin',
            'user_role' => 1,
            'email' => 'anhvipx266@gmail.com',
            'password'=> Hash::make('odin266&A'),
            'gender' => 1,
            'avatar' => 'storage/imgs/images/default.jpg'
        ]);
    }
}
