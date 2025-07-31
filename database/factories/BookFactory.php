<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            'name' => fake()->sentence(5),
            'synopsis' => fake()->text(),
            'publisher' => fake()->word(),
            'edition' => fake()->randomDigit(),
            'page_number' => fake()->randomNumber(3),
            'isbn' => fake()->isbn13(),
            'language' => Str::random(10),
            'release_date' => fake()->date(),
        ];
    }
}
