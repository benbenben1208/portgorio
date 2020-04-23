<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        
        return view('posts/index', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(PostRequest $request, Post $post)
    {
        
        $post->caption = $request->caption;
        $post->user_id = $request->user()->id;

        
        $posts_store = $request->photo->storeAs('public/post_images' , time() . '.jpg');
                
        $post->photo = basename($posts_store);
        $post->save();
        return redirect()->route('posts.index');

    }
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }
    public function update(PostRequest $request, Post $post)
    {
        $post->caption = $request->caption;
        $posts_store =$request->phpto->storeAs('public/post_images' ,  time() . '.jpg');

        $post->photo = basename($posts_store);

        $post->save();

        return redirect()->route('posts.index');

    }
    public function destroy(Post $post)
    {
        
        $post->delete();

        return redirect()->route('posts.index');
    }
    
}
