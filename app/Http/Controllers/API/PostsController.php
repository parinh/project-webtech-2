<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;

class PostsController extends Controller  //ลองไปเล่นใน postman ดูนะ
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::where('user_id',$request->user()->id)->orderBy('created_at','DESC')->get();
        return new PostCollection($posts);
    }

    public function search (Request $request,$topic){
        $posts = Post::where('user_id', $request->user()->id)->where('topic','LIKE','%'.$topic.'%')
            ->orderBy('created_at','DESC')->get();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->topic = $request->input('topic');
        $post->content = $request->input('content');
        $post->user_id = 1;
        $post->save();

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if (empty($post)){
            return response([
                'message'=> 'Post not found'
            ], 404)
                ->header('Content-Type', 'application/json');
        }
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if($request->has('topic'))
            $post->topic = $request->input('topic');
        if($request->has('content'))
            $post->content = $request -> input('content');
        $post->save();
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->delete()){
            return response([
                'message' => 'Post' . $id . 'has been deleted',
                'success' => true
            ],200)
                ->header('Content-Type', 'application/jason');
        }else{
            return response([
                'message' => 'Post' . $id . 'has been deleted',
                'success' => false
            ],200)
                ->header('Content-Type', 'application/jason');
        }
    }
}
