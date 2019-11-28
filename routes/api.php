<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources(['posts'=>'PostController']);
//Route::resources(['comments'=>'CommentController']);

//show->postituse kõik kommentaarid
//

Route::resources(['comments'=>'CommentController']);
Route::post('/posts/{post}/comments', 'CommentController@store');
Route::get('/posts/{post}/comments', 'CommentController@show');

//Route::get('/posts', 'PostController@index');
//Route::get('/posts/{post}', 'PostController@show');
//Route::post('/posts', 'PostController@store');
//Route::patch('/posts/{post}', 'PostController@update');
//Route::delete('/posts/{post}', 'PostController@destroy');


