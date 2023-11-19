<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Database\Factories\BookGenreFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Author::factory()
            ->count(50)
            ->create();

        $genreNames = ['Mystery', 'Science Fiction', 'Fantasy', 'Romance', 'Thriller', 'Historical Fiction', 'Non-fiction', 'Biography', 'Autobiography', 'Poetry'];

        foreach ($genreNames as $genreName) {
            Genre::factory()->create(['name' => $genreName]);
        }
        Genre::factory()
            ->count(12)
            ->hasAttached(Book::factory()->count(3))
            ->create();

        Book::factory()
            ->count(70)
            ->has(Author::factory()->count(3))
            ->create();
    }
}
