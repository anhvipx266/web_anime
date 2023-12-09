<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advertisement::truncate();
        Advertisement::create([
            'title'=>'Marvel Film',
            'image_url' => 'storage/imgs/images/default.jpg',
            'target_url'=> 'https://www.marvel.com/movies',
        ]);

    }
}
