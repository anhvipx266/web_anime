<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Movie::truncate();
        Movie::create([
            'title' => 'Infinity War',
            'series_id' => 1,
            'author_id' => 1,
            'country_id' => 1,
            'description' => 'Trận chiến vô cực',
            'thumbnail' => 'https://tse2.mm.bing.net/th?id=OIP.KVq5xL0n1QO0B2Is3wnFjAHaDs&pid=Api&P=0&w=300&h=300',
            'release_date' => '2023-12-11',
            'vote_count' => 1000000,
            'like_count' => 1000000,
            'view_count' => 1000000
        ]);
    }
}
