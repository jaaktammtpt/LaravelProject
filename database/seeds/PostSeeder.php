<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 10)->make()->each(function ($post) {
            $post->user_id = User::inRandomOrder()->first()->id;
            $post->save();
        });
    }
}
