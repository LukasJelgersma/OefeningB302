<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genreNames = ['Mystery', 'Science Fiction', 'Fantasy', 'Romance', 'Thriller', 'Historical Fiction', 'Non-fiction', 'Biography', 'Autobiography', 'Poetry'];

        // Pick a random genre name from the list
        $genreName = $this->faker->randomElement($genreNames);

        return [
            'name' => $genreName,
        ];
    }
}
