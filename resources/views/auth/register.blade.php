@extends('layouts.app')

@section('title', '登録')

@section('content')
  <div class="container">
    <div class="row">
      <div  class="mx-auto mt-3">
        <div class="text-center">
          <h1 class="h1"><a class="text-dark" href="#">ポートゴリオ</a></h1>
          <p class="text-secondary">不正組織の写真を見てみんな笑ってやろう</p>
        </div>
        
        <div class="card mt-4">
          <div class="card-body">
            <h2 class="h3 card-title text-center">ユーザー登録</h2>
            
            <div class="card-text">
              <form method="POST" action="{{route('register')}}">
                @csrf
                <div class="form-group">
                <input class="form-control" type="text" id="name" name="name" placeholder="お名前" required value="{{old('name')}}">    
                </div>
                <div class="form-group">
                  <input class="form-control" type="email" id="email" name="email" placeholder="メールアドレス" required value="{{old('email')}}">    
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" id="password" name="password" placeholder="パスワード"　required>    
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="パスワード確認" required>    
                </div>
                <button class="btn btn-block purple-gradient" type="submit">ユーザー登録</button>
              </form>
              <div class="mt-4">
                 <p>アカウントをお持ちですか？
                   <a href="{{ route('login')}}">ログインする</a>   
                 </p>   
              </div>    
            </div>
          </div>    
        </div>
      </div>  
    </div>    
  </div>
@endsection