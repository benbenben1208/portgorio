@extends('layouts.admin')

@section('content')
<div class="container">
  
 
    <div class="card">
      <div>
        <p><a href="{{ route('admin.posts.index')}}">投稿一覧</a></p>
        <p><a href="{{ route('admin.comments.index')}}">コメント一覧</a></p>
        <p><a href="">凍結中のアカウント一覧</a></p>
      </div>  
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal">
        検索
      </button>
      
      <!-- モーダルの設定 -->
      
      <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
        <!--以下modal-dialogのCSSの部分で modal-lgやmodal-smを追加するとモーダルのサイズを変更することができる-->
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="Modal">検索条件</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <form id="filter" method="GET">
              <div class="modal-body">
                <form method="GET" action="{{ route('admin.users.index')}}">
                  <div class="form-group">
                    <label for="keyword">キーワード</label>
                    <input type="text" name="keyword" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="month">コメント投稿日</label>
                      <select name="monthly" class="form-control">
                          <option value="">---------</option>
                      
                        @foreach($months as $month)
                          <option value="{{$month}}">{{$month}}</option>
                        @endforeach  
                    </select>
                  </div>
                </form>
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
              <button form="filter" type="submit" class="btn btn-primary">検索</button>
            </div>
          </div>
        </div>
      </div>
      @foreach($comments as $comment)
      @if($loop->first)
        <div class="mt-2 mb-2">
      @endif    
  
     <div class="mb-3">
      
       <p>{{ $comment->user->name }}</p>
       <span class="ml-3">{{$comment->comment}}</span>
      <span class="ml-3">  投稿日時{{ $comment->created_at}}</span>
       <span class="ml-3">更新日時{{ $comment->updated_at }}</span>
       <form method="POST" action="{{ route('admin.comments.destroy', ['comment' => $comment->id ])}}">
         @csrf
         @method('DELETE')
        <button type="submit" class="btn-danger mt-3">削除する</button>
       </form>
     </div>
      @if($loop->last)
        </div>
      @endif
    
  @endforeach
</div>
 </div>
 <div class="mt-5 row justify-content-center">
  {{$comments->links()}}
 </div>
</div>
@endsection