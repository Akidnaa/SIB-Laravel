<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('genres')->insert([
            [
                'name' => 'Fiction',
                'description' => 'A literary work based on imagination.'
            ],
            [
                'name' => 'Non-Fiction',
                'description' => 'Based on facts and real events.'
            ],
            [
                'name' => 'Science Fiction',
                'description' => 'Explores futuristic science and technology.'
            ],
            [
                'name' => 'Fantasy',
                'description' => 'Features magic, mythical creatures, and heroic quests.'
            ],
            [
                'name' => 'Mystery',
                'description' => 'Centers around solving crimes and uncovering secrets.'
            ],
            [
                'name' => 'Romance',
                'description' => 'Focuses on love stories and emotional relationships.'
            ],
        ]);
    }
}
