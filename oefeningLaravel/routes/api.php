<?php

use App\Models\Author;
use App\Models\Book;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/books', function (){
    return Book::all();
});

Route::post('/books', function(){
   return Book::create([
       'name' => 'Boek een',
       'author_id' => 1
       ]);
});

Route::post('/authors', function(){
    return Author::create([
        'name' => 'John Doe',
        'age' => 52,
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
