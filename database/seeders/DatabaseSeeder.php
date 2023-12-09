<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Advertisement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdvertisementSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(SeriesSeeder::class);
        $this->call(StaffRoleSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(MovieGenreSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(EpisodeSeeder::class);
        $this->call(LikeSeeder::class);
        $this->call(VoteSeeder::class);
    }
}
