@extends('layouts.app')
@section('title', '一覧')
@include('nav')
@section('content')
  <div class="container">
    @foreach($posts as $post)  
    <div class="card">
       
      <div class="card-header d-flex flex-row">
        <a href="{{ route('users.show', ['user' => $post->user->id ])}}"> 
            @if($post->user->profile_photo)  
            <img class="rounded-circle" height="100" width="100" src="{{ asset('storage/user_images/' . $post->user->profile_photo)}}" alt="#">
          @else
            <i class="fas fa-user-circle fa-5x"></i>
          @endif
        </a> 
        <a href="{{ route('users.show',['user' => $post->user->id])}}">
          <strong>{{ $post->user->name}}</strong>
        </a>
      </div>
      <a href="{{route('users.show',['user' => $post->user->id])}}">
        <img  width="450" class="card-img-top" src="{{ asset('storage/post_images/' . $post->photo)}}" >
      </a>        
        
    </div>
    @endforeach
  </div>
@endsection