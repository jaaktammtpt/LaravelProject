<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        return $posts;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        if($request->has('title') && $request->has('body')) {
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->user_id = 1;
            $post->save();
            return  $post;
        }

        return response()->json(['error'=>'invalid parameter provides'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post->load('user');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($request->has('title')) {
            $post->title = $request->input('title');
        }

        if($request->has('body')) {
            $post->body = $request->input('body');
        }

        if($post->isDirty()){
            $post->save();
        }

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['status'=>'OK']);
    }
}
