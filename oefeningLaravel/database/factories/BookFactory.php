<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $authorId = Author::inRandomOrder()->first()->id;
        return [
            'name' => fake()->name(),
            'author_id' => $authorId,
            'publication_year' => fake()->year(),
        ];
    }
}
