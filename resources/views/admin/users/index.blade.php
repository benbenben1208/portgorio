@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <h1 class="h2 text-success">ユーザー一覧</h1>  
            <div>
              <p><a href="{{ route('admin.posts.index')}}">投稿一覧</a></p>
              <p><a href="{{ route('admin.comments.index')}}">コメント一覧</a></p>
            <p><a href="{{ route('admin.flozened.index')}}">凍結中のアカウント一覧</a></p>
            <p><a class="btn btn-primary" href=" {{url('/csv/download_users')}}" target="blank">CSVダウンロード</a></p>
              
            </div>  
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal">
              検索
            </button>
            
            <!-- モーダルの設定 -->
            
            <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
              <!--以下modal-dialogのCSSの部分で modal-lgやmodal-smを追加するとモーダルのサイズを変更することができる-->
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="Modal">検索条件</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                  <form id="filter" id="GET">
                    <div class="modal-body">
                      <form method="GET" action="{{ route('admin.users.index')}}">
                        <div class="form-group">
                          <label for="name">名前</label>
                          <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="period">登録日</label>
                            <select name="period" class="form-control">
                              <option value="">---------</option>
                              <option value="1hour">1時間以内</option>
                              <option value="3hours">3時間以内</option>
                              <option value="6hours">6時間以内</option>
                              <option value="24hours">1日以内</option>
                              <option value="1week">1週間以内</option>
                              <option value="2week">2週間以内</option>
                              <option value="1month">1ヶ月以内</option>
                              <option value="3months">3ヶ月以内</option>
                              <option value="6months">半年以内</option>
                              <option value="12months">1年以内</option>
                              <option value="non">指定無し</option>
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
               <div class="mt-5 row justify-content-center">
                 {{ $users->links()}}
              </div>
            </div>
        </div>
    </div>
</div>

@endsection