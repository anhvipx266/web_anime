<?php

namespace Database\Seeders;

use App\Models\StaffRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // StaffRole::truncate();
        StaffRole::create(['role' => 'Admin']);
        StaffRole::create(['role' => 'Nhân viên']);
    }
}
