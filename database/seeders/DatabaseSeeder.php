<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class
        ]);

        $tags = Tag::factory(15)->create();
        $categories = Category::factory(10)->create();

        User::factory(10)->create()->each(function($user) use($tags, $categories) {
            Post::factory(3)->create([
                'user_id' => $user->id,
                'author_name' => $user->name
            ])->each(function($post) use($tags, $categories) {
                $post->tags()->attach($tags->random(2));
                $post->categories()->attach($categories->random());

                Comment::factory(2)->create([
                    'post_id' => $post->id
                ]);
            });
        });
    }
}
