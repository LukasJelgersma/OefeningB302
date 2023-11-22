<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
    public function store(StoreGenreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Genre::create($validated);

        return redirect()->route('genres.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Genre::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGenreRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();

        $genre = Genre::find($id);

        $genre->update($validated);

        return redirect()->route('genres.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Genre::destroy($id);
    }
}
