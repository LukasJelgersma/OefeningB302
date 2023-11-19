<?php

namespace App\Http\Controllers;

use App\Models\BookGenre;
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
    public function store(Request $request)
    {
        // name author and genre are required
        $request->validate([
            'name' => 'required',
            'author_id' => 'required',
            'genre_ids' => 'required|array'
        ]);
        // Create the book
        $book = Book::create([
            'name' => $request->input('name'),
            'author_id' => $request->input('author_id'),
        ]);

        // Attach genres to the book
        $book->genre()->attach($request->input('genre_ids'));


        return $book->load('genre');
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
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);
        $book->update($request->all());
        return $book;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Book::destroy($id);
    }
}
