<?php

use Illuminate\Database\Seeder;
use App\Comment;
use App\User;
use App\Post;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Comment::class, 25)->make()->each(function ($comment) {
            $comment->user_id = User::inRandomOrder()->first()->id;
            $comment->post_id = Post::inRandomOrder()->first()->id;
            $comment->save();
        });
    }
}
