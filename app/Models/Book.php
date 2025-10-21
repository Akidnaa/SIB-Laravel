<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'stock', 'cover_photo', 'author_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
