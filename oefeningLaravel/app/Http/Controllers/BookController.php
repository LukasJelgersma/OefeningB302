<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexBookRequest;
use App\Http\Requests\StoreBookRequest;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use App\Models\Book;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexBookRequest $request)
    {
        $validated = $request->validated();

        $name = $validated['name'] ?? null;
        $order = $validated['order'] ?? 'asc';
        $genreIds = $validated['genre_ids'] ?? Genre::all()->pluck('id');

        return Book::with('genre')
            ->where('name', 'like', '%'.$name.'%')
            ->whereIn('id', $genreIds)
            ->orderBy('publication_year', $order)
            ->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        // name author and genre are required
        // Create the book
        $validated = $request->validated();

        $book = Book::create([
            'name' => $validated['name'],
            'author_id' => $validated['author_id'],
            'publication_year' => $validated['publication_year'],
        ]);

        // Attach genres to the book
        $book->genre()->attach($validated['genre_ids']);
        $book->load('genre');


        return Book::with('genre')->get();
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return $book->load('genre');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, string $id)
    {
        $validated = $request->validated();

        $book = Book::find($id);
        $book->update([
            'name' => $validated['name'],
            'author_id' => $validated['author_id'],
        ]);

        $book->genre()->sync($validated['genre_ids']);

        return Book::with('genre')->get();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Book::destroy($id);
    }
}
