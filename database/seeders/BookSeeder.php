<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('books')->insert([
            ['title' => 'Harry Potter and the Sorcerer\'s Stone', 'description' => 'First book of Harry Potter.', 'price' => 25000, 'stock' => 50, 'cover_photo' => 'harry_potter.jpg', 'author_id' => 1, 'genre_id' => 1],
            ['title' => 'A Game of Thrones', 'description' => 'Book one of A Song of Ice and Fire.', 'price' => 40000, 'stock' => 30, 'cover_photo' => 'game_of_thrones.jpg', 'author_id' => 2,'genre_id' => 4],
            ['title' => 'The Lord of the Rings', 'description' => 'Epic fantasy novel.', 'price' => 60000, 'stock' => 20, 'cover_photo' => 'lord_of_the_rings.jpg', 'author_id' => 4, 'genre_id' => 4],
            ['title' => 'Foundation', 'description' => 'Classic sci-fi novel.', 'price' => 35000, 'stock' => 25, 'cover_photo' => 'foundation.jpg', 'author_id' => 4, 'genre_id' => 3],
            ['title' => 'Dune', 'description' => 'Sci-fi masterpiece.', 'price' => 50000, 'stock' => 40, 'cover_photo' => 'dune.jpg', 'author_id' => 5, 'genre_id' => 3],
        ]);
    }
}
