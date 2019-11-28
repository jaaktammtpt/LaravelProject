<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $comment = Comment::with('user')->get();
//        return $comment;

        $comment = Comment::all();
        return $comment;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $comment = new Comment();

        if($request->has('title') && $request->has('body')) {
            $comment->title = $request->input('title');
            $comment->body = $request->input('body');
            $comment->user_id = 1;
            $comment->post_id = $post->id;
            $comment->save();
            return  $comment;
        }

        return response()->json(['error'=>'invalid parameter provides'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
//    public function show(Comment $comment)
//    {
//        //$comment = Comment::findOrFail($id);
//        return $comment;
//    }

    public function show(Comment $comment, Post $post)
    {
        $comment = Comment::where('post_id', $post->id)->get();
        return $comment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if($request->has('title')) {
            $comment->title = $request->input('title');
        }

        if($request->has('body')) {
            $comment->body = $request->input('body');
        }

        if($comment->isDirty()){
            $comment->save();
        }

        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['status'=>'OK']);
    }
}
