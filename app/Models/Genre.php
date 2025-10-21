<?php

namespace App\Models;

class Genre
{
    public static function all()
    {
        return [
            ['id' => 1, 'name' => 'Fiction', 'description' => 'A literary work based on imagination.'],
            ['id' => 2, 'name' => 'Non-Fiction', 'description' => 'Based on facts and real events.'],
            ['id' => 3, 'name' => 'Science Fiction', 'description' => 'Explores futuristic science and technology.'],
            ['id' => 4, 'name' => 'Epic Fantasy', 'description' => 'Features magic, worlds, and heroic quests.'],
            ['id' => 5, 'name' => 'Detective', 'description' => 'Centers around solving crimes and mysteries.'],
        ];
    }
}
