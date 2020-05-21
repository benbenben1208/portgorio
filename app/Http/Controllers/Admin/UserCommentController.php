<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
class UserCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user')->orderBy('created_at', 'desc')
            ->paginate(20);

            return view('admin.comments.index', compact('comments'));
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        
       return redirect()->route('admin.comments.index');
    }
}
