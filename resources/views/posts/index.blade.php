@extends('layouts.app')
@section('title', '一覧')
@include('nav')
@section('content')
  <div class="container">
    @foreach($posts as $post)  
      @include('posts.card')
    @endforeach
  </div>
  <div class="mt-5 row justify-content-center">
    {{ $posts->links()}}
  </div>
@endsection