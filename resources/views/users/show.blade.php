@extends('layouts.app')
@section('title', $user->name)
@section('content')
  @include('nav')
  <div class="container">
    <div class="card mt-5">
      <div class="card-body">
        <div class="flex flex-row mx-auto">
          <a href="{{ route('users.show' , ['user' => $user->id ])}}">
            @if($user->profile_photo)  
              <img class="rounded-circle" height="100" width="100" src="{{ asset('storage/user_images/' . $user->profile_photo)}}" alt="#">
            @else
              <i class="fas fa-user-circle fa-5x"></i>
            @endif
          </a>
          @if($user->id == Auth::id())
        　　<a class="btn btn-pink btn-xs" href="{{ route('users.edit',['user' => $user->id ])}}">編集</a>
        　@endif
        </div>
          <h2 class="h5 card-title m-0 pt-1 pl-2" >
            <a class="text-dark" href="{{ route('users.show' , ['user' => $user->id ])}}">
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