<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{

    /**
     * @OA\Get (
     *     path="/authors",
     *     tags={"Authors"},
     *     summary="Get all authors",
     *     description="Get all authors",
     *     operationId="indexAuthors",
     *     @OA\Response(
     *     response=200,
     *     description="Success: All authors",
     *     ),
     *     @OA\RequestBody(
     *     description="Authors",
     *     required=false,
     *    )
     * )
     */
    public function index()
    {
        return Author::all();
    }


    /**
     * @OA\Post(
     *     path="/authors",
     *     tags={"Authors"},
     *     summary="Store an author",
     *     description="Store an author, this can only be done by an authenticated user.",
     *     operationId="storeAuthors",
     *     @OA\Response(
     *     response=200,
     *     description="Success: An author has been created",
     *     ),
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *     description="Author",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Author"),
     *     ),
     *   )
     * )
     */
    public function store(StoreAuthorRequest $request)
    {
        $validated = $request->validated();
        Author::create($validated);
        return Author::all();
    }


    /**
     * @OA\Get(
     *     path="/authors/{author}",
     *     tags={"Authors"},
     *     summary="Get an author",
     *     description="Get an author",
     *     operationId="showAuthors",
     *     @OA\Parameter(
     *     name="author",
     *     in="path",
     *     description="Id of author that needs to be fetched",
     *     required=true,
     *     @OA\Schema(
     *     type="integer",
     *     format="int64",
     *     example=1
     *     )
     *   ),
     *     @OA\Response(
     *     response=200,
     *     description="Success: An author has been found",
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="An author has not been found",
     *     ),
     *   )
     * )
     */
    public function show(Author $author)
    {
        return $author;
    }


    /**
     * @OA\Put(
     *     path="/authors/{author}",
     *     tags={"Authors"},
     *     summary="Update an author",
     *     description="Update an author",
     *     operationId="updateAuthors",
     *     @OA\Parameter(
     *     name="author",
     *     in="path",
     *     description="Id of author that needs to be updated",
     *     required=true,
     *     @OA\Schema(
     *     type="integer",
     *     format="int64",
     *     example=1
     *     )
     *    ),
     *     @OA\Response(
     *     response=200,
     *     description="Success: An author has been updated",
     *     ),
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *     description="Author",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Author"),
     *     ),
     *   )
     * )
     */
    public function update(StoreAuthorRequest $request, Author $author)
    {
        $validated = $request->validated();

        $author->update($validated);
        return Author::all();
    }


    /**
     * @OA\Delete(
     *     path="/authors/{author}",
     *     tags={"Authors"},
     *     summary="Delete an author",
     *     description="Delete an author",
     *     operationId="destroyAuthors",
     *     @OA\Parameter(
     *     name="author",
     *     in="path",
     *     description="Id of author that needs to be deleted",
     *     required=true,
     *     @OA\Schema(
     *     type="integer",
     *     format="int64",
     *     example=1
     *     )
     *   ),
     *     @OA\Response(
     *     response=200,
     *     description="Success: An author has been deleted",
     *     ),
     *     security={{"bearerAuth": {}}},
     *   )
     * )
     */
    public function destroy(Author $author)
    {
        return Author::destroy($author->id);
    }
}
