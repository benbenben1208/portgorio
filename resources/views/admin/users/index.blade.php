@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <p><a href="{{ route('admin.posts.index')}}">投稿一覧</a></p>
            <p><a href="{{ route('admin.comments.index')}}">コメント一覧</a></p>
               <table border="1">
                 <tr>
                   <th>ユーザーネーム</th>
                   <th>メールアドレス</th>
                   <th>投稿一覧</th>
                   <th>コメント一覧</th>
                   <th>アカウント作成日時</th>
                   <th>最終ログイン日時</th>
                </tr>
                @foreach($users as $user)
                  <tr>
                  <td><a href="{{ route('admin.users.show', ['user' => $user->id ])}}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td> <a href="#">このユーザーの投稿一覧へ</a></td>
                  　<td> <a href="#">このユーザーのコメント一覧へ</a></td>
                    <td>{{ $user->created_at }}</td>
                     <td> {{ $user->last_logined_at }}</td>
                  
                  </tr>
                @endforeach     
               </table>
            </div>
        </div>
    </div>
</div>

@endsection