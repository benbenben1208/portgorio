<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;
class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource('App\Post', 'post');
    }
    public function index(Request $request)
    {
        if ($request->has('keyword')) {
            $posts = Post::with('user','likes','comments')->where('caption', 'LIKE', '%' . $request->keyword . '%')
            ->orderBy('created_at', 'desc')->paginate(4)->appends($request->all());
        } else {
            $posts = Post::with('user','likes','comments')->orderBy('created_at', 'desc')->paginate(4);
        }

        
       
        
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
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }
    public function update(PostRequest $request, Post $post)
    {
        $post->caption = $request->caption;
      
        $posts_store =$request->photo->storeAs('public/post_images' ,  time() . '.jpg');

        $post->photo = basename($posts_store);

        $post->save();

        return redirect()->route('posts.index');

    }
    public function destroy(Post $post)
    {
        
        $post->delete();

        return redirect()->route('posts.index');
    }
    public function like(Request $request, Post $post)
    {

        $post->likes()->detach($request->user()->id);
        $post->likes()->attach($request->user()->id);

        return [
            'id' => $post->id,
            'countLikes' => $post->count_likes,
        ];
    }
    public function unlike(Request $request, Post $post)
    {
        
        $post->likes()->detach($request->user()->id);

        return [
            'id' => $post->id,
            'countLikes' => $post->count_likes,
        ];
    }
    
}
