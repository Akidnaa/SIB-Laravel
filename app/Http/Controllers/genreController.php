<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        return response()->json([
            "success" => true,
            "message" => "Get All Resource",
            "data" => $genres
        ], 200);
    }
}
