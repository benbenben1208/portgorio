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
                @include('users.form')
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