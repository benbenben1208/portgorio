<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserPostRequest;
use App\Post;

class UserPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
        ->orderBy('created_at', 'desc')
        ->paginate(4);
        $dates = Post::pluck('created_at');

        foreach($dates as $date) {
            $array_y[] =  $date->format('yy');
            $array_m[] =  $date->format('m');
            $array_d[] =  $date->format('d');
        }
        $years = collect($array_y)->unique()->sort()->reverse()->values();
        $months = collect($array_m)->unique()->sort()->reverse()->values();
        $days = collect($array_d)->unique()->sort()->reverse()->values();

       
        return view('admin/posts/index', compact('posts', 'years', 'months', 'days'));
    }
    public function search(UserPostRequest $request)
    {
       
        $posts = Post::with('user')
        ->whereKeyword($request->keyword)
        ->WherePostsInYear($request->year)
        ->WherePostsInMonth($request->month, $request->year)
        ->WherePostsInDay($request->day)
        ->orderBy('created_at', 'asc')
        ->paginate(4);
        
        return redirect()->route('admin.posts.index');
    }
    public function destroy(Post $post)
    {
       
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
