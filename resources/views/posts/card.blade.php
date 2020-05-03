<div class="card mt-3">
    <div class="card-header d-flex flex-row align-items-center">
      <a href="{{ route('users.show', ['user' => $post->user->id ])}}"> 
          @if($post->user->profile_photo)  
            <img class="rounded-circle" height="100" width="100" src="{{ asset('storage/user_images/' . $post->user->profile_photo)}}" alt="#">
            
          @else
            <i class="fas fa-user-circle fa-5x"></i>
          @endif
      </a> 
      <a class="ml-3" href="{{ route('users.show',['user' => $post->user->id])}}">
        <strong>{{ $post->user->name}}</strong>
      </a>
      <strong class="ml-3">{{$post->caption}}</strong>
      @if(Auth::id() == $post->user->id)
        <div class="ml-auto">
          <div class="dropdown">
            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <button type="button" class="btn btn-link text-muted">
                <i class="fas fa-ellipsis-v"></i>  
              </button>  
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ route('posts.edit',['post'=> $post->id])}}" class="dropdown-item">
                <i class="fas fa-pen"></i>投稿を更新する
              </a>
              <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id}}">
                 <i class="fas fa-trash-alt">投稿を削除する</i> 
                </a>  
            </div>  
          </div>  
        </div>
        <div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                  {{ $post->user->name }}さんの投稿を削除します。よろしいですか？
                </div>
                <div class="modal-footer justify-content-between">
                  <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                  <button type="submit" class="btn btn-danger">削除する</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      @endif  
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
        
        @foreach($post->comments as $comment)
          @if($loop->first)
            <div class="mt-2 mb-2">
          @endif    
          
            <div class="mb-3">
                 <a href="{{ route('users.show',['user' => $comment->user->id])}}">
                    {{$comment->user->name}}
                 </a>
                 <span class="ml-3">{{$comment->comment}}</span>
                @if($comment->user_id === @Auth::user()->id) 
                <form method="POST"  action="{{ route('comments.destroy', ['comment' => $comment->id])}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger mt-3">削除する</button>
                </form>
                @endif
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