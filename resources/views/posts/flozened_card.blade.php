<div class="card mt-3">
    <div class="card-header d-flex flex-row align-items-center">
          
            <i class="fas fa-user-circle fa-5x"></i>
          
      
      
        <strong class="text-danger ml-3">削除済みユーザー</strong>
     
      <strong class="ml-3">{{$post->caption}}</strong>
      
    </div>
    <a href="{{route('posts.show',['post' => $post->id])}}">
      <img  width="450" class="card-img-top" src="{{ asset('storage/post_images/' . $post->photo)}}" >
    </a>        
    <div class="card-body">
      <div class="d-flex flex-row mb-3">
        
           
      　    <post-like
              :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))'
              :initial-count-likes='@json($post->count_likes)'
              :authorized='@json(Auth::check())'
              endpoint ="{{ route('posts.like', ['post' => $post->id])}}"
           ></post-like>

      </div>
      <div>
        @foreach($post->tags as $tag)
          @if($loop->first)
            <div class="card-body pt-0 pb-4 pl-3">
              <div class="card-text line-height">
          @endif
                <a href="{{ route('tags.show', ['name' => $tag->name ]) }}" class="border p-1 mr-1 mt-1 text-muted">
                  {{ $tag->hashtag }}
                </a>
          @if($loop->last)     
              </div>
            </div>
          @endif
        @endforeach    
      </div>
      <div>
        
        @foreach($post->comments as $comment)
          @if($loop->first)
            <div class="mt-2 mb-2">
          @endif    
          
            <div class="mb-3">
              削除済みユーザー
              <span class="ml-3">{{$comment->comment}}</span>
            </div>
          @if($loop->last)
            </div>
          @endif
        @endforeach  
      </div>
      @Auth
      <form method="POST" action="{{ route('comments.store')}}">
        @csrf
      <input type="hidden" value="{{ $post->id }}" name="post_id">
        <div class="row align-items-center justify-content-between">
          <div class="col-xs-12 col-sm-10"><input class="form-control" placeholder="コメントを書く" type="text" name="comment"></div>
           <div class="col-sm-2 mt-3 mt-sm-0"><button type="submit" class="btn-sm　btn-secondary">入力</button></div>
        </div>
       @endAuth 
      </form>   
    </div>
  </div>