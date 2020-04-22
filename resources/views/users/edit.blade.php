@extends('layouts.app')
@section('title' , $user->name . 'さんのプロフィール編集')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto">  
        <div class="card mt-3">
          <div class="card-body">
            <h1 class="h3 card-title">プロフィール編集</h1>
              @include('error_card_list')
              
            
            <div class="card-text">
            <form method="POST" enctype="multipart/form-data" action="{{ route('users.update' , [ 'user'=>$user->id])}}">
              @method('PATCH')
              @csrf
              
              <div class="form-group">
                <label for="user_profile_photo">プロフィール写真</label><br>
                  @if($user->profile_photo)
                    <p>
                      <img src="{{ asset('storage/user_images . $user->profile_photo')}}" alt="">  
                    </p>
                  @endif  
                <input type="file" name="user_profile_photo"  value="{{ old('user_profile_photo',$user->id) }}" accept="image/jpeg,image/gif,image/png" />
              </div>
              @include('users.form')

              <button type="submit" class="btn btn-block purple-gradient">プロフィールを更新する</button>
            </form>    
            </div>
          </div>    
        </div>
          
      </div>    
    </div>  
  </div>
@endsection