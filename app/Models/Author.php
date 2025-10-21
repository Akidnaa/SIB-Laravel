<?php

namespace App\Models;

class Author
{
    public static function all()
    {
        return [
            ['id' => 1, 'name' => 'J.K. Rowling', 'photo' => 'jk_rowling.jpg', 'bio' => 'British author, best known for the Harry Potter series.'],
            ['id' => 2, 'name' => 'George R.R. Martin', 'photo' => 'george_rr_martin.jpg', 'bio' => 'American novelist, known for A Song of Ice and Fire.'],
            ['id' => 3, 'name' => 'Isaac Asimov', 'photo' => 'isaac_asimov.jpg', 'bio' => 'Science fiction writer and professor of biochemistry.'],
            ['id' => 4, 'name' => 'Frank Herbert', 'photo' => 'frank_herbert.jpg', 'bio' => 'Author of the Dune series.'],
            ['id' => 5, 'name' => 'J.R.R. Tolkien', 'photo' => 'jrr_tolkien.jpg', 'bio' => 'English writer of The Lord of the Rings and The Hobbit.'],
        ];
    }
}
