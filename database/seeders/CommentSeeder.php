<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Comment::truncate();
        Comment::create([
            'user_id' => 1,
            'movie_id' => 1,
            'content' => 'Phim rất hay'
        ]);
    }
}
