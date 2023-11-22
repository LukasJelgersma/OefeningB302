<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookGenre>
 */
class BookGenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get a random book and genre from the database
        $book = Book::inRandomOrder()->first();
        $genre = Genre::inRandomOrder()->first();

        return [
            'book_id' => $book->id,
            'genre_id' => $genre->id,
        ];
    }


}
