<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('authors')->insert([
            [
                'id' => 1,
                'name' => 'J.K. Rowling',
                'photo' => 'jk_rowling.jpg',
                'bio' => 'British author, best known for the Harry Potter series',
            ],
            [
                'id' => 2,
                'name' => 'George R.R. Martin',
                'photo' => 'george_rr_martin.jpg',
                'bio' => 'American novelist and short story writer, known for A Song Of Ice And Fire books.',
            ],
            [
                'id' => 3,
                'name' => 'Isaac Asimov',
                'photo' => 'isaac_asimov.jpg',
                'bio' => 'American author and professor of biochemistry, known for his works in science fiction.',
            ],
            [
                'id' => 4,
                'name' => 'Frank Herbert',
                'photo' => 'frank_herbert.jpg',
                'bio' => 'American author, best known as the writer of the influential science fiction book series DUNE',
            ],
            [
                'id' => 5,
                'name' => 'J.R.R. Tolkien',
                'photo' => 'jrr_tolkien.jpg',
                'bio' => 'English writer, poet, and philologist, best known as the author of The Lord of the Rings and The Hobbit.',
            ],
            [
                'id' => 6,
                'name' => 'George Orwell',
                'photo' => 'george_orwell.jpg',
                'bio' => 'English novelist and essayist, known for his novels 1984 and Animal Farm.',
            ],
            [
                'id' => 7,
                'name' => 'Douglas Adams',
                'photo' => 'douglas_adams.jpg',
                'bio' => 'English author and humorist, best known for The Hitchhikers Guide to the Galaxy.',
            ],
            [
                'id' => 8,
                'name' => 'Arthur C. Clarke',
                'photo' => 'arthur_c_clarke.jpg',
                'bio' => 'British science fiction writer, futurist, and inventor, known for 2001: A Space Odyssey.',
            ],
        ]);
    }
}
