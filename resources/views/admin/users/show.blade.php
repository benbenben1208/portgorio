@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <p>ユーザー名　　　{{ $user->name }}</p>
              <p>メールアドレス　　{{ $user->email }}</p>
              <p>会員登録日時　　　{{ $user->created_at }}</p>
              <p>最終ログイン時間　{{ $user->last_logined_at }}</p>
              <p>投稿数 {{$user->posts->count()}}</p>  
              <p>コメント数　　　1　　</p>  
            <p>いいねの数 {{ $user->count_all_likes}}</p>
            　<p>フォロー数　　{{$user->count_followers }}<p>  
            <p>フォロワー数　　{{ $user->count_followees }}</p>
            <a href="">BANする　</a>
            <a href="">永久BANする</a>   

            </div>
        </div>
    </div>
</div>

@endsection