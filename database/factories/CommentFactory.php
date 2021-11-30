<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $author = $this->faker->name;

        return [
            'author' => $author,
            'author_email' => $author.'@example.com',
            'content' => $this->faker->sentence(6,true),
            'time' => $this->faker->dateTimeBetween('-2 weeks', 'now'),
            'is_approved' => Comment::APPROVED
        ];
    }
}
