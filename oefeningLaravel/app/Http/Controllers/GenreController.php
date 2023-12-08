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
     *     operationId="indexGenres",
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
     *     operationId="storeGenres",
     *     @OA\Response(
     *     response=200,
     *     description="Success: A genre has been created",
     *     ),
     *     security={{"bearerAuth": {}}},
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
     * @OA\Get(
     *     path="/genres/{genre_id}",
     *     tags={"Genres"},
     *     summary="Get a genre",
     *     description="Get a genre",
     *     operationId="showGenres",
     *     @OA\Parameter(
     *     name="genre_id",
     *     in="path",
     *     description="Id of genre that needs to be fetched",
     *     required=true,
     *     @OA\Schema(
     *     type="integer",
     *     format="int64",
     *     example=1
     *     )
     *    ),
     *     @OA\Response(
     *     response=200,
     *     description="Success: A genre has been fetched",
     *     ),
     *     @OA\RequestBody(
     *     description="Genre",
     *     required=false,
     *    )
     * )
     */
    public function show(Genre $genre)
    {
        return $genre;
    }

    /**
     * @OA\Put(
     *     path="/genres/{genre_id}",
     *     tags={"Genres"},
     *     summary="Update a genre",
     *     description="Update a genre, this can only be done by an authenticated user.",
     *     operationId="updateGenres",
     *     @OA\Parameter(
     *     name="genre_id",
     *     in="path",
     *     description="Id of genre that needs to be updated",
     *     required=true,
     *     @OA\Schema(
     *     type="integer",
     *     format="int64",
     *     example=1
     *     )
     *    ),
     *     @OA\Response(
     *     response=200,
     *     description="Success: A genre has been updated",
     *     ),
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *     description="Genre",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Genre"),
     *     ),
     *   )
     * )
     */
    public function update(StoreGenreRequest $request, Genre $genre)
    {
        $this->authorize('update', $genre);

        $validated = $request->validated();

        $genre->update($validated);

        return Genre::all();
    }


    /**
     * @OA\Delete(
     *     path="/genres/{genre_id}",
     *     tags={"Genres"},
     *     summary="Delete a genre",
     *     description="Delete a genre, this can only be done by an authenticated user.",
     *     operationId="destroyGenres",
     *     @OA\Parameter(
     *     name="genre_id",
     *     in="path",
     *     description="Id of genre that needs to be deleted",
     *     required=true,
     *     @OA\Schema(
     *     type="integer",
     *     format="int64",
     *     example=1
     *     )
     *    ),
     *     @OA\Response(
     *     response=200,
     *     description="Success: A genre has been deleted",
     *     ),
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *     description="Genre",
     *     required=false,
     *    )
     * )
     */
    public function destroy(Genre $genre)
    {
        return Genre::destroy($genre->id);
    }
}
