<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Comment $comment)
    {
        $comment->fill($request->validated() + ['user_id' => $request->user()->id])->save();
        
        // $comment->create($request->validated() + ['user_id' => $request->user()->id]); 

         return redirect()->route('posts.index');
    }
    public function destroy(Comment $comment)
    {
        
        $comment->delete();

        return redirect()->route('posts.index');
    }
    
}
