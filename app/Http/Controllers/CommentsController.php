<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $post_id = $comment->post_id;
        $comment->delete();


        return redirect()->route('posts.show',['post' => $post_id]);
    }
}
