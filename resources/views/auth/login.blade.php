@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto">
        <div class="text-center">
          <h1 class="text-dark mt-3">ポートゴリオ</h1>    
          <p class="text-secondary">不正組織の写真を見てみんな笑ってやろう</p>
        </div>
        <div class="card">
          <div class="card-body">
            <h2 class=" h3 card-title text-center ">ログイン</h2>
            
            <div class="card-text">
              <form method="POST" action="{{ route('login')}}">
                @csrf
                <div class="form-group">
                  <input type="text" name="email" id="email" class="form-control" placeholder="メールアドレス" required value="{{ old('email')}}">  
                </div>
                <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control" placeholder="パスワード" required >  
                </div>
               　<input type="hidden" name="remember" id="remember" value="on">

                 <button class="btn btn-block purple-gradient">ログイン</button>
              </form>
              <div class="mt-2">
              　　<p>アカウントをお持ちではないですか？<a href="{{ route('register')}}">登録する</a></p> 
              </div>  
            </div>
          </div>  
        </div>
        
      </div>    
    </div>    
  </div>    
@endsection