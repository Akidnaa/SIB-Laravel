<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('authors')->insert([
            ['name' => 'J.K. Rowling', 'photo' => 'jk_rowling.jpg', 'bio' => 'Author of Harry Potter series.'],
            ['name' => 'George R.R. Martin', 'photo' => 'george_rr_martin.jpg', 'bio' => 'Author of A Song of Ice and Fire.'],
            ['name' => 'J.R.R. Tolkien', 'photo' => 'jrr_tolkien.jpg', 'bio' => 'Author of The Lord of the Rings.'],
            ['name' => 'Isaac Asimov', 'photo' => 'isaac_asimov.jpg', 'bio' => 'Science fiction writer.'],
            ['name' => 'Frank Herbert', 'photo' => 'frank_herbert.jpg', 'bio' => 'Author of Dune series.'],
        ]);
    }
}
