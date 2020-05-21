<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
class UserPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('admin/posts/index', compact('posts'));
    }
    public function destroy(Post $post)
    {
       
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
