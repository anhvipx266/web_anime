<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Xóa dữ liệu cũ (nếu có)
        //  Genre::truncate();

         // Danh sách tên thể loại
         $genreNames = [
             'Action',
             'Adventure',
             'Comedy',
             'Drama',
             'Science Fiction',
             // Thêm các tên khác nếu cần
         ];
 
         // Thêm dữ liệu giả mạo
         foreach ($genreNames as $genreName) {
             Genre::create(['name' => $genreName]);
         }
    }
}
