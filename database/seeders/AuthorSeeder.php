<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Author::truncate();
        $authorNames = [
            'Stephen King',
            'J.K. Rowling',
            'George R.R. Martin',
            'Quentin Tarantino',
            'Christopher Nolan',
            // Thêm các tên khác nếu cần
        ];

        // Thêm dữ liệu giả mạo
        foreach ($authorNames as $authorName) {
            Author::create(['name' => $authorName]);
        }
    }
}
