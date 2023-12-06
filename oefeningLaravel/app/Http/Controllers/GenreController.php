<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Genre::all();
    }

    /**
     * Store a newly created resource in storage.
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
