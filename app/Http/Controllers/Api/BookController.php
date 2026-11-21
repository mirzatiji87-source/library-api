<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return response()->json([
            'success' => true,
            'message' => 'Berikut adalah Data Buku',
            'data' => $books
        ]);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'buku tidak di temukan cui',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'buku di temukan',
            'data' => $book
        ], 200);
    }

    public function store(Request $r)
    {
        $validated = $r->validate([
            'title' => 'required|string|max:255',
            'slug' => 'sometimes|string|max:255|unique:books,slug',
            'description' => 'sometimes|nullable|string|max:200',
        ]);

        $validated['created_by'] = $r->user()->id;

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $books = Book::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data buku berhasil di tambahkan',
            'data' => $books
        ], 201);
    }

    public function update(Request $r, $id)
    {
        $books = Book::find($id);

        if (!$books) {
            return response()->json([
                'success' => false,
                'message' => 'data buku tidak di temukan',
                'data' => null
            ], 404);
        }
        $validated = $r->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|nullable|string|max:255|unique:books,slug,' . $id,
            'description' => 'sometimes|nullable|string|max:200'
        ]);
        $books->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'data buku berhasil di perbarui ',
            'data' => $books
        ], 200);
    }

    public function destroy($id)
    {
        $books = Book::find($id);

        if (!$books) {
            return response()->json([
                'success' => false,
                'message' => 'data buku tidak di temukan',
                'data' => null
            ], 404);
        }

        $books->delete();

        return response()->json([
            'success' => true,
            'message' => 'data buku berhasil di hapus',
            'data' => null
        ], 200);
    }
}
