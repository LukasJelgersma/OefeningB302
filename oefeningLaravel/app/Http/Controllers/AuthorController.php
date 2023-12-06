<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Author::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        $validated = $request->validated();
        Author::create($validated);
        return Author::all();
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return $author;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAuthorRequest $request, Author $author)
    {
        $validated = $request->validated();

        $author->update($validated);
        return Author::all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        return Author::destroy($author->id);
    }
}
