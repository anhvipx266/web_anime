<?php

namespace Database\Seeders;

use App\Models\Episode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Episode::truncate();
        Episode::create([
            'movie_id' => 1,
            'title' => 'Infinity War',
            'thumbnail' => 'https://tse2.mm.bing.net/th?id=OIP.KVq5xL0n1QO0B2Is3wnFjAHaDs&pid=Api&P=0&w=300&h=300',
        ]);
    }
}
