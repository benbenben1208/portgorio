<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use Carbon\Carbon;
class UserCommentController extends Controller
{
    public function index(Request $request)
    {
        
        $carbon = new Carbon;
        $dates = Comment::pluck('created_at');

        foreach($dates as $date) {
            $array[] = $date->format('m');
        }
           
        
        $months = collect($array)->unique()->sort()->reverse()->values();
        
        $comments = Comment::with('user')
            ->whereMonthly($request->monthly)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
          
        
            return view('admin.comments.index', compact('comments', 'months'));
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        
       return redirect()->route('admin.comments.index');
    }
}
