@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <table border="1">
                 <tr>
                   <th>ユーザーネーム</th>
                   <th>メールアドレス</th>
                   <th>投稿一覧</th>
                   <th>コメント一覧</th>
                   <th>最終ログイン日時</th>
                </tr>
                @foreach($users as $user)
                  <tr>
                  <td><a href="{{ route('admin.users.show', ['user' => $user->id ])}}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td> <a href="#">投稿一覧へ</a></td>
                  　<td> <a href="#">コメント一覧へ</a></td>
                    <td>{{ $user->last_logined_at }}</td>
                   
                  </tr>
                @endforeach     
               </table>
            </div>
        </div>
    </div>
</div>

@endsection