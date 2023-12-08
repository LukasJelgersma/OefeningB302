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
     * @OA\Get (
     *     path="/books",
     *     tags={"Books"},
     *     summary="Get all books",
     *     description="Get all books",
     *     operationId="indexBooks",
     *     @OA\Response(
     *     response=200,
     *     description="Success: All books",
     *     ),
     *     @OA\RequestBody(
     *     description="Books",
     *     required=false,
     *     @OA\JsonContent(ref="#/components/schemas/IndexBookRequest"),
     *     )
     * )
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
     * @OA\Post(
     *     path="/books",
     *     tags={"Books"},
     *     summary="Store a book",
     *     description="Store a book, this can only be done by an authenticated user.",
     *     operationId="storeBooks",
     *     @OA\Response(
     *     response=200,
     *     description="Success: A book has been created",
     *     ),
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *     description="Book",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Book"),
     *     ),
     *   )
     * )
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
     * @OA\Get(
     *     path="/books/{book}",
     *     tags={"Books"},
     *     summary="Get a book",
     *     description="Get a book",
     *     operationId="showBooks",
     *     @OA\Parameter(
     *     in="path",
     *     name="book",
     *     description="The id of the book",
     *     required=true,
     *     @OA\Schema(
     *     type="integer",
     *     format="int64",
     *     ),
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Success: A book",
     *     ),
     *   )
     * )
     */
    public function show(Book $book)
    {
        return $book->load('genre');
    }

    /**
     * @OA\Put(
     *     path="/books/{book}",
     *     tags={"Books"},
     *     summary="Update a book",
     *     description="Update a book",
     *     operationId="updateBooks",
     *     @OA\Parameter(
     *         name="book",
     *         in="path",
     *         description="The id of the book",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success: A book has been updated",
     *     ),
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         description="Book",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Book"),
     *     ),
     * )
     */

    public function update(StoreBookRequest $request,Book $book)
    {
        $validated = $request->validated();

        $book->update([
            'name' => $validated['name'],
            'author_id' => $validated['author_id'],
        ]);

        $book->genre()->sync($validated['genre_ids']);

        return Book::with('genre')->get();
    }


    /**
     * @OA\Delete(
     *     path="/books/{book}",
     *     tags={"Books"},
     *     summary="Delete a book",
     *     description="Delete a book",
     *     operationId="destroyBooks",
     *     @OA\Parameter(
     *     name="book",
     *     description="The id of the book",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *     type="integer",
     *     format="int64",
     *     ),
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Success: A book has been deleted",
     *     ),
     *     security={{"bearerAuth": {}}},
     *   )
     * )
     */
    public function destroy(Book $book)
    {
        return Book::destroy($book->id);
    }
}
