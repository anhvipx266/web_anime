<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Staff::truncate();
        Staff::create([
            'name' => 'odin',
            'staff_roles' => 1,
            'email' => 'anhvipx266@gmail.com',
            'password'=> Hash::make('odin266&A'),
            'phone' => '0814710419',
            'address' => 'Hà Nội',
            'gender' => 1,
            'status' => 1,
            'avatar' => 'storage/imgs/images/default.jpg'
        ]);
    }
}
