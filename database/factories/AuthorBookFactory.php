<?php

namespace Database\Factories;

use App\Models\AuthorBook;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorBookFactory extends Factory
{
    protected $model = AuthorBook::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'author_id' => $this->faker->numberBetween(1, 9),
                'book_id' => $this->faker->numberBetween(1, 15)
        ];
    }
}
