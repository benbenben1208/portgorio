<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Http\Requests\PostRequest;
class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource('App\Post', 'post');
    }
    public function index(Request $request)
    {
        
        $posts = Post::with('user','likes','comments')
            ->whereKeyword($request->keyword)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('posts/index', compact('posts'));
    }

    public function create()
    {
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });
        return view('posts.create', compact('allTagNames'));
    }

    public function store(PostRequest $request, Post $post)
    {
      
        $posts_store = $request->photo->storeAs('public/post_images' , time() . '.jpg');
        $post->photo = basename($posts_store);

       
        $post->fill($request->validated() + ['user_id' => $request->user()->id])->save();
       
        $request->tags->each(function ($tagName) use ($post) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag);
        });
        return redirect()->route('posts.index');

    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function edit(Post $post)
    {
       $tagNames = $post->tags->map(function ($tag) {
           return ['text' => $tag->name];
       });

       $allTagNames = Tag::all()->map(function ($tag){
           return ['text' => $tag->name];
       });
        
        return view('posts.edit', compact('post','tagNames','allTagNames'));
    }
    public function update(PostRequest $request, Post $post)
    {
       $posts_store =$request->photo->storeAs('public/post_images' ,  time() . '.jpg');
       $post->photo = basename($posts_store);

       $post->fill($request->validated() + ['user_id' => $request->user()->id])->save();
        

       $post->tags()->detach();
        $request->tags->each(function ($tagName) use ($post){
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag);
        });

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
