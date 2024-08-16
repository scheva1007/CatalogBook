<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'short_description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(),
            'created_at' => $this->faker->date,
            'updated_at' => $this->faker->date,
        ];
    }
}
