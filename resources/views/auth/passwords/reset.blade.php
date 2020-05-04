@extends('layouts.app')
@section('title', 'パスワード再設定')
@section('content')
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <h1 class="text-center"><a class="text-dark" href="#">Gorilla</a></h1>
            <div class="card mt-3">
              <div class="card-body">
                <h2 class=" text-center h3 card-title mt-2">パスワード再設定</h2>
                @include('error_card_list')  
                  
                <div class="card-text">
                  <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    
                    <input type="hidden" name="email" value="{{ $email}}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    

                    <div class="md-form">
                        <label for="password">新しいパスワード</label>
                        <input id="password" type="password" class="form-control" name="password">
                    </div>

                    <div class="md-form">
                        <label for="password-confirm">新しいパスワード(再入力)</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn btn-block purple-gradient mt-2 mb-2">
                        送信
                    </button>
                        </div>
                    </div>
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
