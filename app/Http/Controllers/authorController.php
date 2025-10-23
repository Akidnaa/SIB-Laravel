<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class AuthorController extends Controller
{
    // GET /authors
    public function index()
    {
        $authors = Author::all();
        
        if ($authors->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource Data Not Found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get All Resource",
            "data" => $authors
        ], 200);
    }

    public function store(Request $request)
    {
        // 1. Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Cek validator error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. Upload image
        $path = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $path = $photo->store('authors', 'public');
        }

        // 4. insert data
        $author = Author::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'photo' => $path,
        ]);

        // 5. response
        return response()->json([
            'success' => true,
            'message' => 'Author Created',
            'data' => $author
        ], 201);
    }

    public function show(string $id) {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data' => $author
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        // 1. Cari data author
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found!'
            ], 404);
        }

        // 2. Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // 3. Siapkan data yang ingin diupdate
        $data = [
            'name' => $request->name,
            'bio' => $request->bio,
        ];

        // 4. Handle upload photo baru (hapus yang lama jika ada)
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $path = $photo->store('authors', 'public');

            // Hapus foto lama dari storage jika ada
            if ($author->photo) {
                Storage::disk('public')->delete($author->photo);
            }

            $data['photo'] = $path;
        }

        // 5. Update data ke database
        $author->update($data);

        // 6. Response sukses
        return response()->json([
            'success' => true,
            'message' => 'Author updated successfully!',
            'data' => $author
        ], 200);
    }

    public function destroy(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Resource Not Found'
            ], 404);
        }

        $author->delete();

        return response()->json([
            'success' => true,
            'message' => 'Author deleted successfully'
        ], 200);
    }

}
