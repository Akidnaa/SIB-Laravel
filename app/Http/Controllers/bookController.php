<?php

namespace App\Http\Controllers;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return response()->json([
            "success" => true,
            "message" => "Get All Resource",
            "data" => $books
        ], 200);
    }
}
