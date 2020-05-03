<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Comment $comment)
    {
        
         $comment->post_id = $request->post_id;
         
         $comment->user_id = $request->user()->id;
         $comment->comment = $request->comment;
         $comment->save();

         return redirect()->route('posts.index');
    }
    public function destroy(Comment $comment)
    {
        
        $comment->delete();

        return redirect()->route('posts.index');
    }
    
}
