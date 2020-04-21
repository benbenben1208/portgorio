@extends('layouts.app')
@section('title', $user->name)
@section('content')
  @include('nav')
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="flex flex-row">
          <a href="{{ route('users.show' , ['user_id' => $user->id ])}}">
            @if($user->profile_photo)  
              <img src="{{ asset('/users_images' . $user->profile_photo)}}" alt="#">
            @else
              <i class="fas fa-user-circle fa-5x"></i>
            @endif
          </a>    
        </div>
          <h2 class="h5 card-title m-0">
            <a class="text-dark" href="{{ route('users.show' , ['user_id' => $user->id ])}}">
              {{ $user->name}}
            </a>    
          </h2>    
      </div>
      <div class="card-body">
        <div class="card-text">
          <a href="">
            10 フォロー
          </a>
          <a href="">
            10 フォロー    
          </a>  
        </div>  
           
      </div>    
    </div>  
  </div>
@endsection