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
            ->count(45)
            ->create();

        Book::factory()
            ->has(Author::factory()->count(4))
            ->has(Genre::factory()->count(3))
            ->create();

        // Create 12 genres, each with 5 books
        Genre::factory()
            ->count(12)
            ->hasAttached(Book::factory()->count(5))
            ->create();
    }
}
