<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function rent(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer|exists:books,id',
        ]);
        $book = Book::findOrFail($request->book_id);

        if ($book->copies_available < 1) {
            return response()->json(['message' => 'No copies available'],400);
        }

        $rental = Rental::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'rental_date' => now(),
        ]);

        $book->decrement('copies_available');

        return $rental;
    }

    public function returnBook(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);
        $rental->update(['return_date' => now()]);

        $book = Book::findOrFail($request->book_id);
        $book->increment('copies_available');

        return $rental;
    }
}
