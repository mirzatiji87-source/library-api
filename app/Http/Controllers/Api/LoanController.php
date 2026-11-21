<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class LoanController extends Controller
{
    public function index(Request $r)
    {
        $user = $r->user();
        $loans = $user->loans()->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil riwayat pinjaman',
            'data' => $loans
        ]);
    }
    public function store(Request $r,)
    {
        $user = $r->user();
        $validated = $r->validate([
            'book_id' => 'required|integer|exists:books,id',
        ]);

        $book = Book::findOrFail($validated['book_id']);
        $sedangDipinjam = $book->loans()
            ->whereNull('returned_at')
            ->exists();

        if ($sedangDipinjam) {
            return response()->json([
                'success' => false,
                'message' => 'buku sedang di pinjam nih'
            ], 409);
        }
        $loan = $user->loans()->create([
            'book_id' => $validated['book_id'],
            'borrowed_at' => now(),
            'returned_at' => null
        ]);
        return response()->json([
            'success' => true,
            'message' => 'buku di temukan',
            'data' => $loan
        ], 201);
    }
    public function returnBook(Request $r, $id)
    {
        $user = $r->user();
        $loan = $user->loans()->findOrFail($id);

        if ($loan->returned_at !== null) {
            return response()->json([
                'success' => false,
                'message' => 'buku sudah di kembalikan'
            ], 409);
        }
        $loan->returned_at = now();
        $loan->save();

        return response()->json([
            'success' => true,
            'message' => 'buku berhasil di kembalikan',
            'data' => $loan
        ], 200);
    }
}
