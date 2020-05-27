<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserPostRequest;
use App\Comment;

class UserCommentController extends Controller
{
    public function index(UserPostRequest $request)
    {
        
        
        $dates = Comment::pluck('created_at');

        foreach($dates as $date) {
            $array_years[] = $date->format('yy');
            $array_months[] = $date->format('m');
            $array_days[] = $date->format('d');
        }
        
        $years = collect($array_years)->unique()->sort()->reverse()->values();
        $months = collect($array_months)->unique()->sort()->reverse()->values();
        $days = collect($array_days)->unique()->sort()->reverse()->values();
       
       
        $comments = Comment::with('user')
            ->whereKeyword($request->keyword)
            ->whereCommentsInYear($request->year)
            ->whereCommentsInMonth($request->month)
            ->whereCommentsInDay($request->day)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
          
        
            return view('admin.comments.index', compact('comments', 'years', 'months', 'days' ));
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        
       return redirect()->route('admin.comments.index');
    }
}
