<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookGenre;
use App\Models\Genre;
use App\Models\User;
use App\Models\UserRole;
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
            ->count(30)
            ->create();

        Book::factory()
            ->count(60)
            ->has(Author::factory()->count(4))
            ->create();

        Genre::factory()
            ->count(12)
            ->create();

        Book::all()->each(function (Book $book) {
            $book->genre()->attach(
                Genre::inRandomOrder()->take(rand(1, 3))->pluck('id')->toArray()
            );
        });

        UserRole::factory()
            ->count(1)
            ->create([
                'role_name' => 'admin',
            ]);

        UserRole::factory()
            ->count(1)
            ->create([
                'role_name' => 'normal',
            ]);

        User::factory()
            ->count(10)
            ->create();
    }
}
