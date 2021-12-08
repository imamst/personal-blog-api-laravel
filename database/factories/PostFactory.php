<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(5,7));
        
        $content = '';
        for($i=0; $i < 5; $i++) {
            $content .= '<p class="mb-4">' . $this->faker->sentences(rand(5, 10), true) . '</p>';
        }

        return [
            'title' => Str::title($title),
            'slug' => Str::slug($title).'-'.rand(111,999),
            'published_date' => '2021-'.$this->faker->numberBetween(9,11).'-'.$this->faker->numberBetween(1,30),
            'featured_img' => $this->faker->imageUrl(),
            'excerpt' => $this->faker->text(200),
            'content' => $content,
            'status' => Post::STATUS_PUBLISHED,
            'post_type' => Post::TYPE_POST,
            'comment_status' => Post::COMMENT_OPENED,
            'comments_count' => 0
        ];
    }
}
