@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <p><a href="{{ route('admin.users.index')}}">ユーザー一覧</a></p>   
              {{-- <p><a href="{{ route('admin.users.posts.index')}}">投稿一覧</a></p>   
              <p><a href="{{ route('admin.users.comments.index')}}">コメント一覧</a></p>    --}}
            </div>
        </div>
    </div>
</div>
@endsection
