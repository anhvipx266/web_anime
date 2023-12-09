<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\MovieGenre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MovieGenre::truncate();
        MovieGenre::create([
            'movie_id' => 1,
            'genre_id' => 1
        ]);
    }
}
