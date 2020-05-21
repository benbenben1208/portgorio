@extends('layouts.admin')

@section('content')
  <div class="container">
    @foreach($posts as $post)  
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
                  <form method="POST" action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}">
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
          
        </div>
        
          <img  width="450" class="card-img-top" src="{{ asset('storage/post_images/' . $post->photo)}}" >
        
    @endforeach
  </div>
  <div class="mt-5 row justify-content-center">
    {{ $posts->links()}}
  </div>
@endsection