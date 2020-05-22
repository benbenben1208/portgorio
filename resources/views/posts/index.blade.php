@extends('layouts.app')
@section('title', '一覧')
@include('nav')
@section('content')
  <div class="container">
    @include('error_card_list') 
    @foreach($posts as $post)
      @if ($post->user)  
        @include('posts.card')
      @else
        @include('posts.flozened_card')
      @endif
    @endforeach
  </div>
  <div class="mt-5 row justify-content-center">
    {{ $posts->links()}}
  </div>
@endsection