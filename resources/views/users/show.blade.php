@extends('layouts.app')
@section('title', $user->name)
@section('content')
  @include('nav')
  <div class="container">
    <div class="card mt-5">
      <div class="card-body">
        <div class="d-flex  mx-auto">
          <a href="{{ route('users.show' , ['user' => $user->id ])}}">
            @if($user->profile_photo)  
              <img id="profile_image_{{ $user->id }}" class="rounded-circle" height="100" width="100" src="{{ asset('storage/user_images/' . $user->profile_photo)}}" alt="#">
            @else
              <i class="fas fa-user-circle fa-5x"></i>
            @endif
          </a>
          @if($user->id == Auth::id())
        　　<p><a class="btn btn-pink btn-xs text-white ml-5 mt-3" href="{{ route('users.edit',['user' => $user->id ])}}">編集</a></p>
        　@endif
        </div>
          <h2 class="h5 card-title m-0 pt-1 pl-2" >
            <a class="text-dark " href="{{ route('users.show' , ['user' => $user->id ])}}">
              {{ $user->name}}
            </a>    
          </h2>    
      </div>
      <div class="card-body">
        <div class="card-text">
          
          <follow-button
            
            :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
            :initial-count-followers='@json($user->count_followers)'
            :initial-count-followees='@json($user->count_followees)'
            :authorized='@json(Auth::check())'
            endpoint="{{ route('users.follow', ['name' => $user->name])}}"
            :initial-compare-users='@json(Auth::id() === $user->id)'
          ></follow-button>
        </div>  
           
      </div>    
    </div>  
  </div>
@endsection