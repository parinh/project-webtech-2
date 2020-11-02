<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\PostsController;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::name('api.')->middleware('auth:api')->group(function (){
    Route::get('posts/search/{title}', [PostsController::class,'search']);
    Route::apiResource('posts',PostsController::class);
});

Route::get('/name' , function () {
    return ["name" => 'parin hopper',
        'id' => "6010450420"];
});

