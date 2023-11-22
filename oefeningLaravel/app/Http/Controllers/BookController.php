<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\BookGenre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Book;
use Faker;

//require_once 'vendor/autoload.php';

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get the books and their genres
        return Book::with('genre')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        // name author and genre are required
        // Create the book
        $validated = $request->validated();

        $book = Book::create([
            'name' => $validated['name'],
            'author_id' => $validated['author_id']
        ]);

        // Attach genres to the book
        $book->genre()->attach($validated['genre_ids']);
        $book->load('genre');


        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Book::find($id)->load('genre');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();

        $book = Book::find($id);
        $book->update([
            'name' => $validated['name'],
            'author_id' => $validated['author_id'],
        ]);

        $book->genre()->sync($validated['genre_ids']);

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Book::destroy($id);
    }
}
