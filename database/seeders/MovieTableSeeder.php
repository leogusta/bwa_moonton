<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'name' => 'The Shawshank Redemption',
                'slug' => 'the-shawshank-redemption',
                'category' => 'drama',
                'video_url' => 'https://youtu.be/PLl99DlL6b4?si=ZqG3H77GtnmtfWZG',
                'thumbnail' => 'https://esensi.tv/wp-content/uploads/2023/09/shawshank.jpeg',
                'rating' => 9.3,
                'is_featured' => true,
            ],
            [
                'name' => 'The Godfather',
                'slug' => 'the-godfather',
                'category' => 'drama',
                'video_url' => 'https://youtu.be/UaVTIH8mujA?si=UUq629QRS4-jvb65',
                'thumbnail' => 'https://play-lh.googleusercontent.com/ZucjGxDqQ-cHIN-8YA1HgZx7dFhXkfnz73SrdRPmOOHEax08sngqZMR_jMKq0sZuv5P7-T2Z2aHJ1uGQiys',
                'rating' => 9.0,
                'is_featured' => false,
            ]
        ];

        Movie::insert($movies);
    }
}
