<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Country::truncate();
        // Danh sách tên quốc gia
        $countryNames = [
            'Vietnam',
            'United States',
            'United Kingdom',
            'Canada',
            'Australia',
            // Thêm các tên khác nếu cần
        ];

        // Thêm dữ liệu giả mạo
        foreach ($countryNames as $countryName) {
            Country::create(['name' => $countryName]);
        }
    }
}
