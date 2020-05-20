@extends('layouts.app')
@section('title', 'パスワード再設定')
@section('content')
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <h1 class="text-center"><a class="text-dark" href="#">Gorilla</a></h1>
            <div class="card mt-3">
              <div class="card-body">
                <h2 class="h3 card-title mt-2">パスワード再設定</h2>
                @include('error_card_list')  
                  @if (session('status'))
                    <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                    </div>
                  @endif
                <div class="card-text">
                  <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="md-form">
                      <label for="email">メールアドレス</label>
                      <input class="form-control" name="email" id="email" type="text" required>    
                    </div>
                    <button type="submit" class="btn btn-block purple-gradient mt-2">
                      メール送信
                    </button>
                  </form>
                </div>  
                  
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
