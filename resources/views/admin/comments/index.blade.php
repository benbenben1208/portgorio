@extends('layouts.admin')

@section('content')
<div class="container">
  
  <h1 class="h2">ユーザーコメント一覧</h1>
    <div class="card">
      <div>
        <p><a href="{{ route('admin.posts.index')}}">投稿一覧</a></p>
        <p><a href="{{ route('admin.comments.index')}}">コメント一覧</a></p>
        <p><a href="{{ route('admin.flozened.index')}}">凍結中のアカウント一覧</a></p>
      </div>
      @include('error_card_list')  
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
            
            <form id="filter" method="POST">
              <div class="modal-body">
                <form method="POST" action="{{ route('admin.comments.search')}}">
                  @csrf
                  <div class="form-group">
                    <label for="keyword">キーワード</label>
                    <input type="text" name="keyword" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="year">コメント投稿年</label>
                      <select name="year" class="form-control">
                          <option value="">---------</option>
                      
                        @foreach($years as $year)
                          <option value="{{$year}}">{{$year}}年</option>
                        @endforeach  
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="month">コメント投稿月</label>
                      <select name="month" class="form-control">
                          <option value="">---------</option>
                      
                        @foreach($months as $month)
                          <option value="{{$month}}">{{$month}}</option>
                        @endforeach  
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="day">コメント投稿日</label>
                      <select name="day" class="form-control">
                          <option value="">---------</option>
                      
                        @foreach($days as $day)
                          <option value="{{$day}}">{{$day}}</option>
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
      <span class="ml-3">  投稿日時 {{ $comment->created_at->format('yy-m-d')}}</span>
       <span class="ml-3">更新日時 {{ $comment->updated_at->format('yy-m-d') }}</span>
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