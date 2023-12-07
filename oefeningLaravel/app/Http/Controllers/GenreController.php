<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * @OA\Get (
     *     path="/genres",
     *     tags={"Genres"},
     *     summary="Get all genres",
     *     description="Get all genres",
     *     operationId="index",
     *     @OA\Response(
     *     response=200,
     *     description="Success: All genres",
     *     ),
     *     @OA\RequestBody(
     *     description="Genres",
     *     required=false,
     *    )
     * )
     */
    public function index()
    {
        return Genre::all();
    }

    /**
     * @OA\Post(
     *     path="/genres",
     *     tags={"Genres"},
     *     summary="Store a genre",
     *     description="Store a genre, this can only be done by an authenticated user.",
     *     operationId="store",
     *     @OA\Response(
     *     response=200,
     *     description="Success: A genre has been stored",
     *     ),
     *     security={
     *     {"genre_auth": {}}
     *     },
     *     @OA\RequestBody(
     *     description="Genre",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Genre"),
     *     ),
     *   )
     * )
     */
    public function store(StoreGenreRequest $request)
    {
        $validated = $request->validated();
        Genre::create($validated);

        return Genre::all();
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return $genre;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGenreRequest $request, Genre $genre)
    {
        $this->authorize('update', $genre);

        $validated = $request->validated();

        $genre->update($validated);

        return Genre::all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        return Genre::destroy($genre->id);
    }
}
