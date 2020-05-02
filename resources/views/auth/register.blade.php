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

            <a href="{{ route('login.{provider}', ['provider' => 'google']) }}" class="btn btn-block btn-danger mb-4">
              <i class="fab fa-google mr-1"></i>Googleで登録
            </a>

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